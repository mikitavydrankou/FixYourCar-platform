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
            <div class="grid grid-cols-1 gap-4">
                @if($offers->isEmpty())
                    <p class="text-gray-600 dark:text-gray-400 mb-4">{{ __('No offers sent yet.') }}</p>
                @else
                    @foreach($offers as $service)
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md mb-6">
                            <h3 class="font-semibold text-xl text-gray-900 dark:text-gray-100">
                                {{ __('Service:') }} {{ $service->name }}
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400">{{ __('Address: ') }} {{ $service->address }}</p>
                            <p class="text-gray-600 dark:text-gray-400">{{ __('Phone: ') }} {{ $service->phone }}</p>
                            <p class="text-gray-600 dark:text-gray-400">{{ __('Email: ') }} {{ $service->email }}</p>

                            @if($service->serviceOffers->isEmpty())
                                <p class="text-gray-500 dark:text-gray-400 mt-4">{{ __('No offers for this service.') }}</p>
                            @else
                                <ul class="list-none mt-4">
                                    @foreach($service->serviceOffers as $offer)
                                        <li class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-sm mb-4">
                                            <h4 class="font-semibold text-lg text-gray-800 dark:text-gray-200">
                                                {{ __('Offer ID:') }} {{ $offer->id }}
                                            </h4>
                                            <p class="text-gray-700 dark:text-gray-300">{{ __('Description: ') }} {{ $offer->description }}</p>
                                            <p class="text-gray-700 dark:text-gray-300">{{ __('Price: ') }} ${{ number_format($offer->price, 2) }}</p>
                                            <p class="text-gray-700 dark:text-gray-300">{{ __('Status: ') }}
                                                <span class="font-semibold
                                                    {{ $offer->status === 'sent' ? 'text-blue-500' : ($offer->status === 'accepted' ? 'text-green-500' : 'text-red-500') }}">
                                                    {{ ucfirst($offer->status) }}
                                                </span>
                                            </p>
                                            <p class="text-gray-600 dark:text-gray-400 text-sm">
                                                {{ __('Date: ') }} {{ \Carbon\Carbon::parse($offer->date)->format('d M Y') }} |
                                                {{ __('Time: ') }} {{ \Carbon\Carbon::parse($offer->time)->format('H:i') }}
                                            </p>
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
