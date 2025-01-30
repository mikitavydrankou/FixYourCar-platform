<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Service Request Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow-lg sm:rounded-lg transform transition-transform duration-300 hover:shadow-2xl">
                <div class="max-w-2xl mx-auto space-y-8">

                    <!-- Галерея изображений -->
                    @if(count(json_decode($serviceRequest->attachments)) > 0)
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @foreach(json_decode($serviceRequest->attachments) as $image)
                                <div class="relative overflow-hidden rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                                    <img src="{{ asset($image) }}" alt="Service Image"
                                         class="w-full h-48 object-cover transform hover:scale-110 transition-transform duration-300">
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- Информация о заявке -->
                    <div class="space-y-6">
                        <!-- Марка и модель автомобиля -->
                        <div class="bg-gradient-to-r from-blue-50 to-purple-50 dark:from-gray-700 dark:to-gray-600 p-6 rounded-lg shadow-sm">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                                {{ __('Marka i model samochodu') }}
                            </h3>
                            <p class="text-gray-700 dark:text-gray-300 text-lg">
                                {{ $serviceRequest->car->make }} - {{ $serviceRequest->car->model }}
                            </p>
                        </div>

                        <!-- Описание проблемы -->
                        <div class="bg-gradient-to-r from-blue-50 to-purple-50 dark:from-gray-700 dark:to-gray-600 p-6 rounded-lg shadow-sm">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                                {{ __('Opis problemu') }}
                            </h3>
                            <p class="text-gray-700 dark:text-gray-300 text-lg">
                                {{ $serviceRequest->problem_description }}
                            </p>
                        </div>

                        <!-- Локализация -->
                        <div class="bg-gradient-to-r from-blue-50 to-purple-50 dark:from-gray-700 dark:to-gray-600 p-6 rounded-lg shadow-sm">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                                {{ __('Lokalizacja') }}
                            </h3>
                            <p class="text-gray-700 dark:text-gray-300 text-lg">
                                {{ $serviceRequest->location }}
                            </p>
                        </div>

                        <!-- Статус -->
                        <div class="bg-gradient-to-r from-blue-50 to-purple-50 dark:from-gray-700 dark:to-gray-600 p-6 rounded-lg shadow-sm">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                                {{ __('Status') }}
                            </h3>
                            <p class="text-gray-700 dark:text-gray-300 text-lg">
                                {{ ucfirst($serviceRequest->status) }}
                            </p>
                        </div>
                    </div>

                    <!-- Принятая оферта -->
                    @if($serviceRequest->selectedServiceOffer)
                        <div class="bg-gradient-to-r from-green-50 to-teal-50 dark:from-gray-700 dark:to-gray-600 p-6 rounded-lg shadow-sm">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                                {{ __('Przyjęta oferta') }}
                            </h3>
                            <p class="text-gray-700 dark:text-gray-300 text-lg">
                                {{ __('Serwis') }}: {{ $serviceRequest->selectedServiceOffer->service->user->name }}
                            </p>
                            <p class="text-gray-700 dark:text-gray-300 text-lg">
                                {{ __('Cena') }}: {{ $serviceRequest->selectedServiceOffer->price }} zł
                            </p>
                        </div>
                    @endif

                    <!-- Уведомление о статусе "pending" -->
                    @if($serviceRequest->status === 'pending')
                        <div class="bg-gradient-to-r from-yellow-50 to-orange-50 dark:from-gray-700 dark:to-gray-600 p-6 rounded-lg shadow-sm">
                            <p class="text-gray-700 dark:text-gray-300 text-lg">
                                Za chwilę właściciel serwisu „{{$serviceRequest->selectedServiceOffer->service->name}}”,
                                użytkownik „{{$serviceRequest->selectedServiceOffer->service->user->name}}”, połączy się z
                                Tobą. Obserwuj zakładkę „Czat”!
                            </p>
                        </div>
                    @endif

                    <!-- Форма для отзыва -->
                    @if($serviceRequest->status === 'review')
                        @if($serviceRequest->selectedServiceOffer && $serviceRequest->selectedServiceOffer->service)
                            <form action="{{ route('service.review', $serviceRequest->selectedServiceOffer->service) }}" method="POST" class="bg-gradient-to-r from-blue-50 to-purple-50 dark:from-gray-700 dark:to-gray-600 p-6 rounded-lg shadow-sm">
                                @csrf
                                <input type="hidden" name="service_request_id" value="{{ $serviceRequest->id }}">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">
                                    {{ __('Zostaw opinie') }}
                                </h3>
                                <div class="space-y-4">
                                    <label for="rating" class="block text-gray-700 dark:text-gray-300 text-lg">
                                        {{ __('Ocena (1-5)') }}
                                    </label>
                                    <select name="rating" id="rating" class="w-full p-3 border rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                                        <option value="5">⭐⭐⭐⭐⭐</option>
                                        <option value="4">⭐⭐⭐⭐</option>
                                        <option value="3">⭐⭐⭐</option>
                                        <option value="2">⭐⭐</option>
                                        <option value="1">⭐</option>
                                    </select>
                                    <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white px-6 py-3 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105">
                                        {{ __('Zostaw opinie') }}
                                    </button>
                                </div>
                            </form>
                        @else
                            <div class="bg-gradient-to-r from-red-50 to-pink-50 dark:from-gray-700 dark:to-gray-600 p-6 rounded-lg shadow-sm">
                                <p class="text-red-500 dark:text-red-400 text-lg">
                                    {{ __('Невозможно оставить отзыв: сервис отсутствует.') }}
                                </p>
                            </div>
                        @endif
                    @endif

                    <!-- Кнопки действий -->
                    <div class="flex flex-col sm:flex-row justify-center gap-4 mt-8">
                        <a href="{{ route('client.requests.edit', $serviceRequest) }}"
                           class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white px-6 py-3 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105 text-center">
                            {{ __('Edytuj zgłoszenie') }}
                        </a>
                        <form method="POST" action="{{ route('client.requests.destroy', $serviceRequest) }}" class="w-full sm:w-auto">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="w-full bg-gradient-to-r from-red-500 to-pink-600 hover:from-red-600 hover:to-pink-700 text-white px-6 py-3 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105"
                                    onclick="return confirm('Czy na pewno chcesz usunąć to zgłoszenie?')">
                                {{ __('Usuń zgłoszenie') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
