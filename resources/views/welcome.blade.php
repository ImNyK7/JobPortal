<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    @vite('resources/css/app.css')
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">

    <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-md text-center">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Welcome to Our Website!</h1>
        <p class="text-gray-600 mb-8">We’re glad you’re here. Please log in or sign up to continue.</p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('login') }}"
               class="w-full sm:w-auto px-6 py-3 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition">
               Login
            </a>
            <a href="{{ route('register') }}"
               class="w-full sm:w-auto px-6 py-3 bg-gray-200 text-gray-800 font-semibold rounded-xl hover:bg-gray-300 transition">
               Sign Up
            </a>
        </div>
    </div>

</body>
</html>
