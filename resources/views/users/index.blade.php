@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto bg-white shadow-md rounded-xl p-8">

        <h2 class="text-2xl font-bold text-gray-800 mb-6">User List</h2>

        <div class="overflow-x-auto">
            <table id="usersTable" class="min-w-full border border-gray-200">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-3 border">#</th>
                        <th class="px-4 py-3 border">Name</th>
                        <th class="px-4 py-3 border">Email</th>
                        <th class="px-4 py-3 border">Role</th>
                        <th class="px-4 py-3 border text-center">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="px-4 py-3 border">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 border">{{ $user->name }}</td>
                            <td class="px-4 py-3 border">{{ $user->email }}</td>
                            <td class="px-4 py-3 border capitalize">{{ $user->role }}</td>

                            <td class="px-4 py-3 border text-center">

                                <!-- Edit Role -->
                                <a href="{{ route('users.edit.role', $user->id) }}"
                                    class="text-blue-600 hover:text-blue-800 mr-3">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>

                                <!-- Delete -->
                                <button onclick="confirmDelete({{ $user->id }})"
                                    class="text-red-600 hover:text-red-800">
                                    <i class="fa-solid fa-trash"></i>
                                </button>

                                <!-- Hidden Delete Form -->
                                <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}"
                                    method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#usersTable').DataTable();
        });

        // SweetAlert Delete
        function confirmDelete(id) {
            Swal.fire({
                title: "Delete User?",
                text: "This action cannot be undone.",
                icon: "warning",
                showCancelButton: true,
                width: "350px",
                padding: "1rem",
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Delete"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("delete-form-" + id).submit();
                }
            });
        }
    </script>
    <style>
        .dataTables_filter {
            margin-bottom: 15px;
        }
    </style>
@endsection
