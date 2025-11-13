@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow-md rounded-xl p-8">

    <h2 class="text-3xl font-bold text-gray-800 mb-4">
        {{ $job->title }}
    </h2>

    <p class="text-gray-700 text-lg mb-6">
        {{ $job->description }}
    </p>

    <div class="space-y-4 text-gray-700">

        <p>
            <span class="font-semibold">Location:</span>
            {{ $job->location ?? '-' }}
        </p>

        <p>
            <span class="font-semibold">Salary:</span>
            {{ $job->salary ? 'Rp ' . number_format($job->salary, 0, ',', '.') : '-' }}
        </p>

        <p>
            <span class="font-semibold">Employment Type:</span>
            {{ $job->employment_type }}
        </p>

        <p>
            <span class="font-semibold">Deadline:</span>
            {{ $job->deadline ?? '—' }}
        </p>

        <p>
            <span class="font-semibold">Posted At:</span>
            {{ $job->created_at->format('d M Y') }}
        </p>
    </div>

    <div class="mt-8">
        <a href="{{ route('jobs.list') }}"
           class="bg-gray-300 text-gray-700 px-5 py-2 rounded-lg hover:bg-gray-400 transition">
            Back
        </a>
    </div>

</div>
@endsection
