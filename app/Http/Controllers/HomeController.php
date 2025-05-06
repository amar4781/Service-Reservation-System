<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboard()
    {
        return view('dashboard.index');
    }

    public function website()
    {
        $services = Service::where('status','=','available')->inRandomOrder()->get();
        return view('website.index',compact('services'));
    }
}
