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
                            {{ __('
Marka i model samochodu') }}:
                        </h3>
                        <p class="text-gray-700 dark:text-gray-300">{{ $serviceRequest->car->make }} - {{ $serviceRequest->car->model }}</p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            {{ __('
Opis_problemu') }}:
                        </h3>
                        <p class="text-gray-700 dark:text-gray-300">{{ $serviceRequest->problem_description }}</p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            {{ __('
Lokalizacja') }}:
                        </h3>
                        <p class="text-gray-700 dark:text-gray-300">{{ $serviceRequest->location }}</p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            {{ __('Status') }}:
                        </h3>
                        <p class="text-gray-700 dark:text-gray-300">{{ ucfirst($serviceRequest->status) }}</p>
                    </div>

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
