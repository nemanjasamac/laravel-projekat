<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consultation;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;


class ConsultationController extends Controller
{
    public function create()
    {
        $services = Service::all();
        return view('consultations.create', compact('services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'date' => 'required|date|after:now', 
            'time' => 'required', 
            'notes' => 'nullable|string|max:500',
        ]);
        
        $consultation = new \App\Models\Consultation();
        
        $consultation->user_id = auth()->id();
        $consultation->service_id = $validated['service_id'];
        $consultation->date = $validated['date'];
        $consultation->time = $validated['time']; 
        $consultation->notes = $validated['notes'];
        $consultation->status = 'zakazano';
        $consultation->save();
        
        return redirect('/dashboard')->with('success', 'Uspešno zakazano!');
    }

    public function destroy($id)
    {
        $consultation = Consultation::findOrFail($id);

        if (auth()->user()->role === 'admin' || auth()->user()->role === 'editor' || $consultation->user_id === auth()->id()) {
            $consultation->delete();
            return redirect()->route('dashboard')->with('success', 'Konsultacija je uspešno obrisana.');
        }

        abort(403, 'Nemate dozvolu za ovu akciju.');
    }

    public function edit($id)
    {
        $consultation = Consultation::findOrFail($id);

        if (auth()->user()->role === 'admin' || auth()->user()->role === 'editor' || $consultation->user_id === auth()->id()) {
            $services = Service::all();
            return view('consultations.edit', compact('consultation', 'services'));
        }

        abort(403, 'Nemate dozvolu.');
    }

    public function update(Request $request, $id)
    {
        $consultation = Consultation::findOrFail($id);

        if (auth()->user()->role !== 'admin' && auth()->user()->role !== 'editor' && $consultation->user_id !== auth()->id()) {
            abort(403, 'Nemate dozvolu');
        }

        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'date' => 'required|date|after:now',  
            'time' => 'required',                 
            'notes' => 'nullable|string|max:500',
        ]);

        $consultation->service_id = $validated['service_id'];
        $consultation->date = $validated['date'];
        $consultation->time = $validated['time'];
        $consultation->notes = $validated['notes'];
        $consultation->save();

        return redirect()->route('dashboard')->with('success', 'Konsultacija je uspesno izmenjena.');
    }


}
