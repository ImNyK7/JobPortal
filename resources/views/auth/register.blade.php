<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    @vite('resources/css/app.css')
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">

    <!-- Centered container -->
    <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-md">
        <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Create an Account</h2>

        <!-- Sign Up Form -->
        <form action="{{ route('register.post') }}" method="POST" class="space-y-3">
            @csrf

            <!-- Name -->
            <div class="text-left">
                <label for="name" class="block text-gray-700 font-medium mb-1">Full Name</label>
                <input type="text" id="name" name="name" required
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
            </div>

            <!-- Email -->
            <div class="text-left">
                <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
                <input type="email" id="email" name="email" required
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
            </div>

            <!-- Phone Number -->
            <div class="text-left">
                <label for="phone" class="block text-gray-700 font-medium mb-1">Phone Number</label>
                <input type="tel" id="phone" name="phone" required
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
            </div>

            <!-- Password -->
            <div class="text-left">
                <label for="password" class="block text-gray-700 font-medium mb-1">Password</label>
                <input type="password" id="password" name="password" required
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
            </div>

            <!-- Submit button -->
            <button type="submit"
                    class="w-full bg-green-600 text-white font-semibold py-2 rounded-lg hover:bg-green-700 transition">
                Sign Up
            </button>
        </form>

        <!-- Bottom link -->
        <p class="mt-6 text-center text-gray-600">
            Already have an account?
            <a href="/login" class="text-blue-600 hover:underline">Login</a>
        </p>
    </div>

</body>
</html>
