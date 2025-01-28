<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Twoje samochody') }}
        </h2>
    </x-slot>
    <div class="py-12 ">
        <div class="mx-auto sm:px-6 lg:px-8 space-y-6 ">
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

            <!-- Cars Section -->
            <div class="p-6 bg-white dark:bg-gray-800 shadow-lg sm:rounded-lg ">
                <div class="max-w-full ">
                    @isset($cars)
                        @if ($cars->isEmpty())
                            <p class="text-gray-600 dark:text-gray-400 mb-4">{{ __('Nie dodałeś jeszcze żadnego samochodu.') }}</p>
                            <a href="{{ route('cars.create') }}"
                               class="inline-flex items-center px-4 py-2 bg-blue-500 text-white text-sm font-semibold rounded-lg shadow-md hover:bg-blue-600 transition">
                                {{ __('Dodaj samochód') }}
                            </a>
                        @else
                            <ul class="space-y-6">
                                @foreach ($cars as $car)
                                    <li>
                                        <x-car :car="$car"/>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="mt-6">
                                <a href="{{ route('cars.create') }}"
                                   class="inline-flex items-center px-4 py-2 bg-blue-500 text-white text-sm font-semibold rounded-lg shadow-md hover:bg-blue-600 transition">
                                    {{ __('Dodaj kolejny samochód') }}
                                </a>
                            </div>
                        @endif
                    @endisset
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
