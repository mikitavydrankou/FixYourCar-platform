<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Intervention\Image\Laravel\Facades\Image;


class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $cars = $user->cars;
        return view('client.cars.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('client.cars.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $imagePath = $this->handleImageUpload($request);
        if (!is_numeric($request->mileage)) {
            return redirect()->back()->withErrors(['mileage' => 'Przebieg to cyfra']);
        }

        $lastServiceDate = $request->has('no_service') ? null : $request->last_service_date;

        Car::create([
            'user_id' => Auth::id(),
            'make' => $request->make,
            'model' => $request->model,
            'year' => $request->year,
            'license_plate' => $request->license_plate,
            'engine_type' => $request->engine_type,
            'transmission' => $request->transmission,
            'mileage' => $request->mileage,
            'last_service_date' => $lastServiceDate,
            'image' => $imagePath,
        ]);

        return redirect()->route('cars')->with('status', 'Samochód został pomyślnie dodany');
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        return view('client.cars.show', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        return view('client.cars.edit', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        $imagePath = $this->handleImageUpload($request);

        $lastServiceDate = $request->has('no_service') ? null : $request->last_service_date;

        $input = $request->only([
            'make',
            'model',
            'year',
            'license_plate',
            'engine_type',
            'transmission',
            'mileage',
            'last_service_date' => $lastServiceDate,
        ]);

        $input['image'] = $imagePath;

        $car->update($input);

        return redirect()->route('cars')->with('status', 'Samochód został zaktualizowany');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
//        if ($car->serviceRequests()->exists()) {
//            return redirect()->route('cars')->withErrors(['error' => 'Nie możesz usunąć samochodu, jeśli istnieją zgłoszenia ']);
//        }

        if ($car->serviceRequests()->exists()) {
            return redirect()->route('cars')->withErrors(['error' => 'Nie możesz usunąć samochodu, jeśli istnieją zgłoszenia ']);
        }
        $car->delete();
        return redirect()->route('cars')->with('status', 'Samochód został usunięty!');
    }

    /**
     * @param Request $request
     * @return string
     */
    public function handleImageUpload(Request $request): string
    {
        $manager = new ImageManager(Driver::class);

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,heic', // Поддержка HEIC
            ]);
            $file = $request->file('image');
            $image = $manager->read($file);
            $imageName = time() . '.' . $file->extension();
            $image->orient()->toJpeg()->save(public_path('images/' . $imageName));
            $imagePath = '/images/' . $imageName;
        } else {
            $imagePath = '/default_images/default_car.jpeg';
        }

        return $imagePath;
    }
}
