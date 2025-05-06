<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();

        return view('dashboard.services.index',compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'status' => 'required|in:available,not_available',
        ]);

        Service::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'price'=>$request->price,
            'status'=>$request->status,
        ]);

        return redirect()->route('dashboard.services.index')->with("success", "The service has been added successfully.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $service = Service::findOrFail($id);

        return view("dashboard.services.edit", compact("service"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'status' => 'required|in:available,not_available',
        ]);

        $service->update([
            'name'=>$request->name,
            'description'=>$request->description,
            'price'=>$request->price,
            'status'=>$request->status,
        ]);

        return redirect()->route('dashboard.services.index')->with("success", "The service has been modified successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Service::destroy($id);

        return redirect()->back()->with("success", "The service has been deleted successfully.");
    }
}
