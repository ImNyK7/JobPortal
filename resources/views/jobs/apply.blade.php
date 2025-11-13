@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto bg-white shadow-md rounded-xl p-8">

        <h2 class="text-2xl font-bold text-gray-800 mb-4">
            Apply for {{ $job->title }}
        </h2>

        <form action="{{ route('jobs.apply.submit', $job->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            @if ($profile->cv_path)
                <!-- If user already uploaded CV -->
                <p class="text-green-700 mb-3">Your CV is already on file.</p>

                <p class="text-sm text-gray-600 mb-4">
                    <a href="{{ asset('storage/' . $profile->cv_path) }}" class="text-blue-600 underline" target="_blank">
                        View Current CV
                    </a>
                </p>

                <!-- Hidden input to tell controller to reuse existing CV -->
                <input type="hidden" name="use_existing_cv" value="1">
            @else
                <!-- If no CV uploaded yet -->
                <label class="block font-medium mb-1">Upload CV (PDF only)</label>
                <input type="file" name="cv" accept="application/pdf" required
                    class="border border-gray-300 rounded-md px-3 py-2 mb-4">
            @endif


            <div class="mb-4">
                <label class="font-semibold text-gray-700">Cover Letter (optional)</label>
                <textarea name="cover_letter" rows="4" class="w-full border border-gray-300 rounded-lg px-3 py-2"></textarea>
            </div>

            <button class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
                Submit Application
            </button>
        </form>

    </div>
@endsection
