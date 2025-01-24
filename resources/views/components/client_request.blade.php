@props(['serviceRequest'])

<div class="max-w-4xl mx-auto mb-4 bg-white shadow-md rounded-lg overflow-hidden">
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const carousel = new Carousel(document.getElementById('carouselExampleCaptions{{ $serviceRequest->id }}'), {
                interval: 100000,
                indicators: {
                    activeClasses: 'bg-white',
                    inactiveClasses: 'bg-gray-300'
                }
            });
        });
    </script>
    <div class="p-4">
        @if(count(json_decode($serviceRequest->attachments)) > 0)
            <div id="carouselExampleCaptions{{ $serviceRequest->id }}" class="relative w-full" data-carousel="slide">
                <!-- Carousel wrapper -->
                <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                    @foreach(json_decode($serviceRequest->attachments) as $index => $image)
                        <div class="{{ $index === 0 ? 'block' : 'hidden' }} duration-700 ease-in-out" data-carousel-item>
                            <img src="{{ asset($image) }}" alt="Image {{ $index + 1 }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                        </div>
                    @endforeach
                </div>
                <!-- Slider indicators -->
                <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                    @foreach(json_decode($serviceRequest->attachments) as $index => $image)
                        <button type="button" class="w-3 h-3 rounded-full" aria-current="{{ $index === 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}" data-carousel-slide-to="{{ $index }}"></button>
                    @endforeach
                </div>


                <!-- Slider controls -->
                <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                        </svg>
                        <span class="sr-only">Previous</span>
                    </span>
                </button>
                <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="sr-only">Next</span>
                    </span>
                </button>
            </div>




        @endif


        <h5 class="text-xl font-semibold text-gray-800 mt-4">{{ $serviceRequest->car->make }} - {{ $serviceRequest->location }}</h5>

        <div class="mt-4 grid gap-2">
            <a href="{{ route('client.requests.show', $serviceRequest) }}" class="w-full text-center text-white bg-blue-500 hover:bg-blue-600 py-2 px-4 rounded-md">
                Zobacz
            </a>
            <form method="POST" action="{{ route('client.requests.destroy', $serviceRequest->id) }}" class="w-full">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full text-center text-white bg-red-500 hover:bg-red-600 py-2 px-4 rounded-md" onclick="return confirm('Confirm delete?')">
                    Usuń
                </button>
            </form>
        </div>
    </div>
</div>
