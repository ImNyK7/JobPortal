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

    <!-- ===================== -->
    <!--        SIDEBAR        -->
    <!-- ===================== -->
    <aside class="w-64 bg-white h-screen shadow-md fixed top-0 left-0 p-6">

        <!-- Dashboard link -->
        <a href="{{ route('dashboard') }}"
           class="text-2xl font-bold text-gray-800 mb-10 block hover:text-blue-600 transition">
            Job App
        </a>

        @php $role = Auth::user()->role; @endphp

        <nav class="flex flex-col space-y-2">

            <!-- Admin + HR -->
            @if ($role === 'admin' || $role === 'hr')
                <a href="{{ route('jobs.index') }}"
                   class="flex items-center gap-3 px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-100">
                    <i class="fa-solid fa-plus w-5 text-gray-600"></i>
                    <span>Add Job</span>
                </a>
            @endif

            <!-- All roles -->
            <a href="{{ route('jobs.list') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-100">
                <i class="fa-solid fa-list w-5 text-gray-600"></i>
                <span>Job List</span>
            </a>

            <!-- Admin only -->
            @if ($role === 'admin')
                <a href="{{ route('users.index') }}"
                   class="flex items-center gap-3 px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-100">
                    <i class="fa-solid fa-users w-5"></i>
                    <span>User List</span>
                </a>
            @endif

            <div class="border-t my-3"></div>

            <!-- All roles -->
            <a href="{{ route('settings') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-100">
                <i class="fa-solid fa-gear w-5 text-gray-600"></i>
                <span>Settings</span>
            </a>

            <!-- Logout (sidebar) -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="button" onclick="confirmLogoutSidebar()"
                        class="w-full flex items-center gap-3 px-4 py-2 rounded-lg text-red-700 hover:bg-red-100">
                    <i class="fa-solid fa-right-from-bracket w-5 text-red-600"></i>
                    <span>Logout</span>
                </button>
            </form>

        </nav>
    </aside>


    <!-- ===================== -->
    <!--   NAVBAR + CONTENT    -->
    <!-- ===================== -->
    <div class="flex-1 ml-64">

        <!-- Navbar -->
        <nav class="bg-white shadow-md px-6 py-4 flex justify-end items-center">

            <div x-data="{ open:false }" class="relative">
                <button @click="open = !open" class="flex items-center space-x-2">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random"
                         class="w-10 h-10 rounded-full border" />
                </button>

                <!-- Dropdown -->
                <div x-show="open" @click.away="open = false" x-transition
                     class="absolute right-0 mt-2 w-40 bg-white shadow-lg rounded-lg border z-50">

                    <a href="{{ route('settings') }}"
                       class="block px-4 py-2 hover:bg-gray-100">Settings</a>

                    <!-- Logout (dropdown) -->
                    <form id="logout-dropdown-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="button"
                                onclick="confirmLogoutDropdown()"
                                class="w-full text-left px-4 py-2 text-red-700 hover:bg-gray-100">
                            Logout
                        </button>
                    </form>

                </div>
            </div>

        </nav>

        <!-- Main Content -->
        <main class="p-6">
            @yield('content')
        </main>

    </div>


    <!-- ===================== -->
    <!--   SweetAlert Scripts  -->
    <!-- ===================== -->

    <script>
        function confirmLogoutSidebar() {
            Swal.fire({
                title: "Are you sure?",
                text: "You will be logged out.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Logout"
            }).then(result => {
                if (result.isConfirmed) {
                    document.getElementById("logout-form").submit();
                }
            });
        }

        function confirmLogoutDropdown() {
            Swal.fire({
                title: "Are you sure?",
                text: "You will be logged out.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Logout"
            }).then(result => {
                if (result.isConfirmed) {
                    document.getElementById("logout-dropdown-form").submit();
                }
            });
        }
    </script>

</body>
</html>
