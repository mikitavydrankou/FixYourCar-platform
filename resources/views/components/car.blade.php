@props(['car'])



<div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg mx-auto max-w-full overflow-hidden">
    <!-- Desktop Version -->
    <div class="hidden md:flex flex-wrap md:flex-nowrap">
        <!-- Image Section -->
        <div class="w-full md:w-48 h-48 flex-shrink-0 overflow-hidden bg-gray-200">
            <img src="{{ asset($car->image) }}"
                 alt="{{ $car->name }}"
                 class="w-full h-full object-cover">
        </div>

        <!-- Content Section -->
        <div class="p-4 flex-1 flex flex-col justify-between">
            <div>
                <p class="text-gray-600 dark:text-gray-400 text-sm">
                    Rok: {{ $car->year ?? 'Brak' }}
                </p>
                <p class="text-gray-600 dark:text-gray-400 text-sm">
                    Van: {{ $car->license_plate ?? 'Brak' }}
                </p>
                <p class="text-gray-600 dark:text-gray-400 text-sm">
                    Przebieg: {{ $car->mileage ?? 'Brak' }}
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

    <!-- Mobile Version -->
    <div class="block md:hidden">
        <!-- Image Section -->
        <div class="w-full h-48 flex-shrink-0 overflow-hidden bg-gray-200 mb-4">
            <img src="{{ asset($car->image) }}"
                 alt="{{ $car->name }}"
                 class="w-full h-full object-cover">
        </div>

        <!-- Content Section -->
        <div class="p-4">
            <div class="mb-4">
                <h5 class="text-lg font-semibold text-gray-800 dark:text-gray-100">{{ $car->make }} - {{ $car->model }}</h5>

                <p class="text-gray-600 dark:text-gray-400 text-sm">
                    Rok: {{ $car->year ?? 'Brak' }}
                </p>
                <p class="text-gray-600 dark:text-gray-400 text-sm">
                    Van: {{ $car->license_plate ?? 'Brak' }}
                </p>
                <p class="text-gray-600 dark:text-gray-400 text-sm">
                    Przebieg: {{ $car->mileage ?? 'Brak' }}
                </p>
            </div>

            <div class="flex flex-col space-y-3">
                <!-- View Button -->
                <a href="{{ route('cars.show', $car->id) }}"
                   class="flex items-center bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg transition duration-200 text-sm font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                    <span class="ml-2">Zobacz</span>
                </a>

                <!-- Delete Button (Full Width) -->
                <form method="POST" action="{{ route('cars.destroy', $car->id) }}" class="inline w-full">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="flex items-center bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg w-full text-sm font-medium transition duration-200">
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
