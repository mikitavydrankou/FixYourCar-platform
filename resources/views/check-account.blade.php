<!DOCTYPE html>
<html lang="ru" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konto</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 dark:bg-gray-900 flex flex-col justify-center items-center min-h-screen transition-colors duration-300">

<!-- Заголовок -->
<div class="text-center mb-8">
    <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100">
        Masz już konto?
    </h2>
    <p class="text-gray-600 dark:text-gray-300 mt-2">
        Wybierz odpowiednią opcję, aby kontynuować.
    </p>
</div>

<!-- Кнопки -->
<div class="flex flex-col sm:flex-row sm:space-x-4 space-y-4 sm:space-y-0 text-center">
    <!-- Кнопка "Zaloguj się" -->
    <a href="{{ route('login') }}"
       class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold py-3 px-8 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 ease-in-out transform hover:scale-105">
        Tak, zaloguj się
    </a>

    <!-- Кнопка "Zarejestruj się" -->
    <a href="{{ route('select-role') }}"
       class="border border-blue-500 dark:border-blue-600 text-blue-500 dark:text-blue-400 hover:bg-blue-500 hover:text-white dark:hover:bg-blue-600 dark:hover:text-white font-semibold py-3 px-8 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 ease-in-out transform hover:scale-105">
        Nie, zarejestruj się
    </a>
</div>

</body>
</html>
