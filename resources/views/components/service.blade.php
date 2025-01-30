<div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg mx-auto max-w-full overflow-hidden transition-all duration-300 hover:shadow-2xl">
    <!-- Mobile & Desktop Version -->
    <div class="flex flex-wrap md:flex-nowrap">
        <!-- Content Section -->
        <div class="p-6 flex-1 flex flex-col justify-between">
            <div>
                <div class="flex justify-between items-center mb-4">
                    <h5 class="text-lg sm:text-xl md:text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ $service->name }}</h5>
                </div>
                <div class="space-y-2">
                    <p class="text-gray-600 dark:text-gray-400 text-sm flex items-center">📍 <span class="ml-2">{{ $service->address }}</span></p>
                    <p class="text-gray-600 dark:text-gray-400 text-sm flex items-center">📞 <a class="ml-2 text-blue-600 hover:underline">{{ $service->phone }}</a></p>
                    <p class="text-gray-600 dark:text-gray-400 text-sm flex items-center">✉️ <a class="ml-2 text-blue-600 hover:underline">{{ $service->email }}</a></p>
                    <p class="text-gray-600 dark:text-gray-400 text-sm flex items-center">📝 <span class="ml-2">{{ $service->service_description }}</span></p>
                    <p class="text-gray-600 dark:text-gray-400 text-sm flex items-center">⭐ <span class="ml-2 font-medium">{{ $service->averageRating() }}</span></p>
                </div>
            </div>
            <div class="flex flex-wrap justify-center gap-4 mt-6">
                <a href="{{ route('service.offers.index', ['service' => $service->id]) }}"
                   class="bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 text-white py-2 px-6 sm:py-3 sm:px-8 rounded-full transition duration-300 text-sm sm:text-base font-medium shadow-lg">
                    W toku
                </a>

                <a href="{{route('service.show', ['service' => $service])}}" class="bg-gradient-to-r from-green-500 to-green-700 hover:from-green-600 hover:to-green-800 text-white py-2 px-6 sm:py-3 sm:px-8 rounded-full transition duration-300 text-sm sm:text-base font-medium shadow-lg">Zarządzaj</a>
                <a href="{{route('service.offers.history')}}" class="bg-gradient-to-r from-gray-500 to-gray-700 hover:from-gray-600 hover:to-gray-800 text-white py-2 px-6 sm:py-3 sm:px-8 rounded-full transition duration-300 text-sm sm:text-base font-medium shadow-lg">Historia</a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="bg-gray-100 dark:bg-gray-700 text-center p-4 rounded-b-2xl">
        <small class="text-gray-600 dark:text-gray-300">
            <strong>Utworzono:</strong> {{ $service->created_at ?? 'N/A' }}<br>
            <strong>Zaktualizowano:</strong> {{ $service->updated_at ?? 'N/A' }}
        </small>
    </div>
</div>
