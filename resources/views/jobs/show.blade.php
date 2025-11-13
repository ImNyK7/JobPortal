@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow-md rounded-xl p-8 mb-8">

    <h2 class="text-3xl font-bold text-gray-800 mb-4">
        {{ $job->title }}
    </h2>

    <p class="text-gray-700 text-lg mb-6">
        {{ $job->description }}
    </p>

    <div class="space-y-4 text-gray-700">

        <p><span class="font-semibold">Location:</span> {{ $job->location ?? '-' }}</p>
        <p><span class="font-semibold">Salary:</span>
            {{ $job->salary ? 'Rp ' . number_format($job->salary, 0, ',', '.') : '-' }}
        </p>
        <p><span class="font-semibold">Employment Type:</span> {{ $job->employment_type }}</p>
        <p><span class="font-semibold">Deadline:</span> {{ $job->deadline ?? '—' }}</p>
        <p><span class="font-semibold">Posted At:</span> {{ $job->created_at->format('d M Y') }}</p>

    </div>

    <!-- BUTTONS -->
    <div class="mt-8 flex items-center gap-3">

        <!-- Back Button -->
        <a href="{{ route('jobs.list') }}"
            class="bg-gray-300 text-gray-700 px-5 py-2 rounded-lg hover:bg-gray-400 transition">
            Back
        </a>

        <!-- Apply Button (Now Correct) -->
        @if (Auth::user()->role == 'applicant')
            <a href="{{ route('jobs.apply', $job->id) }}"
               class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
               Apply Now
            </a>
        @endif
    </div>

</div>


<!-- ============================================================= -->
<!--        APPLICANTS LIST SECTION — HR & ADMIN ONLY              -->
<!-- ============================================================= -->
@if (Auth::user()->role == 'hr' || Auth::user()->role == 'admin')
<div class="max-w-3xl mx-auto bg-white shadow-md rounded-xl p-8">

    <h3 class="text-2xl font-bold text-gray-800 mb-6">Applicants List</h3>

    @if (count($applications) > 0)
        <div class="space-y-4">

            @foreach ($applications as $app)
                <div class="border p-4 rounded-lg flex justify-between items-center">

                    <div class="flex items-start gap-4">

                        <!-- NUMBER -->
                        <span class="text-xl font-bold text-gray-700">
                            {{ $loop->iteration }}.
                        </span>

                        <!-- Applicant Info -->
                        <div>
                            <p class="font-semibold text-gray-900">{{ $app->user->name }}</p>
                            <p class="text-gray-600">{{ $app->user->email }}</p>
                            <p class="text-gray-500 text-sm">
                                Applied on {{ $app->created_at->format('d M Y') }}
                            </p>

                            @if ($app->cover_letter)
                                <p class="mt-2 text-gray-700">
                                    <span class="font-semibold">Cover Letter:</span>
                                    {{ $app->cover_letter }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <div>
                        <a href="{{ asset('storage/' . $app->cv_path) }}"
                           class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700"
                           download>
                            Download CV
                        </a>
                    </div>

                </div>
            @endforeach

        </div>
    @else
        <p class="text-gray-500">No applicants have applied for this job yet.</p>
    @endif

</div>
@endif


<!-- SweetAlert for Success / Already Applied -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    @if(session('application_success'))
        Swal.fire({
            icon: 'success',
            title: 'Application Submitted!',
            text: 'Your job application has been sent successfully.',
            confirmButtonColor: '#16a34a'
        });
    @endif

    @if(session('already_applied'))
        Swal.fire({
            icon: 'warning',
            title: 'Already Applied!',
            text: 'You have already applied for this job.',
            confirmButtonColor: '#facc15'
        });
    @endif
</script>

@endsection
