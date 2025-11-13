@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow-md rounded-xl p-8">

    <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Job</h2>

    <form action="{{ route('jobs.update', $job->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-gray-700 font-medium mb-1">Job Title</label>
            <input type="text" name="title" value="{{ old('title', $job->title) }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                   required>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Job Description</label>
            <textarea name="description" rows="4"
                      class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                      required>{{ old('description', $job->description) }}</textarea>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Location</label>
            <input type="text" name="location" value="{{ old('location', $job->location) }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Employment Type</label>
            <select name="employment_type"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                    required>
                <option value="Full-time"   {{ $job->employment_type == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                <option value="Part-time"   {{ $job->employment_type == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                <option value="Internship"  {{ $job->employment_type == 'Internship' ? 'selected' : '' }}>Internship</option>
                <option value="Contract"    {{ $job->employment_type == 'Contract' ? 'selected' : '' }}>Contract</option>
            </select>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Salary</label>
            <input type="number" name="salary" value="{{ old('salary', $job->salary) }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Application Deadline</label>
            <input type="date" name="deadline" value="{{ old('deadline', $job->deadline) }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('jobs.index') }}" class="px-5 py-2 rounded-lg bg-gray-300 hover:bg-gray-400">Cancel</a>

            <button type="submit"
                class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                Update Job
            </button>
        </div>
    </form>
</div>

{{-- Success popup --}}
@if (session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Updated',
    text: "{{ session('success') }}",
    width: '350px',
    padding: '1rem'
});
</script>
@endif

@endsection
