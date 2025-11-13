@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow-md rounded-xl p-8">

    <h2 class="text-2xl font-bold text-gray-800 mb-6">Add New Job</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('jobs.store') }}" method="POST" class="space-y-5">
        @csrf

        <!-- Job Title -->
        <div>
            <label class="block text-gray-700 font-medium mb-1">Job Title</label>
            <input type="text" name="title" value="{{ old('title') }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                   placeholder="Example: Backend Developer" required>
        </div>

        <!-- Description -->
        <div>
            <label class="block text-gray-700 font-medium mb-1">Job Description</label>
            <textarea name="description" rows="4"
                      class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                      placeholder="Describe the responsibilities and requirements..." required>{{ old('description') }}</textarea>
        </div>

        <!-- Location -->
        <div>
            <label class="block text-gray-700 font-medium mb-1">Location</label>
            <input type="text" name="location" value="{{ old('location') }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                   placeholder="Example: Surabaya, Jakarta">
        </div>

        <!-- Employment Type -->
        <div>
            <label class="block text-gray-700 font-medium mb-1">Employment Type</label>
            <select name="employment_type"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" required>
                <option value="">-- select type --</option>
                <option value="Full-time">Full-time</option>
                <option value="Part-time">Part-time</option>
                <option value="Internship">Internship</option>
                <option value="Contract">Contract</option>
            </select>
        </div>

        <!-- Salary -->
        <div>
            <label class="block text-gray-700 font-medium mb-1">Salary (optional)</label>
            <input type="number" name="salary" value="{{ old('salary') }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                   placeholder="Example: 6000000">
        </div>

        <!-- Deadline -->
        <div>
            <label class="block text-gray-700 font-medium mb-1">Application Deadline</label>
            <input type="date" name="deadline" value="{{ old('deadline') }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Submit -->
        <div class="flex justify-end">
            <button type="submit"
                class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                Save Job
            </button>
        </div>
    </form>
</div>

{{-- Success popup --}}
@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: "{{ session('success') }}",
            width: '350px',
            padding: '1rem'
        });
    </script>
@endif

@endsection
