<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set acc</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 flex flex-col justify-center items-center min-h-screen">

<div class="text-center mb-6">
    <h2 class="text-3xl font-bold text-gray-800">У вас уже есть аккаунт?</h2>
</div>

<div class="flex flex-col sm:flex-row sm:space-x-4 space-y-4 sm:space-y-0 text-center">
    <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 px-6 rounded-lg shadow-md transition duration-300 ease-in-out">
        Да, войти
    </a>
    <a href="{{ route('select-role') }}" class="border border-blue-500 hover:bg-blue-500 hover:text-white text-blue-500 font-semibold py-3 px-6 rounded-lg shadow-md transition duration-300 ease-in-out">
        Нет, зарегистрироваться
    </a>
</div>

</body>
</html>
