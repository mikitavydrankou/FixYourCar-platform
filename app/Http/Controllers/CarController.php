<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,heic|max:5120', // Поддержка HEIC
            ]);

            $file = $request->file('image');
            $image = $image = Image::read($file->getPathname());

            if ($file->getClientOriginalExtension() === 'heic') {
                // Конвертация HEIC в JPEG
                $image->encode('jpg', 85); // 85 качество JPEG
                $imageName = time() . '.jpg';
            } else {
                $imageName = time() . '.' . $file->extension();
            }


            // Сохранение изображения
            $image->save(public_path('images/' . $imageName));
            $imagePath = '/images/' . $imageName;
        } else {
            $imagePath = '/images/default_car.jpg';
        }

        if (!is_numeric($request->mileage)) {
            return redirect()->back()->withErrors(['mileage' => 'Mileage must be a number']);
        }

        Car::create([
            'user_id' => Auth::id(),
            'make' => $request->make,
            'model' => $request->model,
            'year' => $request->year,
            'license_plate' => $request->license_plate,
            'engine_type' => $request->engine_type,
            'transmission' => $request->transmission,
            'mileage' => $request->mileage,
            'last_service_date' => $request->last_service_date,
            'image' => $imagePath,
        ]);

        return redirect()->route('cars')->with('status', 'Maszyna została добавлена успешно');
    }
    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        return view('client.cars.edit', compact('car'));
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
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $imagePath = '/images/' . $imageName;
        } else {
            $imagePath = $car->image;
        }

        $input = $request->only([
            'make',
            'model',
            'year',
            'license_plate',
            'engine_type',
            'transmission',
            'mileage',
            'last_service_date',
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
        $car->delete();
        return redirect()->route('cars')->with('status', 'Samochód został usunięty!');
    }
}
