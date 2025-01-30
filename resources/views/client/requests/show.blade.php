<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Service Request Details') }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl mx-auto">

                    @if(count(json_decode($serviceRequest->attachments)) > 0)
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                            @foreach(json_decode($serviceRequest->attachments) as $image)
                                <img src="{{ asset($image) }}" alt="Service Image" class="w-full h-48 object-cover rounded-lg shadow-md">
                            @endforeach
                        </div>
                    @endif

                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            {{ __('Marka i model samochodu') }}:
                        </h3>
                        <p class="text-gray-700 dark:text-gray-300">{{ $serviceRequest->car->make }} - {{ $serviceRequest->car->model }}</p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            {{ __('Opis_problemu') }}:
                        </h3>
                        <p class="text-gray-700 dark:text-gray-300">{{ $serviceRequest->problem_description }}</p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            {{ __('Lokalizacja') }}:
                        </h3>
                        <p class="text-gray-700 dark:text-gray-300">{{ $serviceRequest->location }}</p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            {{ __('Status') }}:
                        </h3>
                        <p class="text-gray-700 dark:text-gray-300">{{ ucfirst($serviceRequest->status) }}</p>
                    </div>

                    {{-- Информация о принятом оффере --}}
                    @if($serviceRequest->selectedServiceOffer)
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                                {{ __('Przyjęta oferta') }}:
                            </h3>
                            <p class="text-gray-700 dark:text-gray-300">
                                {{ __('Serwis') }}: {{ $serviceRequest->selectedServiceOffer->service->user->name }}
                            </p>
                            <p class="text-gray-700 dark:text-gray-300">
                                {{ __('Cena') }}: {{ $serviceRequest->selectedServiceOffer->price }}
                            </p>
                        </div>


                        <div class="text-lg font-medium text-gray-900 dark:text-white">
                            Za chwilę właściciel serwisu „{{$serviceRequest->selectedServiceOffer->service->name}}”, użytkownik „{{$serviceRequest->selectedServiceOffer->service->user->name}}”, połączy się z Tobą. Obserwuj zakładkę „Czat”!
                        </div>
                    @endif
                        <dd>{{$serviceRequest->status}}</dd>
                        @if($serviceRequest->status === 'review')
                            @if($serviceRequest->selectedServiceOffer)
                                @if($serviceRequest->selectedServiceOffer->service)
                                <form action="{{ route('service.review', $serviceRequest->selectedServiceOffer->service) }}" method="POST">
                                    @csrf
                                    <div class="mt-2">
                                        <label for="rating" class="text-sm text-gray-700 dark:text-gray-300">Оценка (1-5):</label>
                                        <select name="rating" id="rating" class="w-full p-2 border rounded">
                                            <option value="5">⭐⭐⭐⭐⭐</option>
                                            <option value="4">⭐⭐⭐⭐</option>
                                            <option value="3">⭐⭐⭐</option>
                                            <option value="2">⭐⭐</option>
                                            <option value="1">⭐</option>
                                        </select>
                                    </div>

                                    <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">
                                        Оставить отзыв
                                    </button>
                                </form>
                                @else
                                    <div class="text-red-500 dark:text-red-400">
                                        {{ __('Невозможно оставить отзыв: сервис отсутствует.') }}
                                    </div>
                                @endif
                            @else
                                <div class="text-red-500 dark:text-red-400">
                                    {{ __('Невозможно оставить отзыв: выбранное предложение отсутствует.') }}
                                </div>
                            @endif
                        @endif


                        <div class="flex justify-center mt-6 space-x-4">
                        <a href="{{ route('client.requests.edit', $serviceRequest) }}" class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white px-6 py-3 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105">
                            {{ __('Edytuj zgłoszenie') }}
                        </a>
                        <form method="POST" action="{{ route('client.requests.destroy', $serviceRequest) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-gradient-to-r from-red-500 to-pink-600 hover:from-red-600 hover:to-pink-700 text-white px-6 py-3 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105" onclick="return confirm('Confirm delete?')">
                                {{ __('Usuń zgłoszenie') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

