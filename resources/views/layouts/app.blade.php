<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Job App' }}</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100 min-h-screen flex">

    <!-- ======================== -->
    <!--       SIDEBAR (LEFT)     -->
    <!-- ======================== -->
    <aside class="w-64 bg-white h-screen shadow-md fixed top-0 left-0 p-6">

        <!-- Clickable Title -->
        <a href="{{ route('dashboard') }}"
            class="text-2xl font-bold text-gray-800 mb-10 block hover:text-blue-600 transition">
            Job App
        </a>

        <!-- Navigation -->
        <nav class="flex flex-col space-y-2">

            <!-- Add Job -->
            <a href="{{ route('jobs.index') }}"
                class="flex items-center gap-3 px-4 py-2 rounded-lg text-gray-700 font-medium hover:bg-gray-100 transition">

                <i class="fa-solid fa-plus w-5 text-gray-600"></i>
                <span>Add Job</span>
            </a>

            <!-- Job List -->
            <a href="{{ route('jobs.list') }}"
                class="flex items-center gap-3 px-4 py-2 rounded-lg text-gray-700 font-medium hover:bg-gray-100 transition">

                <i class="fa-solid fa-list w-5 text-gray-600"></i>
                <span>Job List</span>
            </a>

            <!-- User List -->
            <a href="{{ route('users.index') }}"
                class="flex items-center gap-3 px-4 py-2 rounded-lg text-gray-700 font-medium hover:bg-gray-100 transition">
                <i class="fa-solid fa-users w-5"></i>
                <span>User List</span>
            </a>


            <!-- Divider -->
            <div class="border-t my-3"></div>

            <!-- Settings -->
            <a href="{{ route('settings') }}"
                class="flex items-center gap-3 px-4 py-2 rounded-lg text-gray-700 font-medium hover:bg-gray-100 transition">

                <i class="fa-solid fa-gear w-5 text-gray-600"></i>
                <span>Settings</span>
            </a>

            <!-- Logout -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="button" onclick="confirmLogout()"
                    class="w-full flex items-center gap-3 px-4 py-2 rounded-lg text-red-700 font-medium hover:bg-red-100 transition">

                    <i class="fa-solid fa-right-from-bracket w-5 text-red-600"></i>
                    <span>Logout</span>
                </button>
            </form>


        </nav>

    </aside>




    <!-- ======================== -->
    <!--   NAVBAR + MAIN CONTENT  -->
    <!-- ======================== -->

    <div class="flex-1 ml-64">

        <!-- Navbar (NO Job App text) -->
        <nav class="bg-white shadow-md px-6 py-4 flex justify-end items-center">

            <!-- Profile Dropdown -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random"
                        alt="Profile" class="w-10 h-10 rounded-full border border-gray-300">
                </button>

                <!-- Dropdown menu -->
                <div x-show="open" @click.away="open = false" x-transition
                    class="absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg border border-gray-100 z-50">
                    <a href="{{ route('settings') }}"
                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-t-lg">
                        Settings
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-4 py-2 text-red-700 hover:bg-gray-100 rounded-b-lg">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </nav>

        <!-- Main Page Content -->
        <main class="p-6">
            @yield('content')
        </main>

    </div>

    <script>
        function confirmLogout() {
            Swal.fire({
                title: "Are you sure?",
                text: "You will be logged out.",
                icon: "warning",
                showCancelButton: true,
                height: "350px",
                padding: "1rem",
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Logout"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("logout-form").submit();
                }
            });
        }
    </script>



</body>

</html>
