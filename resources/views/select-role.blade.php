<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добро пожаловать</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex flex-col justify-center items-center min-h-screen">




<div class="container mx-auto flex-grow flex flex-col items-center justify-center my-12 px-6">
    <h1 class="text-4xl font-bold mb-4 text-center">Добро пожаловать!</h1>
    <p class="text-lg mb-8 text-center">Выберите действие, которое вам нужно:</p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow hover:shadow-xl transition duration-300">
            <div class="p-6 flex flex-col justify-between h-full">
                <h5 class="text-xl font-semibold mb-4">Хочешь починить свой автомобиль?</h5>
                <a href="{{ url('/repair-car') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-3 px-6 rounded text-center transition duration-300">Да, хочу</a>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow hover:shadow-xl transition duration-300">
            <div class="p-6 flex flex-col justify-between h-full">
                <h5 class="text-xl font-semibold mb-4">У тебя есть свой сервис?</h5>
                <a href="{{ url('/have-service') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-3 px-6 rounded text-center transition duration-300">Да, есть</a>
            </div>
        </div>
    </div>
</div>


<footer class="py-4 mt-auto">
    <div class="container mx-auto text-center text-gray-300">
        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
    </div>
</footer>

</body>
</html>
