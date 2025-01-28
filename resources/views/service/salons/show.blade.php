<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Szczegóły warsztatu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl mx-auto">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ __('Nazwa') }}:</h3>
                        <p class="text-gray-700 dark:text-gray-300">{{ $service->name }}</p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ __('Adres') }}:</h3>
                        <p class="text-gray-700 dark:text-gray-300">{{ $service->address }}</p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ __('Telefon') }}:</h3>
                        <p class="text-gray-700 dark:text-gray-300">{{ $service->phone }}</p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ __('Email') }}:</h3>
                        <p class="text-gray-700 dark:text-gray-300">{{ $service->email }}</p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ __('Opis') }}:</h3>
                        <p class="text-gray-700 dark:text-gray-300">{{ $service->service_description }}</p>
                    </div>

                    <div class="flex justify-center mt-6 space-x-4">
                        <a href="{{ route('service.edit', $service) }}" class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white px-6 py-3 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105">
                            {{ __('Edytuj warsztat') }}
                        </a>
                        <form method="POST" action="{{ route('service.destroy', $service) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-gradient-to-r from-red-500 to-pink-600 hover:from-red-600 hover:to-pink-700 text-white px-6 py-3 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105" onclick="return confirm('Czy na pewno chcesz usunąć warsztat?')">
                                {{ __('Usuń warsztat') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
