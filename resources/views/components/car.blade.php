@props(['car'])

@php
    $statusStyles = [
        1 => ['class' => 'bg-green-500', 'text' => 'Działa'],
        2 => ['class' => 'bg-red-500', 'text' => 'Nie działa'],
        3 => ['class' => 'bg-yellow-500', 'text' => 'W trakcie'],
        'default' => ['class' => 'bg-gray-500', 'text' => 'Error'],
    ];
    $currentStatus = $statusStyles[$car->status] ?? $statusStyles['default'];
@endphp

<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden max-w-xs mx-auto">
    <div class="flex">
        <!-- Image Section -->
        <div class="w-1/3 h-24 bg-gray-200 overflow-hidden">
            <img src="{{ asset($car->image) }}" alt="{{ $car->name }}" class="w-full h-full object-cover">
        </div>

        <!-- Content Section -->
        <div class="p-4 flex-1">
            <h5 class="text-lg font-semibold text-gray-800 dark:text-gray-100">{{ $car->make }} - {{ $car->model }}</h5>
            <div class="flex items-center text-sm mt-2">
                <span class="w-2.5 h-2.5 rounded-full {{ $currentStatus['class'] }} mr-2"></span>
                <span class="text-gray-600 dark:text-gray-200">{{ $currentStatus['text'] }}</span>
            </div>
            <p class="text-gray-600 dark:text-gray-400 text-sm mt-2">{{ $car->description ?? 'Brak opisu' }}</p>

            <div class="flex justify-end mt-4 space-x-2">
                <a href="{{ route('cars.show', $car->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-3 rounded-lg text-sm">
                    Zobacz
                </a>

                <form method="POST" action="{{ route('cars.destroy', $car->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-3 rounded-lg text-sm">
                        Usuń
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
