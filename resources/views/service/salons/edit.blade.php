<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edytuj warsztat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl mx-auto">
                    <form action="{{ route('service.update', $service->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <x-input-label for="name" :value="__('Nazwa')"/>
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ old('name', $service->name) }}" required/>
                            <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                        </div>

                        <div class="mb-6">
                            <x-input-label for="address" :value="__('Adres')"/>
                            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" value="{{ old('address', $service->address) }}" required/>
                            <x-input-error :messages="$errors->get('address')" class="mt-2"/>
                        </div>

                        <div class="mb-6">
                            <x-input-label for="phone" :value="__('Telefon')"/>
                            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" value="{{ old('phone', $service->phone) }}" required/>
                            <x-input-error :messages="$errors->get('phone')" class="mt-2"/>
                        </div>

                        <div class="mb-6">
                            <x-input-label for="email" :value="__('Email')"/>
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ old('email', $service->email) }}" required/>
                            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                        </div>

                        <div class="mb-6">
                            <x-input-label for="service_description" :value="__('Opis')"/>
                            <textarea id="service_description" name="service_description" class="block mt-1 w-full" rows="4" required>{{ old('service_description', $service->service_description) }}</textarea>
                            <x-input-error :messages="$errors->get('service_description')" class="mt-2"/>
                        </div>

                        <div class="flex justify-center mt-6">
                            <x-primary-button class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white px-6 py-3 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105">
                                {{ __('Zapisz zmiany') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
