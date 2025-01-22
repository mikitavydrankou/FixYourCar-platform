@extends('components.layouts.app')

@section('content')
    <div class="container">
        <h1>Edytuj samochód</h1>
        <form action="{{ route('cars.update', $car->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("PUT")

            <div class="form-group">
                <label for="make">Marka</label>
                <input id="make"
                       type="text"
                       class="form-control"
                       name="make" required
                       value="{{$car->make}}"
                >
            </div>

            <div class="form-group">
                <label for="model">Model</label>
                <input id="model"
                       type="text"
                       class="form-control"
                       name="model" required
                       value="{{$car->model}}"
                >
            </div>

            <div class="form-group">
                <label for="year">Rok</label>
                <input type="number"
                       class="form-control"
                       id="year"
                       name="year"
                       required min="1886"
                       max="{{ date('Y') }}"
                       value="{{$car->year}}"
                >
            </div>

            <div class="form-group">
                <label for="license_plate">Tablica rejestracyjna</label>
                <input id="license_plate"
                       type="text"
                       class="form-control"
                       name="license_plate" required
                       value="{{$car->license_plate}}"
                >
            </div>

            <div class="form-group">
                <label for="engine_type">Typ silnika</label>
                <input id="engine_type"
                       type="text"
                       class="form-control"
                       name="engine_type" required
                       value="{{$car->engine_type}}"
                >
            </div>

            <div class="form-group">
                <label for="transmission">Skrzynia biegów</label>
                <input id="transmission"
                       type="text"
                       class="form-control"
                       name="transmission" required
                       value="{{$car->transmission}}"
                >
            </div>

            <div class="form-group">
                <label for="mileage">Przebieg</label>
                <input id="mileage"
                       type="number"
                       class="form-control"
                       name="mileage" required
                       value="{{$car->mileage}}"
                >
            </div>

            <div class="form-group">
                <label for="last_service_date">Ostatnia data obsługi</label>
                <input type="number"
                       class="form-control"
                       id="last_service_date"
                       name="last_service_date"
                       min="1886"
                       max="{{ date('Y') }}"
                       value="{{$car->last_service_date}}"
                >
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Prześlij obraz</label>
                <div class="input-group">
                    <input type="file"
                           name="image"
                           id="image"
                    >
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Zapisz</button>
        </form>
    </div>
@endsection
