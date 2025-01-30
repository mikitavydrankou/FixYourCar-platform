<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Aktywne oferty dla usługi: ') }} {{ $service->name }}
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
                @if($activeOffers->isEmpty())
                    <p class="text-gray-600 dark:text-gray-400 mb-4">{{ __('Brak aktywnych ofert.') }}</p>
                @else
                    @foreach($activeOffers as $offer)
                        <x-active-offer-card :offer="$offer"/>
                    @endforeach

                    <h3 class="font-semibold text-xl text-gray-900 dark:text-gray-100">
                            Aby skontaktować się z klientem przez czat, wejdz do wkładki "Czat", kliknij przycisk "Stworzenia nowego czatu" i wyszukaj ego Imię
                        </h3>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
