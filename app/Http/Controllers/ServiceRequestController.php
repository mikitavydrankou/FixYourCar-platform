<?php

namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ServiceRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Database\Eloquent\Collection
    {
        return ServiceRequest::all();
    }

    public function client_index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $user = Auth::user();
        $serviceRequests = $user->serviceRequests;
        return view('client.requests.index', compact('serviceRequests'));
    }

    public function service_index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $service_requests = ServiceRequest::all();

        $services = auth()->user()->services;
        return view('service.requests.index', compact(
            'service_requests',
            'services'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        $cars = $user->cars;
        return view('client.requests.create', compact('cars',));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $attachments = $this->handleImagesUpload($request);

        ServiceRequest::create([
            'user_id' => auth()->id(),
            'car_id' => $request->car_id,
            'problem_description' => $request->problem_description,
            'urgency' => $request->urgency,
            'status' => 'waiting',
            'location' => $request->location,
            'attachments' => json_encode($attachments),
        ]);

        return redirect()->route('client.requests')->with('status', 'Zgłoszenie zostało dodane pomyślnie');
    }

    /**
     * Display the specified resource.
     */
    public function show(ServiceRequest $serviceRequest)
    {
        $acceptedOffer = $serviceRequest->selectedServiceOffer;
        return view('client.requests.show', compact('serviceRequest', 'acceptedOffer'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServiceRequest $serviceRequest)
    {
        return view('client.requests.edit', compact('serviceRequest',));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ServiceRequest $serviceRequest)
    {
        $attachments = $this->handleImagesUpload($request);

        $input = $request->only([
            'problem_description',
            'urgency',
            'location',
        ]);

        $input['attachments'] = $attachments;

        $serviceRequest->update($input);

        return redirect()->route('client.requests')->with('status', 'Zgłoszenie zostało pomyślnie zaktualizowane');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceRequest $serviceRequest)
    {
        $serviceRequest->delete();
        return redirect()->route('client.requests')->with('status', 'Zgłoszenie zostało pomyślnie anulowane');
    }

    public function handleImagesUpload(Request $request): array
    {
        if ($request->hasFile('attachments')) {
            $request->validate([
                'attachments.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            $attachments = [];
            $manager = new ImageManager(new Driver());
            foreach ($request->file('attachments') as $file) {
                $image = $manager->read($file);
                $imageName = time() . '_' . $file->getClientOriginalName();
                $image->orient()->toJpeg()->save(public_path('attachments/' . $imageName));
                $attachments[] = 'attachments/' . $imageName;
            }
        } else {
            $attachments = ['/default_images/1.jpg', '/default_images/2.jpeg', '/default_images/3.jpeg'];
        }
        return $attachments;
    }
}

