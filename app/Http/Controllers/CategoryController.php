<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Nemate dozvolu za ovu akciju.');
        }
        
        return view('categories.create');
    }

    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
    if (auth()->user()->role !== 'admin') {
            abort(403, 'Nemate dozvolu za ovu akciju.');
        }
        
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategorija uspešno kreirana.');
    }

    public function edit(Category $category)
    {
        if (auth()->user()->role !== 'admin' && auth()->user()->role !== 'editor') {
            abort(403, 'Nemate dozvolu za ovu akciju.');
        }
        
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        if (auth()->user()->role !== 'admin' && auth()->user()->role !== 'editor') {
            abort(403, 'Nemate dozvolu za ovu akciju.');
        }
        
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategorija uspešno ažurirana.');
    }

    public function destroy(Category $category)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Nemate dozvolu za ovu akciju.');
        }
        
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Kategorija uspešno obrisana.');
    }
}
