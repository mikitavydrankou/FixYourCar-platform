@props(['car'])

@php
    $statusStyles = [
        1 => ['class' => 'bg-green-500', 'text' => 'Działa bez problem'],
        2 => ['class' => 'bg-red-500', 'text' => 'Nie działa'],
        3 => ['class' => 'bg-yellow-500', 'text' => 'Jest w trakcie obsługi'],
        'default' => ['class' => 'bg-gray-500', 'text' => 'Error'],
    ];
    $currentStatus = $statusStyles[$car->status] ?? $statusStyles['default'];
@endphp

<div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg mx-auto max-w-lg">
    <div class="flex flex-col md:flex-row">
        <!-- Fixed Image Section -->
        <div class="md:w-1/3">
            <div class="w-full h-48 overflow-hidden bg-gray-200 rounded-t-lg md:rounded-l-lg">
                <img src="{{ asset($car->image) }}"
                     alt="{{ $car->name }}"
                     class="w-full h-full object-cover">
            </div>
        </div>

        <!-- Content Section -->
        <div class="p-6 md:w-2/3">
            <div class="flex justify-between items-center mb-4">
                <h5 class="text-xl font-semibold text-gray-800 dark:text-gray-100">{{ $car->make }} - {{ $car->model }}</h5>
                <div class="flex items-center text-sm">
                    <span class="w-3 h-3 rounded-full {{ $currentStatus['class'] }} mr-2"></span>
                    <span class="text-gray-600 dark:text-gray-200">{{ $currentStatus['text'] }}</span>
                </div>
            </div>

            <div class="flex space-x-6 mt-4">
                <!-- View Button -->
                <a href="{{ route('cars.show', $car->id) }}" class="flex items-center justify-center bg-blue-500 hover:bg-blue-600 text-white py-3 px-5 rounded-lg transition duration-200 text-lg font-semibold">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                    <span class="ml-2">Zobacz</span>
                </a>

                <!-- Delete Button -->
                <form method="POST" action="{{ route('cars.destroy', $car->id) }}" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="flex items-center justify-center bg-red-500  text-red py-3 px-5 rounded-lg text-lg font-semibold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        <span class="dark:text-gray-100 ml-2">Usuń</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
