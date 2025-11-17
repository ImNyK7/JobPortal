<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    @vite('resources/css/app.css')

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Font Awesome CSS (required for icons to switch) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body class="flex items-center justify-center min-h-screen bg-gray-100">

    <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-md">
        <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Login</h2>

        <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Email -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Password with Show/Hide -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Password</label>

                <div class="relative">
                    <input type="password" id="password" name="password" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">

                    <!-- Show/Hide Password Icon -->
                    <button type="button" id="togglePassword"
                        class="absolute right-3 top-2.5 text-gray-500 hover:text-gray-700 w-5 text-center">
                        <i id="eyeIcon" class="fa-solid fa-eye"></i>
                    </button>

                </div>
            </div>

            <!-- Remember Me -->
            <div class="flex items-center gap-2">
                <input type="checkbox" name="remember" id="remember"
                    class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                <label for="remember" class="text-gray-700">Remember me</label>
            </div>

            <!-- Submit -->
            <button type="submit"
                class="w-full bg-blue-600 text-white font-semibold py-2 rounded-lg hover:bg-blue-700 transition">
                Login
            </button>
        </form>

        <!-- Bottom link -->
        <p class="mt-6 text-center text-gray-600">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Sign Up</a>
        </p>
    </div>

    <!-- SweetAlert Error Handling -->
    <script>
        @if (session('login_error'))
            Swal.fire({
                icon: 'error',
                title: 'Login Failed',
                text: '{{ session('login_error') }}',
                confirmButtonColor: '#d33'
            });
        @endif

        @if ($errors->any())
            Swal.fire({
                icon: 'warning',
                title: 'Invalid Input',
                text: 'Please check your email and password.',
                confirmButtonColor: '#facc15'
            });
        @endif
    </script>

    <!-- Show/Hide Password Script (100% working version) -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const toggle = document.getElementById("togglePassword");
            const password = document.getElementById("password");
            const icon = document.getElementById("eyeIcon");

            toggle.addEventListener("click", function() {
                const show = password.type === "password";
                password.type = show ? "text" : "password";
                icon.className = show ? "fa-solid fa-eye-slash" : "fa-solid fa-eye";
            });
        });
    </script>


</body>

</html>
