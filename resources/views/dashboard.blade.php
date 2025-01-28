<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Główna strona') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-5xl">Jak działa platforma?</h1>
                    <br>
                    <h1>Dla właściciela samochodu:</h1>
                    <h1>1. Należy dodać swój samochód w zakładce "Moje samochody".</h1>
                    <h1>2. Następnie trzeba zgłosić naprawę poprzez "Moje zgłoszenia".</h1>
                    <h1>3. Warsztaty będą wysyłać swoje oferty – możesz wybrać tę, która najbardziej Ci odpowiada.</h1>
                    <h1>4. Po zaakceptowaniu oferty masz możliwość kontaktu przez czat.</h1>
                    <h1>5. Po zakończonej naprawie (gdy warsztat zmieni status zgłoszenia), status Twojego zgłoszenia również zostanie zmieniony na "zakończone".</h1>
                    <h1>6. Po otrzymaniu usługi możesz wystawić opinię.</h1>

                    <br>
                    <h1>Dla serwisu:</h1>
                    <h1>1. Należy dodać swój warsztat w zakładce "Warsztaty".</h1>
                    <h1>2. W sekcji "Zgłoszenia" można przeglądać zgłoszenia użytkowników i na nie odpowiadać.</h1>
                    <h1>3. Warsztaty wysyłają swoje oferty, spośród których klient wybiera najlepszą dla siebie.</h1>
                    <h1>4. Po zaakceptowaniu oferty przez klienta masz możliwość kontaktu przez czat.</h1>
                    <h1>5. Po wykonaniu naprawy możesz zmienić status zgłoszenia na "zakończone".</h1>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
