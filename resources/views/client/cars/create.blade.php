<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dodaj samochód') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl mx-auto">
                    <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-6">
                            <x-input-label for="make" :value="__('Marka')"/>
                            <x-text-input id="make" class="block mt-1 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm" type="text" name="make" :value="old('make')" required autofocus autocomplete="make"/>
                            <x-input-error :messages="$errors->get('make')" class="mt-2"/>
                        </div>

                        <div class="mb-6">
                            <x-input-label for="model" :value="__('Model')"/>
                            <x-text-input id="model" class="block mt-1 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm" type="text" name="model" :value="old('model')" required autofocus autocomplete="model"/>
                            <x-input-error :messages="$errors->get('model')" class="mt-2"/>
                        </div>

                        <div class="mb-6">
                            <x-input-label for="year" :value="__('Rok')"/>
                            <select id="year" name="year" class="block mt-1 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm" required>
                                @for ($i = date('Y'); $i >= 1886; $i--)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            <x-input-error :messages="$errors->get('year')" class="mt-2"/>
                        </div>

                        <div class="mb-6">
                            <x-input-label for="last_service_date" :value="__('Data ostatniej usługi (opcjonalnie)')"/>
                            <div class="flex items-center space-x-4">
                                <select id="last_service_date" name="last_service_date" class="block mt-1 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm">
                                    <option value="">{{ __('Wybierz rok') }}</option>
                                </select>
                                <div class="ml-4 flex items-center">
                                    <input class="form-check-input" type="checkbox" id="no_service_checkbox">
                                    <label class="form-check-label text-gray-700 dark:text-gray-300" for="no_service_checkbox">
                                        {{ __('Brak historii serwisowej') }}
                                    </label>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('last_service_date')" class="mt-2"/>
                        </div>

                        <div class="mb-6">
                            <x-input-label for="license_plate" :value="__('Tablica rejestracyjna')"/>
                            <x-text-input id="license_plate" class="block mt-1 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm" type="text" name="license_plate" :value="old('license_plate')" required autocomplete="license_plate"/>
                            <x-input-error :messages="$errors->get('license_plate')" class="mt-2"/>
                        </div>

                        <div class="mb-6">
                            <x-input-label for="engine_type" :value="__('Typ silnika')"/>
                            <select id="engine_type" name="engine_type" class="block mt-1 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm" required>
                                <option value="diesel">{{ __('Diesel') }}</option>
                                <option value="petrol">{{ __('Benzyna') }}</option>
                                <option value="gas">{{ __('Gaz') }}</option>
                                <option value="hybrid">{{ __('Hybrydowy') }}</option>
                                <option value="electric">{{ __('Elektryczny') }}</option>
                            </select>
                            <x-input-error :messages="$errors->get('engine_type')" class="mt-2"/>
                        </div>

                        <div class="mb-6">
                            <x-input-label for="transmission" :value="__('Przenoszenie')"/>
                            <select id="transmission" name="transmission" class="block mt-1 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm" required>
                                <option value="manual">{{ __('Manual') }}</option>
                                <option value="automated">{{ __('Zautomatyzowane') }}</option>
                                <option value="automatic">{{ __('Automatyczny') }}</option>
                            </select>
                            <x-input-error :messages="$errors->get('transmission')" class="mt-2"/>
                        </div>

                        <div class="mb-6">
                            <x-input-label for="mileage" :value="__('Przebieg')"/>
                            <x-text-input id="mileage" class="block mt-1 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm" type="number" name="mileage" :value="old('mileage')" required/>
                            <x-input-error :messages="$errors->get('mileage')" class="mt-2"/>
                        </div>

                        <div class="mb-6">
                            <x-input-label for="image" :value="__('Prześlij obraz')"/>
                            <div class="mt-2">
                                <label for="image" class="block w-full p-4 border-2 border-dashed border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg text-center cursor-pointer hover:border-gray-400 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <span class="text-sm text-gray-600 dark:text-gray-300">
                                        {{ __('Kliknij, aby przesłać plik') }}
                                    </span>
                                </label>
                                <input id="image" name="image" type="file" class="hidden" onchange="showSuccessIndicator()"/>
                            </div>
                            <div id="success-indicator" class="mt-2 hidden">
                                <span class="text-green-600 font-medium">
                                    ✔ {{ __('File uploaded successfully') }}
                                </span>
                            </div>
                            <x-input-error :messages="$errors->get('image')" class="mt-2"/>
                        </div>

                        <script>
                            function showSuccessIndicator() {
                                const indicator = document.getElementById('success-indicator');
                                indicator.classList.remove('hidden'); // Show success indicator
                            }
                        </script>

                        <div class="flex justify-center mt-6">
                            <x-primary-button class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white px-6 py-3 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105">
                                {{ __('Dodaj samochód') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const currentYear = new Date().getFullYear();

            document.getElementById('year').addEventListener('change', function () {
                const selectedYear = parseInt(this.value);
                const serviceDateSelect = document.getElementById('last_service_date');

                serviceDateSelect.innerHTML = '<option value="">{{ __('Select Year') }}</option>';

                for (let i = selectedYear + 1; i <= currentYear; i++) {
                    const option = document.createElement('option');
                    option.value = i;
                    option.textContent = i;
                    serviceDateSelect.appendChild(option);
                }
            });

            document.getElementById('no_service_checkbox').addEventListener('change', function () {
                const isChecked = this.checked;
                const serviceDateSelect = document.getElementById('last_service_date');
                serviceDateSelect.disabled = isChecked;

                if (isChecked) {
                    serviceDateSelect.value = '';
                }
            });
        });
    </script>
</x-app-layout>
