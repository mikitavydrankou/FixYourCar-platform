<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Historie wysłanych ofert') }}
        </h2>
    </x-slot>

    <div class="container mx-auto pt-4">
        <div class="w-full">
            @if (session('status'))
                <div class="bg-green-500 text-white p-4 rounded mb-4" role="alert" id="success-alert">
                    {{ session('status') }}
                </div>
                <script>
                    setTimeout(function () {
                        document.getElementById('success-alert').style.display = 'none';
                    }, 5000);
                </script>
            @endif

            @if ($errors->any())
                <div class="bg-red-500 text-white p-4 rounded mb-4" id="error-alert">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
                <script>
                    setTimeout(function () {
                        document.getElementById('error-alert').style.display = 'none';
                    }, 5000);
                </script>
            @endif
        </div>
    </div>

    <div class="container mx-auto p-md-5">
        <div class="w-full">
            <div class="grid grid-cols-1 gap-6">
                @if($offers->isEmpty())
                    <p class="text-gray-600 dark:text-gray-400 mb-4">{{ __('Nie wysłano jeszcze żadnych ofert.') }}</p>
                @else
                    @foreach($offers as $service)
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg">
                            <h3 class="font-semibold text-xl text-gray-900 dark:text-gray-100 mb-4">
                                <i class="fas fa-tools mr-2"></i> {{ __('Usługa: ') }} {{ $service->name }}
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                <div>
                                    <p class="text-gray-600 dark:text-gray-400">
                                        <i class="fas fa-map-marker-alt mr-2"></i> {{ __('Adres: ') }} {{ $service->address }}
                                    </p>
                                    <p class="text-gray-600 dark:text-gray-400">
                                        <i class="fas fa-phone mr-2"></i> {{ __('Tel: ') }} {{ $service->phone }}
                                    </p>
                                    <p class="text-gray-600 dark:text-gray-400">
                                        <i class="fas fa-envelope mr-2"></i> {{ __('Email: ') }} {{ $service->email }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-gray-600 dark:text-gray-400">
                                        <i class="fas fa-calendar-alt mr-2"></i> {{ __('Data rejestracji: ') }} {{ $service->created_at->format('d M Y') }}
                                    </p>
                                </div>
                            </div>

                            @if($service->serviceOffers->isEmpty())
                                <p class="text-gray-500 dark:text-gray-400 mt-4">{{ __('Brak ofert na tę usługę.') }}</p>
                            @else
                                <ul class="space-y-4">
                                    @foreach($service->serviceOffers as $offer)
                                        <li class="bg-gray-100 dark:bg-gray-700 p-6 rounded-lg shadow-md">
                                            <h4 class="font-semibold text-lg text-gray-800 dark:text-gray-200 mb-4">
                                                <i class="fas fa-file-invoice mr-2"></i> {{ __('Oferta ID: ') }} {{ $offer->id }}
                                            </h4>
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div>
                                                    <p class="text-gray-700 dark:text-gray-300">
                                                        <i class="fas fa-align-left mr-2"></i> {{ __('Opis: ') }} {{ $offer->description }}
                                                    </p>
                                                    <p class="text-gray-700 dark:text-gray-300">
                                                        <i class="fas fa-dollar-sign mr-2"></i> {{ __('Cena: ') }} zł{{ number_format($offer->price, 2) }}
                                                    </p>
                                                    <p class="text-gray-700 dark:text-gray-300">
                                                        <i class="fas fa-info-circle mr-2"></i> {{ __('Status oferty: ') }}
                                                        <span class="font-semibold
                                                            {{ $offer->status === 'sent' ? 'text-blue-500' : ($offer->status === 'accepted' ? 'text-green-500' : 'text-gray-800') }}">
                                                            {{ ucfirst($offer->status) }}
                                                        </span>
                                                    </p>
                                                </div>
                                                <div>
                                                    <p class="text-gray-700 dark:text-gray-300">
                                                        <i class="fas fa-calendar-day mr-2"></i> {{ __('Data wizyty: ') }} {{ \Carbon\Carbon::parse($offer->date)->format('d M Y') }}
                                                    </p>
                                                    <p class="text-gray-700 dark:text-gray-300">
                                                        <i class="fas fa-clock mr-2"></i> {{ __('Godzina wizyty: ') }} {{ \Carbon\Carbon::parse($offer->time)->format('H:i') }}
                                                    </p>
                                                    <p class="text-gray-700 dark:text-gray-300">
                                                        <i class="fas fa-exclamation-circle mr-2"></i> {{ __('Status zgłoszenia: ') }}
                                                        <span class="font-semibold">
                                                            {{ $offer->serviceRequest->status }}
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="mt-4">
                                                <p class="text-gray-700 dark:text-gray-300">
                                                    <i class="fas fa-comment-dots mr-2"></i> {{ __('Opis problemu: ') }}
                                                    <span class="font-semibold">
                                                        {{ $offer->serviceRequest->problem_description }}
                                                    </span>
                                                </p>
                                                <p class="text-gray-700 dark:text-gray-300">
                                                    <i class="fas fa-exclamation-triangle mr-2"></i> {{ __('Pilność: ') }}
                                                    <span class="font-semibold">
                                                        {{ $offer->serviceRequest->urgency }}
                                                    </span>
                                                </p>
                                                <p class="text-gray-700 dark:text-gray-300">
                                                    <i class="fas fa-map-pin mr-2"></i> {{ __('Lokalizacja: ') }}
                                                    <span class="font-semibold">
                                                        {{ $offer->serviceRequest->location }}
                                                    </span>
                                                </p>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
