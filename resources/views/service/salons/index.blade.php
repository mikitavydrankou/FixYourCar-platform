<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Warsztaty') }}
        </h2>
    </x-slot>

    <div class="container mx-auto pt-4">
        <div class="w-full">
            @if (session('status'))
                <div class="bg-green-500 text-white p-4 rounded mb-4" role="alert" id="success-alert">
                    {{ session('status') }}
                </div>
                <script>
                    setTimeout(function () {
                        document.getElementById('success-alert').style.display = 'none';
                    }, 5000);
                </script>
            @endif

            @if ($errors->any())
                <div class="bg-red-500 text-white p-4 rounded mb-4" id="error-alert">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
                <script>
                    setTimeout(function () {
                        document.getElementById('error-alert').style.display = 'none';
                    }, 5000);
                </script>
            @endif
        </div>
    </div>

    <div class="container mx-auto p-md-5">
        <div class="w-full">
            <div class="grid grid-cols-1 gap-4">
                @isset($services)
                    @if($services->isEmpty())
                        <p class="text-gray-600 dark:text-gray-400 mb-4">{{ __('You have not added any service yet.') }}</p>
                        <a href="{{ route('service.create') }}"
                           class="inline-flex items-center px-4 py-2 bg-blue-500 text-white text-sm font-semibold rounded-lg shadow-md hover:bg-blue-600 transition">
                            {{ __('Add a service') }}
                        </a>
                    @else
                        <ul class="list-disc pl-5">
                            @foreach($services as $service)
                                <x-service :service="$service"/>
                            @endforeach
                        </ul>
                    @endif
                @endisset
            </div>
        </div>
    </div>
</x-app-layout>
