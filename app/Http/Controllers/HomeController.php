<?php

namespace App\Http\Controllers;

use App\Models\Service;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::where('is_featured', true)->take(4)->get();
        return view('home', compact('services'));
    }

    public function services()
    {
        $services = \App\Models\Service::paginate(9);
        return view('services.index', compact('services'));
    }

    public function service(Service $service)
    {
        return view('services.show', compact('service'));
    }

    public function contact()
    {
        return view('contact');
    }
}
