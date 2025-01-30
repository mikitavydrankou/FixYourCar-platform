@props(['offer'])

<div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg mx-auto max-w-full overflow-hidden">
    <!-- Desktop Version -->
    <div class="hidden md:flex flex-wrap md:flex-nowrap">
        <!-- Content Section -->
        <div class="p-4 flex-1 flex flex-col justify-between">
            <div>
                <h5 class="text-lg md:text-xl font-semibold text-gray-800 dark:text-gray-100">
                    Oferta od serwisu: {{ $offer->service->name }}
                </h5>
                <p class="text-gray-600 dark:text-gray-400 text-sm">
                    <strong>Cena:</strong> {{ $offer->price }} zł
                </p>
                <p class="text-gray-600 dark:text-gray-400 text-sm">
                    <strong>Opis:</strong> {{ $offer->description }}
                </p>
                <p class="text-gray-600 dark:text-gray-400 text-sm">
                    <strong>Opis:</strong> {{ $offer->service->averageRating() }}
                </p>
                <div class="flex items-center text-sm mt-2">
                    <p class="mt-2 text-gray-700">
                        <strong>Статус:</strong>
                        <span
                            class="px-3 py-1 rounded-full text-white text-sm font-semibold bg-{{ $offer->status == 'accepted' ? 'green-500' : 'gray-500' }}">
                                {{ ucfirst($offer->status) }}
                        </span>
                    </p>
                </div>
                <p class="text-gray-500 text-sm mt-2">
                    <strong>Data wizyty:</strong> {{ $offer->date }}
                </p>
                <p class="text-gray-500 text-sm">
                    <strong>Czas wizyty:</strong> {{ $offer->time }}
                </p>
            </div>
            <div class="flex flex-wrap justify-end space-y-2 sm:space-y-0 sm:space-x-3 mt-4">
                <form action="{{ route('offers.accept', $offer->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-lg transition duration-200 text-sm font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1.5-9.5a.5.5 0 01.7 0l2.5 2.5a.5.5 0 11-.7.7L9 10.707l-1.15 1.15a.5.5 0 01-.7-.7l1.5-1.5z" clip-rule="evenodd" />
                        </svg>
                        <span class="ml-2">Zgadzam się na usługę</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Mobile Version -->
    <div class="block md:hidden">
        <div class="p-4">
            <h5 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                Оффер от сервиса #{{ $offer->service_id }}
            </h5>
            <p class="text-gray-600 dark:text-gray-400 text-sm">
                <strong>Цена:</strong> {{ $offer->price }} zł
            </p>
            <p class="text-gray-600 dark:text-gray-400 text-sm">
                <strong>Описание:</strong> {{ $offer->description }}
            </p>
            <div class="flex items-center text-sm mt-2">
                <p class="mt-2 text-gray-700">
                    <strong>Статус:</strong>
                    <span
                        class="px-3 py-1 rounded-full text-white text-sm font-semibold bg-{{ $offer->status == 'accepted' ? 'green-500' : 'gray-500' }}">
                                {{ ucfirst($offer->status) }}
                        </span>
                </p>
            </div>
            <p class="text-gray-500 text-sm mt-2">
                <strong>Data wizyty:</strong> {{ $offer->date }}
            </p>
            <p class="text-gray-500 text-sm">
                <strong>Czas wizyty:</strong> {{ $offer->time }}
            </p>
            <div class="flex flex-col space-y-3 mt-4">
                <form action="{{ route('offers.accept', $offer->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-lg transition duration-200 text-sm font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1.5-9.5a.5.5 0 01.7 0l2.5 2.5a.5.5 0 11-.7.7L9 10.707l-1.15 1.15a.5.5 0 01-.7-.7l1.5-1.5z" clip-rule="evenodd" />
                        </svg>
                        <span class="ml-2">Согласиться</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
