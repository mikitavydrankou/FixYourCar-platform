<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceOffer;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $service_requests = $user->serviceRequests()->with('serviceOffers')->get();
        dd($service_requests);
    }

    public function history()
    {
        $user = Auth::user();
        $offers = $user->services()->with('serviceOffers')->get();

        return view('service.offers.history', compact('offers'));
    }

    public function client_index(ServiceRequest $service_request)
    {
        $offers = $service_request->serviceOffers;
        return view('client.offers.index', compact('offers'));
    }

    public function service_index(Service $service)
    {
        $activeOffers = $service->serviceOffers()->where('status', 'active')->get();
        return view('service.offers.index', compact('service', 'activeOffers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('services.offers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        ServiceOffer::create([
            'service_request_id' => $request->service_request_id,
            'service_id' => $request->service_id,
            'price' => $request->price,
            'description' => $request->description,
            'date' => $request->date,
            'time' => $request->time,
        ]);

        return redirect()->route('service.requests')->with('status', 'Oferta została wysłana');
    }

    /**
     * Display the specified resource.
     */
    public function show(ServiceOffer $serviceOffer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServiceOffer $serviceOffer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ServiceOffer $serviceOffer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceOffer $serviceOffer)
    {
        //
    }
}
