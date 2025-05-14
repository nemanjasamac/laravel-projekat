<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with('category')->orderBy('created_at', 'desc')->get();
        return view('services_admin.index', compact('services'));
    }

    public function create()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Nemate dozvolu za ovu akciju.');
        }
        
        $categories = Category::all();
        return view('services_admin.create', compact('categories'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Nemate dozvolu za ovu akciju.');
        }
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'is_featured' => 'nullable|boolean',
            'image' => 'nullable|image|max:2048',
        ]);

        $validated['is_featured'] = $request->has('is_featured') ? 1 : 0;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            
            $image->move(public_path('images/services'), $imageName);
            
            $validated['image'] = 'services/' . $imageName;
        }

        Service::create($validated);

        return redirect()->route('services.index')->with('success', 'Usluga je uspešno dodata.');
    }

    public function edit($id)
    {
        if (auth()->user()->role !== 'admin' && auth()->user()->role !== 'editor') {
            abort(403, 'Nemate dozvolu za ovu akciju.');
        }
        
        $service = Service::findOrFail($id);
        $categories = Category::all();
        return view('services_admin.edit', compact('service', 'categories'));
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->role !== 'admin' && auth()->user()->role !== 'editor') {
            abort(403, 'Nemate dozvolu za ovu akciju.');
        }
        
        $service = Service::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'is_featured' => 'nullable|boolean',
            'image' => 'nullable|image|max:2048',
        ]);

        $validated['is_featured'] = $request->has('is_featured') ? 1 : 0;

        if ($request->hasFile('image')) {
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }
            
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            
            $image->move(public_path('images/services'), $imageName);
            
            $validated['image'] = 'services/' . $imageName;
        }

        $service->update($validated);

        return redirect()->route('services.index')->with('success', 'Usluga je uspešno izmenjena.');
    }

    public function destroy($id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Nemate dozvolu za ovu akciju.');
        }
        
        $service = Service::findOrFail($id);
        
        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }
        
        $service->delete();

        return redirect()->route('services.index')->with('success', 'Usluga je uspešno obrisana.');
    }
}
