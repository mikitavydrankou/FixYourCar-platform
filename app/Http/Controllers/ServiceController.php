<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = auth()->user()->services;
        return view('service.salons.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('service.salons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Service::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'service_description' => $request->service_description,
            'rating' => 0.0,
        ]);

        return redirect()->route('service.index')->with('status', 'Warsztat został dodany');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        return view('service.salons.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('service.salons.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $input = $request->all();
        $service->update($input);
        return redirect()->route('service.index')->with('status', 'Warsztat został zaktualizowany');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('service.index')->with('status', 'Warsztat został usunięty!');
    }
}
