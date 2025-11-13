@extends('layouts.app')

@section('content')
    <div class="px-8 py-6">

        <h2 class="text-2xl font-bold text-gray-800 mb-6">Job List</h2>

        @forelse ($jobs as $job)
            <a href="{{ route('jobs.show', $job->id) }}" class="block hover:scale-[1.01] transition">
                <div class="bg-white shadow-md rounded-lg p-6 mb-5 border border-gray-200 cursor-pointer">

                    <div class="flex justify-between">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">{{ $job->title }}</h3>

                            <p class="text-gray-600 mt-2">
                                <span class="font-semibold">Location:</span>
                                {{ $job->location ?? '-' }}
                            </p>

                            <p class="text-gray-600">
                                <span class="font-semibold">Salary:</span>
                                {{ $job->salary ? 'Rp ' . number_format($job->salary, 0, ',', '.') : '-' }}
                            </p>
                        </div>

                        <div class="text-right">
                            <p class="text-gray-700 font-semibold">Deadline</p>
                            <p class="text-gray-800 font-bold">
                                {{ $job->deadline ?? '—' }}
                            </p>
                        </div>
                    </div>

                </div>
            </a>

        @empty
            <p class="text-gray-500 text-center">No job postings available.</p>
        @endforelse

    </div>
@endsection
