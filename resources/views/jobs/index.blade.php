@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto bg-white shadow-md rounded-xl p-8">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Job Listings</h2>

            <a href="{{ route('jobs.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                + Create Job
            </a>
        </div>

        <!-- DataTable -->
        <div class="overflow-x-auto">
            <table id="jobsTable" class="min-w-full border border-gray-200">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-3 border">#</th>
                        <th class="px-4 py-3 border">Title</th>
                        <th class="px-4 py-3 border">Location</th>
                        <th class="px-4 py-3 border">Type</th>
                        <th class="px-4 py-3 border">Deadline</th>
                        <th class="px-4 py-3 border text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jobs as $job)
                        <tr>
                            <td class="px-4 py-3 border">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 border">{{ $job->title }}</td>
                            <td class="px-4 py-3 border">{{ $job->location ?? '-' }}</td>
                            <td class="px-4 py-3 border">{{ $job->employment_type }}</td>
                            <td class="px-4 py-3 border">{{ $job->deadline ?? '-' }}</td>

                            <td class="px-4 py-3 border text-center">

                                <!-- View Button -->
                                <a href="{{ route('jobs.show', $job->id) }}"
                                    class="text-green-600 hover:text-green-800 mr-3">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                <!-- Edit -->
                                <a href="{{ route('jobs.edit', $job->id) }}" class="text-blue-600 hover:text-blue-800 mr-3">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>

                                <!-- Delete -->
                                <button onclick="confirmDelete({{ $job->id }})"
                                    class="text-red-600 hover:text-red-800">
                                    <i class="fa-solid fa-trash"></i>
                                </button>

                                <!-- Hide/Show -->
                                <form action="{{ route('jobs.toggle', $job->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')

                                    @if ($job->is_hidden)
                                        <button class="text-yellow-600 hover:text-yellow-700 underline ml-2">
                                            Show
                                        </button>
                                    @else
                                        <button class="text-gray-600 hover:text-gray-800 underline ml-2">
                                            Hide
                                        </button>
                                    @endif
                                </form>

                                <!-- Delete Form -->
                                <form id="delete-form-{{ $job->id }}" action="{{ route('jobs.destroy', $job->id) }}"
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

    <!-- SweetAlert Delete -->
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: "Delete this job?",
                text: "This cannot be undone.",
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

    <!-- DataTables CDN -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#jobsTable').DataTable();
        });
    </script>
    <style>
        .dataTables_filter {
            margin-bottom: 15px;
        }
    </style>
@endsection
