@props(['serviceRequest'])

<div class="max-w-4xl mx-auto mb-4 bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const carouselElement = document.getElementById('carouselExampleCaptions{{ $serviceRequest->id }}');
            const totalImages = {{ count(json_decode($serviceRequest->attachments)) }};

            if (totalImages > 1) {
                const carousel = new Flowbite.Carousel(carouselElement, {
                    defaultPosition: 0,
                    interval: 0,
                    indicators: {
                        activeClasses: 'bg-white',
                        inactiveClasses: 'bg-gray-300'
                    }
                });
            }
        });
    </script>
    <div class="p-4">
        @php
            $attachments = json_decode($serviceRequest->attachments);
            $urgencyLabels = [
                'low' => 'Niewielkie znaczenie',
                'medium' => 'Średnie znaczenie',
                'high' => 'Duże znaczenie'
            ];
        @endphp
        @if(count($attachments) > 0)
            @if(count($attachments) > 1)
                <div id="carouselExampleCaptions{{ $serviceRequest->id }}" class="relative w-full" data-carousel="slide">
                    <div class="relative h-56 md:h-96 overflow-hidden rounded-lg">
                        @foreach($attachments as $index => $image)
                            <div class="hidden duration-700" data-carousel-item>
                                <img src="{{ asset($image) }}" alt="Image {{ $index + 1 }}" class="w-full h-full object-cover object-center">
                            </div>
                        @endforeach
                    </div>
                    <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                        @foreach($attachments as $index => $image)
                            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide {{ $index + 1 }}" data-carousel-slide-to="{{ $index }}"></button>
                        @endforeach
                    </div>
                    <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50">
                            ❮
                        </span>
                    </button>
                    <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50">
                            ❯
                        </span>
                    </button>
                </div>
            @else
                <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                    <img src="{{ asset($attachments[0]) }}" alt="Image 1" class="w-full h-full object-cover object-center">
                </div>
            @endif
        @endif
        <h5 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mt-4">{{ $serviceRequest->car->make }} - {{ $serviceRequest->location }}</h5>
        <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Złożono: {{ \Carbon\Carbon::parse($serviceRequest->created_at)->format('Y-m-d H:i:s') }}</p>
        <h6 class="text-sm text-gray-600 dark:text-gray-400 mt-2">Ważność: {{ $urgencyLabels[$serviceRequest->urgency] ?? 'Nieznana' }}</h6>
        <div class="mt-4 grid gap-2">
            <button class="w-full text-center text-white bg-gray-500 hover:bg-gray-600 py-2 px-4 rounded-md" onclick="openModal()">
                Więcej informacji
            </button>
            <a href="javascript:void(0)"
               class="w-full text-center text-white bg-blue-500 hover:bg-blue-600 py-2 px-4 rounded-md"
               data-id="{{ $serviceRequest->id }}"
               data-info="{{ $serviceRequest->car->make }} - {{ $serviceRequest->location }}"
               onclick="selectRequest(this)">
                Wybierz
            </a>
        </div>
    </div>
</div>

<!-- Модальное окно -->
<div id="customModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg max-w-lg w-full">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Informacja o zgłoszeniu</h2>
        <h6 class="text-sm text-gray-600 dark:text-gray-400 mt-2">User: "{{ $serviceRequest->user->name }}" </h6>
        <h5 class="text-sm text-gray-600 dark:text-gray-400 mt-2">Lokacja: {{ $serviceRequest->location }}</h5>
        <h5 class="text-sm text-gray-600 dark:text-gray-400 mt-2">Problema: {{ $serviceRequest->problem_description }}</h5>
        <h6 class="text-sm text-gray-600 dark:text-gray-400 mt-2">Ważność: {{ $urgencyLabels[$serviceRequest->urgency] ?? 'Nieznana' }}</h6>
        <div class="mt-4 flex justify-end">
            <button class="px-4 py-2 bg-red-500 text-white rounded-md" onclick="closeModal()">Закрыть</button>
        </div>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('customModal').classList.remove('hidden');
    }
    function closeModal() {
        document.getElementById('customModal').classList.add('hidden');
    }
</script>
