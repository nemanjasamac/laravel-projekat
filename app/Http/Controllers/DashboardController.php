<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Consultation;

class DashboardController extends Controller
{
    public function index()
{
    $user = Auth::user();

    if ($user->role === 'admin' || $user->role === 'editor') {
        $totalConsultations = Consultation::count();
        $scheduled = Consultation::where('status', 'zakazano')->count();
        $completed = Consultation::where('status', 'završeno')->count();
        $canceled = Consultation::where('status', 'otkazano')->count();

        return view('admin.dashboard', compact('totalConsultations', 'scheduled', 'completed', 'canceled'));
    } else {
        $consultations = Consultation::where('user_id', $user->id)->with('service')->get();

        return view('dashboard', compact('consultations'));
    }
}
}
