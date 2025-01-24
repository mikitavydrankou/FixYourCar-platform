@extends('components.layouts.app')
@section('content')
    <div class="container">
        <a class="btn-outline-primary" href={{ route('client.requests.edit', $service_request)}}>Edytuj</a>
        <div class="card">
            <div class="card-header">Twoje zgłoszenie</div>
            <div class="card-body">
                <div class="card-body">
                    <p class="card-text">Samochód: {{ $service_request->car->make }} - {{ $service_request->car->year }}</p>
                    <p class="card-text">Opis problemu: {{ $service_request->problem_description }}</p>
                    <p class="card-text">Pilność: {{ $service_request->urgency }}</p>
                    <p class="card-text">Status: {{ $service_request->status }}</p>
                    <p class="card-text">Lokalizacja: {{ $service_request->location }}</p>

                </div>
                <hr/>
            </div>
        </div>
    </div>
@endsection
