{{-- resources/views/components/active-offer-card.blade.php --}}
@props(['offer'])

<div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md mb-6">
    <h3 class="font-semibold text-xl text-gray-900 dark:text-gray-100">
        {{ __('Oferta ID:') }} {{ $offer->id }}
    </h3>
    <p class="text-gray-600 dark:text-gray-400">{{ __('Opis: ') }} {{ $offer->description }}</p>
    <p class="text-gray-600 dark:text-gray-400">{{ __('Cena: ') }} ${{ number_format($offer->price, 2) }}</p>
    <p class="text-gray-600 dark:text-gray-400">{{ __('Status: ') }}
        <span class="font-semibold text-blue-500">
            {{ ucfirst($offer->status) }}
        </span>
    </p>
    <p class="text-gray-600 dark:text-gray-400 text-sm">
        {{ __('Data: ') }} {{ $offer->date }} |
        {{ __('Godzina: ') }} {{ $offer->time }}
    </p>
    <p class="text-gray-600 dark:text-gray-400">
        Imie klienta: {{ $offer->serviceRequest->user->name }}
    </p>

    <form method="POST" action="{{ route('offers.updateStatus', $offer) }}">
        @csrf
        @method('PATCH')
        <button type="submit" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
            {{ __('Skończ naprawę') }}
        </button>
    </form>
</div>
