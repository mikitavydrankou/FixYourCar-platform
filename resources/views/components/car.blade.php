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

<div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg mx-auto max-w-full overflow-hidden">
    <div class="flex flex-wrap md:flex-nowrap">
        <!-- Image Section -->
        <div class="w-full md:w-48 h-48 flex-shrink-0 overflow-hidden bg-gray-200">
            <img src="{{ asset($car->image) }}"
                 alt="{{ $car->name }}"
                 class="w-full h-full object-cover">
        </div>

        <!-- Content Section -->
        <div class="p-4 flex-1 flex flex-col justify-between">
            <div>
                <div class="flex justify-between items-center mb-3">
                    <h5 class="text-lg md:text-xl font-semibold text-gray-800 dark:text-gray-100">{{ $car->make }} - {{ $car->model }}</h5>
                    <div class="flex items-center text-sm">
                        <span class="w-3 h-3 rounded-full {{ $currentStatus['class'] }} mr-2"></span>
                        <span class="text-gray-600 dark:text-gray-200">{{ $currentStatus['text'] }}</span>
                    </div>
                </div>

                <p class="text-gray-600 dark:text-gray-400 text-sm">
                    Opis: {{ $car->description ?? 'Brak opisu' }}
                </p>
            </div>

            <div class="flex flex-wrap justify-end space-y-2 sm:space-y-0 sm:space-x-3 mt-4">
                <!-- View Button -->
                <a href="{{ route('cars.show', $car->id) }}"
                   class="flex items-center bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg transition duration-200 text-sm font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                    <span class="ml-2">Zobacz</span>
                </a>

                <!-- Delete Button -->
                <form method="POST" action="{{ route('cars.destroy', $car->id) }}" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="flex items-center bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg text-sm font-medium transition duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        <span class="ml-2">Usuń</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

