<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Car') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="make" class="block text-gray-700 dark:text-gray-300">{{ __('Make') }}</label>
                            <input id="make" type="text" class="form-control w-full" name="make" required>
                        </div>

                        <div class="mb-4">
                            <label for="model" class="block text-gray-700 dark:text-gray-300">{{ __('Model') }}</label>
                            <input id="model" type="text" class="form-control w-full" name="model" required>
                        </div>

                        <div class="mb-4">
                            <label for="year" class="block text-gray-700 dark:text-gray-300">{{ __('Year') }}</label>
                            <select id="year" name="year" class="form-control w-full" required>
                                @for ($i = date('Y'); $i >= 1886; $i--)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="last_service_date" class="block text-gray-700 dark:text-gray-300">{{ __('Last Service Date (optional)') }}</label>
                            <div class="flex items-center">
                                <select id="last_service_date" name="last_service_date" class="form-control w-full">
                                    <option value="">{{ __('Select Year') }}</option>
                                </select>
                                <div class="ml-4">
                                    <input class="form-check-input" type="checkbox" id="no_service_checkbox">
                                    <label class="form-check-label text-gray-700 dark:text-gray-300" for="no_service_checkbox">
                                        {{ __('No Service History') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="license_plate" class="block text-gray-700 dark:text-gray-300">{{ __('License Plate') }}</label>
                            <input id="license_plate" type="text" class="form-control w-full" name="license_plate" required>
                        </div>

                        <div class="mb-4">
                            <label for="engine_type" class="block text-gray-700 dark:text-gray-300">{{ __('Engine Type') }}</label>
                            <select id="engine_type" name="engine_type" class="form-control w-full" required>
                                <option value="diesel">{{ __('Diesel') }}</option>
                                <option value="petrol">{{ __('Petrol') }}</option>
                                <option value="gas">{{ __('Gas') }}</option>
                                <option value="hybrid">{{ __('Hybrid') }}</option>
                                <option value="electric">{{ __('Electric') }}</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="transmission" class="block text-gray-700 dark:text-gray-300">{{ __('Transmission') }}</label>
                            <select id="transmission" name="transmission" class="form-control w-full" required>
                                <option value="manual">{{ __('Manual') }}</option>
                                <option value="automated">{{ __('Automated') }}</option>
                                <option value="automatic">{{ __('Automatic') }}</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="mileage" class="block text-gray-700 dark:text-gray-300">{{ __('Mileage') }}</label>
                            <input id="mileage" type="number" class="form-control w-full" name="mileage" required>
                            @if ($errors->has('mileage'))
                                <span class="text-sm text-red-600">{{ $errors->first('mileage') }}</span>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label for="image" class="block text-gray-700 dark:text-gray-300">{{ __('Upload Image') }}</label>
                            <div class="mt-2">
                                <input type="file" name="image" id="image">
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="btn btn-primary">{{ __('Add Car') }}</button>
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
