<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Car Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl mx-auto">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            {{ __('Make') }}:
                        </h3>
                        <p class="text-gray-700 dark:text-gray-300">{{ $car->make }}</p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            {{ __('Model') }}:
                        </h3>
                        <p class="text-gray-700 dark:text-gray-300">{{ $car->model }}</p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            {{ __('Year') }}:
                        </h3>
                        <p class="text-gray-700 dark:text-gray-300">{{ $car->year }}</p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            {{ __('Last Service Date') }}:
                        </h3>
                        <p class="text-gray-700 dark:text-gray-300">
                            {{ $car->last_service_date ? __('No Service History') : __('No Service History') }}
                        </p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            {{ __('License Plate') }}:
                        </h3>
                        <p class="text-gray-700 dark:text-gray-300">{{ $car->license_plate }}</p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            {{ __('Engine Type') }}:
                        </h3>
                        <p class="text-gray-700 dark:text-gray-300">{{ ucfirst($car->engine_type) }}</p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            {{ __('Transmission') }}:
                        </h3>
                        <p class="text-gray-700 dark:text-gray-300">{{ ucfirst($car->transmission) }}</p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            {{ __('Mileage') }}:
                        </h3>
                        <p class="text-gray-700 dark:text-gray-300">{{ $car->mileage }} {{ __('km') }}</p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            {{ __('Image') }}:
                        </h3>
                        @if ($car->image)
                            <img src="{{ asset($car->image) }}" alt="{{ __('Car Image') }}" class="w-full rounded-lg shadow-md">
                        @else
                            <p class="text-gray-700 dark:text-gray-300">{{ __('No Image Uploaded') }}</p>
                        @endif
                    </div>

                    <div class="flex justify-center mt-6">
                        <a href="{{ route('cars.edit', $car->id) }}" class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white px-6 py-3 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105">
                            {{ __('Edit Car') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
