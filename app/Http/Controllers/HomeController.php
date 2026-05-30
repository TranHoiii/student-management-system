<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application homepage.
     */
    public function index()
    {
        $services = Service::where('is_active', true)->get();
        return view('home', compact('services'));
    }

    /**
     * Show the detailed services list page.
     */
    public function services()
    {
        $services = Service::where('is_active', true)->get();
        return view('services', compact('services'));
    }

    /**
     * Show the contact page.
     */
    public function contact()
    {
        $services = Service::where('is_active', true)->get();
        return view('contact', compact('services'));
    }
}
