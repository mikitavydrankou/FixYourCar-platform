@props(['serviceRequest'])

<div class="max-w-4xl mx-auto mb-4 bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
    <div class="p-4">
        @php $attachments = json_decode($serviceRequest->attachments); @endphp

        @if(count($attachments) > 0)
            <div id="gallery-{{ $serviceRequest->id }}" class="relative w-full" data-carousel="slide">
                <!-- Carousel wrapper -->
                <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                    @foreach($attachments as $index => $image)
                        <div class="hidden duration-700 ease-in-out" data-carousel-item="{{ $index === 0 ? 'active' : '' }}">
                            <img src="{{ asset($image) }}"
                                 class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                 alt="Image {{ $index + 1 }}">
                        </div>
                    @endforeach
                </div>

                <!-- Slider indicators -->
                @if(count($attachments) > 1)
                    <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2">
                        @foreach($attachments as $index => $image)
                            <button type="button"
                                    class="w-3 h-3 rounded-full bg-white/50 hover:bg-white/80 focus:outline-none"
                                    aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                                    data-carousel-slide-to="{{ $index }}"></button>
                        @endforeach
                    </div>
                @endif

                <!-- Slider controls -->
                @if(count($attachments) > 1)
                    <button type="button"
                            class="absolute top-1/2 left-4 z-30 flex items-center justify-center h-8 w-8 bg-white/30 rounded-full hover:bg-white/50 focus:outline-none"
                            data-carousel-prev>
                        <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                        </svg>
                    </button>
                    <button type="button"
                            class="absolute top-1/2 right-4 z-30 flex items-center justify-center h-8 w-8 bg-white/30 rounded-full hover:bg-white/50 focus:outline-none"
                            data-carousel-next>
                        <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                    </button>
                @endif
            </div>
        @endif

        <!-- Остальной контент -->
        <h5 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mt-4">{{ $serviceRequest->car->make }} - {{ $serviceRequest->location }}</h5>
        <h5 class="text-sm text-gray-600 dark:text-gray-400 mt-2">Status: {{ $serviceRequest->status }}</h5>

        <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Złożono: {{ \Carbon\Carbon::parse($serviceRequest->created_at)->format('Y-m-d H:i:s') }}</p>

        <div class="mt-4 grid gap-2">
            @if($serviceRequest->status === 'pending')
                <a href="{{ route('client.requests.show', $serviceRequest) }}" class="w-full text-center text-white bg-green-500 hover:bg-green-600 py-2 px-4 rounded-md">
                    Zobacz szczegóły
                </a>
            @elseif($serviceRequest->status === 'review')
                <a href="{{ route('client.requests.show', $serviceRequest) }}" class="w-full text-center text-white bg-green-500 hover:bg-green-600 py-2 px-4 rounded-md">
                    Ustaw opinie
                </a>
            @elseif($serviceRequest->status === 'waiting')
                <a href="{{ route('client.requests.show', $serviceRequest) }}" class="w-full text-center text-white bg-blue-500 hover:bg-blue-600 py-2 px-4 rounded-md">
                    Zobacz
                </a>
                <a href="{{ route('client.offer', $serviceRequest) }}" class="w-full text-center text-white bg-blue-500 hover:bg-blue-600 py-2 px-4 rounded-md">
                    Oferty
                </a>
            @endif

            <form method="POST" action="{{ route('client.requests.destroy', $serviceRequest) }}" class="w-full">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full text-center text-white bg-red-500 hover:bg-red-600 py-2 px-4 rounded-md" onclick="return confirm('Confirm delete?')">
                    Usuń
                </button>
            </form>
        </div>
    </div>
</div>
