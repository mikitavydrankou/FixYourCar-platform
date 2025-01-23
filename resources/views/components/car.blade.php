@props(['car'])

@php
    $statusTexts = [
        1 => 'Działa bez problem',
        2 => 'Nie działa',
        3 => 'Jest w trakcie obsługi',
        'default' => 'Error',
    ];
    $statusText = $statusTexts[$car->status] ?? $statusTexts['default'];
@endphp

<div class="border p-4 rounded-lg shadow-sm">
    <!-- Car Title -->
    <h5 class="font-bold text-lg mb-2">{{ $car->make }} - {{ $car->model }}</h5>

    <!-- Status -->
    <p class="text-sm text-gray-700 mb-4">Status: {{ $statusText }}</p>

    <!-- Description -->
    <p class="text-sm text-gray-600 mb-4">Opis: {{ $car->description ?? 'Brak opisu' }}</p>

    <!-- Actions -->
    <div class="flex space-x-2">
        <a href="{{ route('cars.show', $car->id) }}" class="text-blue-600 underline">Zobacz</a>
        <form method="POST" action="{{ route('cars.destroy', $car->id) }}" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-600 underline">Usuń</button>
        </form>
    </div>
</div>
