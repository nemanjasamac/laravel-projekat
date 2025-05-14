<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Service;
use Illuminate\Http\Request;

class AdminConsultationsController extends Controller
{
    public function index()
    {
        $consultations = Consultation::with('service', 'user')->get();
        return view('consultations_admin.index', compact('consultations'));
    }

    public function create()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Nemate dozvolu za ovu akciju.');
        }
        
        $services = Service::all();
        return view('consultations_admin.create', compact('services'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Nemate dozvolu za ovu akciju.');
        }
        
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'date' => 'required|date',
            'time' => 'required',
            'notes' => 'nullable|string',
            'status' => 'required|in:zakazano,otkazano,završeno',
        ]);

        $consultation = new Consultation();
        $consultation->service_id = $request->service_id;
        $consultation->user_id = auth()->id();
        $consultation->date = $request->date;
        $consultation->time = $request->time;
        $consultation->notes = $request->notes;
        $consultation->status = $request->status;
        $consultation->save();

        return redirect()->route('admin.consultations.index')->with('success', 'Konsultacija uspešno kreirana.');
    }

    public function edit(Consultation $consultation)
    {
        if (auth()->user()->role !== 'admin' && auth()->user()->role !== 'editor') {
            abort(403, 'Nemate dozvolu za ovu akciju.');
        }
        
        $services = Service::all();
        return view('consultations_admin.edit', compact('consultation', 'services'));
    }

    public function update(Request $request, Consultation $consultation)
    {
        if (auth()->user()->role !== 'admin' && auth()->user()->role !== 'editor') {
            abort(403, 'Nemate dozvolu za ovu akciju.');
        }
        
        $request->validate([
            'status' => 'required|in:zakazano,otkazano,završeno',
        ]);

        $consultation->status = $request->status;
        $consultation->save();

        return redirect()->route('admin.consultations.index')->with('success', 'Status konsultacije uspešno ažuriran.');
    }

    public function destroy(Consultation $consultation)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Nemate dozvolu za ovu akciju.');
        }
        
        $consultation->delete();

        return redirect()->route('admin.consultations.index')->with('success', 'Konsultacija uspešno obrisana.');
    }
}
