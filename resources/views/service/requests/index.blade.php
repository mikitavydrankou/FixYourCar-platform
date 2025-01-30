<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Zgłoszenia w pobliżu') }}
        </h2>
    </x-slot>

    <script>
        function selectRequest(button) {
            const serviceRequestId = button.getAttribute('data-id');
            const serviceRequestInfo = button.getAttribute('data-info');

            document.getElementById('selected_service_request_display').value = serviceRequestInfo;
            document.getElementById('selected_service_request_id').value = serviceRequestId;

            // Скрываем сообщение об ошибке, если оно было показано
            document.getElementById('error-message').classList.add('hidden');
        }

        function validateForm() {
            const selectedRequestId = document.getElementById('selected_service_request_id').value;
            const errorMessage = document.getElementById('error-message');

            if (!selectedRequestId) {
                errorMessage.classList.remove('hidden'); // Показываем сообщение об ошибке
                return false; // Останавливаем отправку формы
            }

            errorMessage.classList.add('hidden'); // Скрываем сообщение об ошибке, если оно было показано ранее
            return true; // Продолжаем отправку формы
        }
    </script>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Status Messages -->
            @if (session('status'))
                <div class="p-4 sm:p-8 bg-green-100 dark:bg-green-800 shadow sm:rounded-lg" id="success-alert">
                    <div class="text-green-800 dark:text-green-100">
                        {{ session('status') }}
                    </div>
                </div>
                <script>
                    setTimeout(function () {
                        document.getElementById('success-alert').style.display = 'none';
                    }, 5000);
                </script>
            @endif
            @if ($errors->any())
                <div class="p-4 sm:p-8 bg-red-100 dark:bg-red-800 shadow sm:rounded-lg" id="error-alert">
                    <div class="text-red-800 dark:text-red-100">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
                <script>
                    setTimeout(function () {
                        document.getElementById('error-alert').style.display = 'none';
                    }, 5000);
                </script>
            @endif

            <!-- Content Section -->
            <div class="flex flex-col lg:flex-row gap-6">
                <!-- Form (Mobile: First, Desktop: Right) -->
                <div class="w-full lg:w-1/4 order-1 lg:order-2">
                    <form action="{{ route('service.offers.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg">
                        @csrf
                        <div class="mb-4">
                            <label for="selected_service_request_display" class="block text-gray-700 dark:text-gray-300">Wybrane zgłoszenie</label>
                            <input type="text" id="selected_service_request_display" class="mt-2 p-2 w-full border rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300" value="Wybierz zgłoszenie" disabled required>
                            <input type="hidden" id="selected_service_request_id" name="service_request_id" value="" required>
                            <span id="error-message" class="text-red-500 text-sm hidden">Proszę wybrać zgłoszenie.</span>
                        </div>

                        <div class="mb-4">
                            <label for="service_id" class="block text-gray-700 dark:text-gray-300">Wybierz warsztat</label>
                            <select id="service_id" name="service_id" class="mt-2 p-2 w-full border rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300" required>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 dark:text-gray-300">Powiadomienie</label>
                            <textarea id="description" name="description" class="mt-2 p-2 w-full border rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300" rows="4" required></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="price" class="block text-gray-700 dark:text-gray-300">Cena</label>
                            <input id="price" type="number" name="price" class="mt-2 p-2 w-full border rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 dark:text-gray-300">Wybierz datę wizyty</label>
                            <input value="2025-01-10" id="date" type="date" name="date" class="mt-2 p-2 w-full border rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300" required>
                            <input id="time" type="time" name="time" class="mt-2 p-2 w-full border rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300" required>
                        </div>

                        <button type="submit" class="w-full py-2 bg-blue-500 text-white rounded-lg shadow-md hover:bg-blue-600 transition">Wyślij ofertę</button>
                    </form>
                </div>

                <!-- Service Requests List (Mobile: Second, Desktop: Left) -->
                <div class="w-full lg:w-3/4 order-2 lg:order-1 bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg">
                    @isset($service_requests)
                        @if($service_requests->isEmpty())
                            <p class="text-gray-600 dark:text-gray-400 mb-4">No service requests available.</p>
                        @else
                            <ul class="space-y-4">
                                @foreach($service_requests as $service_request)
                                    @if($service_request->status == 'waiting')
                                        <li>
                                            <x-service_request :service_request="$service_request"/>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        @endif
                    @endisset
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
