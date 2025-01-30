<div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg mx-auto max-w-full overflow-hidden transition-all duration-300 hover:shadow-2xl">
    <!-- Mobile & Desktop Version -->
    <div class="flex flex-wrap md:flex-nowrap">
        <!-- Content Section -->
        <div class="p-6 flex-1 flex flex-col justify-between">
            <div>
                <!-- Header Section -->
                <div class="flex justify-between items-center mb-4">
                    <h5 class="text-lg sm:text-xl md:text-2xl font-semibold text-gray-900 dark:text-gray-100">
                        <i class="fas fa-tools mr-2"></i> {{ $service->name }}
                    </h5>
                </div>

                <!-- Details Section -->
                <div class="space-y-3">
                    <!-- Address -->
                    <p class="text-gray-600 dark:text-gray-400 text-sm flex items-center">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        <span>{{ $service->address }}</span>
                    </p>

                    <!-- Phone -->
                    <p class="text-gray-600 dark:text-gray-400 text-sm flex items-center">
                        <i class="fas fa-phone mr-2"></i>
                        <a href="tel:{{ $service->phone }}" class="text-blue-600 hover:underline">{{ $service->phone }}</a>
                    </p>

                    <!-- Email -->
                    <p class="text-gray-600 dark:text-gray-400 text-sm flex items-center">
                        <i class="fas fa-envelope mr-2"></i>
                        <a href="mailto:{{ $service->email }}" class="text-blue-600 hover:underline">{{ $service->email }}</a>
                    </p>

                    <!-- Service Description -->
                    <p class="text-gray-600 dark:text-gray-400 text-sm flex items-center">
                        <i class="fas fa-file-alt mr-2"></i>
                        <span>{{ $service->service_description }}</span>
                    </p>

                    <!-- Average Rating -->
                    <p class="text-gray-600 dark:text-gray-400 text-sm flex items-center">
                        <i class="fas fa-star mr-2"></i>
                        <span class="font-medium">
                            {{ $service->averageRating() ?? 'Brak ocen' }}
                        </span>
                    </p>
                </div>
            </div>

            <!-- Buttons Section -->
            <div class="flex flex-wrap justify-center gap-4 mt-6">
                <!-- "W toku" Button -->
                <a href="{{ route('service.offers.index', ['service' => $service->id]) }}"
                   class="bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 text-white py-2 px-6 sm:py-3 sm:px-8 rounded-full transition duration-300 text-sm sm:text-base font-medium shadow-lg hover:shadow-xl">
                    <i class="fas fa-tasks mr-2"></i> W toku
                </a>

                <!-- "Zarządzaj" Button -->
                <a href="{{ route('service.show', ['service' => $service]) }}"
                   class="bg-gradient-to-r from-green-500 to-green-700 hover:from-green-600 hover:to-green-800 text-white py-2 px-6 sm:py-3 sm:px-8 rounded-full transition duration-300 text-sm sm:text-base font-medium shadow-lg hover:shadow-xl">
                    <i class="fas fa-cog mr-2"></i> Zarządzaj
                </a>

                <!-- "Historia" Button -->
                <a href="{{ route('service.offers.history') }}"
                   class="bg-gradient-to-r from-gray-500 to-gray-700 hover:from-gray-600 hover:to-gray-800 text-white py-2 px-6 sm:py-3 sm:px-8 rounded-full transition duration-300 text-sm sm:text-base font-medium shadow-lg hover:shadow-xl">
                    <i class="fas fa-history mr-2"></i> Historia
                </a>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <div class="bg-gray-100 dark:bg-gray-700 text-center p-4 rounded-b-2xl">
        <small class="text-gray-600 dark:text-gray-300">
            <i class="fas fa-calendar-plus mr-1"></i> <strong>Utworzono:</strong> {{ $service->created_at->format('d M Y H:i') ?? 'N/A' }}<br>
            <i class="fas fa-calendar-check mr-1"></i> <strong>Zaktualizowano:</strong> {{ $service->updated_at->format('d M Y H:i') ?? 'N/A' }}
        </small>
    </div>
</div>
