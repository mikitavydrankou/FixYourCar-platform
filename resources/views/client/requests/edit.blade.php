<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edytuj zgłoszenie') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl mx-auto">
                    <form action="{{ route('client.requests.update', $serviceRequest) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <!-- Problem Description -->
                        <div class="mb-6">
                            <x-input-label for="problem_description" :value="__('Opis problemu')" />
                            <x-text-input id="problem_description" class="block mt-1 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm" type="text" name="problem_description" :value="old('problem_description', $serviceRequest->problem_description)" required autofocus />
                            <x-input-error :messages="$errors->get('problem_description')" class="mt-2" />
                        </div>

                        <!-- Urgency -->
                        <div class="mb-6">
                            <x-input-label for="urgency" :value="__('Pilność')" />
                            <select id="urgency" name="urgency" class="block mt-1 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm" required>
                                <option value="low" {{ old('urgency', $serviceRequest->urgency) == 'low' ? 'selected' : '' }}>{{ __('Niewielkie znaczenie') }}</option>
                                <option value="medium" {{ old('urgency', $serviceRequest->urgency) == 'medium' ? 'selected' : '' }}>{{ __('Średnie znaczenie') }}</option>
                                <option value="high" {{ old('urgency', $serviceRequest->urgency) == 'high' ? 'selected' : '' }}>{{ __('Duże znaczenie') }}</option>
                            </select>
                            <x-input-error :messages="$errors->get('urgency')" class="mt-2" />
                        </div>

                        <!-- Location -->
                        <div class="mb-6">
                            <x-input-label for="location" :value="__('Lokalizacja')" />
                            <x-text-input id="location" class="block mt-1 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm" type="text" name="location" :value="old('location', $serviceRequest->location)" required />
                            <x-input-error :messages="$errors->get('location')" class="mt-2" />
                        </div>

                        <div class="mb-6">
                            <x-input-label for="attachments" :value="__('Zdjęcia (do 3 sztuk)')" />
                            <div class="mt-2">
                                <label for="attachments" class="block w-full p-4 border-2 border-dashed border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg text-center cursor-pointer hover:border-gray-400 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <span class="text-sm text-gray-600 dark:text-gray-300">{{ __('Kliknij, aby wybrać zdjęcia') }}</span>
                                </label>
                                <input id="attachments" name="attachments[]" type="file" class="hidden" multiple accept="image/*" onchange="updateFileList()" />
                            </div>
                            <div id="file-list" class="mt-2 text-gray-700 dark:text-gray-300"></div>
                            <x-input-error :messages="$errors->get('attachments')" class="mt-2" />
                        </div>

                        <script>
                            function updateFileList() {
                                const input = document.getElementById('attachments');
                                const fileListContainer = document.getElementById('file-list');
                                fileListContainer.innerHTML = ''; // Очищаем список перед обновлением

                                if (input.files.length > 0) {
                                    let list = `<p>{{ __('Załadowane pliki') }}: ${input.files.length}</p><ul class="list-disc pl-5">`;
                                    for (let file of input.files) {
                                        list += `<li>${file.name}</li>`;
                                    }
                                    list += '</ul>';
                                    fileListContainer.innerHTML = list;
                                }
                            }
                        </script>

                        <!-- Submit Button -->
                        <div class="flex justify-center mt-6">
                            <x-primary-button class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white px-6 py-3 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105">
                                {{ __('Zapisz') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
