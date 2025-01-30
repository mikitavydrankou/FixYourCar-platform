<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Powitanie</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 flex flex-col justify-center items-center min-h-screen">

<div class="container mx-auto flex-grow flex flex-col items-center justify-center my-12 px-6">
    <h1 class="text-4xl font-bold mb-4 text-center">Powitanie</h1>
    <p class="text-lg mb-8 text-center">Wybierz potrzebne działanie:</p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-xl transition duration-300">
            <div class="p-6 flex flex-col justify-between h-full">
                <h5 class="text-xl font-semibold mb-4">Chcesz naprawić swój samochód?</h5>
                <a href="{{ url('/repair-car') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-3 px-6 rounded text-center transition duration-300">Tak, chcę</a>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-xl transition duration-300">
            <div class="p-6 flex flex-col justify-between h-full">
                <h5 class="text-xl font-semibold mb-4">Czy masz własny serwis?</h5>
                <a href="{{ url('/have-service') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-3 px-6 rounded text-center transition duration-300">Tak, mam</a>
            </div>
        </div>
    </div>
</div>

<footer class="py-4 mt-auto">
    <div class="container mx-auto text-center text-gray-300 dark:text-gray-500">
        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
    </div>
</footer>

<script>
    function toggleTheme() {
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('theme', 'light');
        } else {
            document.documentElement.classList.add('dark');
            localStorage.setItem('theme', 'dark');
        }
    }
</script>

</body>
</html>
