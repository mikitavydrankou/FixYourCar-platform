@extends('components.layouts.app')

@section('content')
    <div class="container">
        <a class="btn-outline-primary" href={{ route('cars.edit', $car->id)}}>Edit</a>
        <div class="card">
            <div class="card-header">Twój samochód</div>
            <div class="card-body">
                <div class="card-body">
                    <p class="card-text">Marka: {{ $car->make }}</p>
                    <p class="card-text">Model: {{ $car->model }}</p>
                    <p class="card-text">Rok: {{ $car->year }}</p>
                    <p class="card-text">Tablica rejestracyjna: {{ $car->license_plate }}</p>
                    <p class="card-text">Typ silnika: {{ $car->engine_type }}</p>
                    <p class="card-text">Skrzynia biegów: {{ $car->transmission }}</p>
                    <p class="card-text">Przebieg: {{ $car->mileage }}</p>
                    <p class="card-text">Ostatnia data obsługi: {{ $car->last_service_date }}</p>
                </div>
                <hr/>
            </div>
        </div>
    </div>
@endsection
