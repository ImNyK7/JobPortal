@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center mt-10">
        <div class="bg-white shadow-md rounded-2xl p-8 w-full max-w-lg">
            <div class="flex flex-col items-center mb-6">
                <!-- Profile Picture -->
                <div
                    class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center text-gray-500 text-3xl font-bold mb-3">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random"
                        alt="Profile Picture" class="w-24 h-24 rounded-full object-cover border border-gray-300">
                </div>
                <!-- Profile Name -->
                <h2 class="text-2xl font-bold text-gray-800">{{ Auth::user()->name }}</h2>
            </div>

            <!-- Profile Form -->
            <form action="{{ route('settings.update') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-gray-700 font-medium mb-1">Address</label>
                    <input type="text" name="address" value="{{ old('address', $profile->address) }}"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-1">Date of Birth</label>
                    <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $profile->date_of_birth) }}"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <label class="text-gray-700 font-medium">Last Education</label>
                        <label class="text-gray-400 font-medium text-sm">Contoh: S1, Universitas Negeri Surabaya</label>
                    </div>

                    <input type="text" name="last_education"
                        value="{{ old('last_education', $profile->last_education) }}"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <label class="text-gray-700 font-medium">Previous Job</label>
                        <label class="text-gray-400 font-medium text-sm">Contoh: Web Developer, PT Pencari Cinta Sejati</label>
                    </div>

                    <input type="text" name="previous_job"
                        value="{{ old('previous_job', $profile->previous_job) }}"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <label class="text-gray-700 font-medium">Skills</label>
                        <label class="text-gray-400 font-medium text-sm">Contoh: Laravel, PHP, HTML, MySQL</label>
                    </div>

                    <input type="text" name="skills"
                        value="{{ old('skills', $profile->skills) }}"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-1">About</label>
                    <textarea name="about" rows="3"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">{{ old('about', $profile->about) }}</textarea>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700 transition">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- SweetAlert Notifications --}}
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

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Update Failed',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                width: '350px',
                padding: '1rem'
            });
        </script>
    @endif
@endsection
