@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white shadow-md rounded-xl p-8">

    <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit User Role</h2>

    <form action="{{ route('users.update.role', $user->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="font-semibold text-gray-700">User Name</label>
            <input type="text" value="{{ $user->name }}" disabled
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-100">
        </div>

        <div>
            <label class="font-semibold text-gray-700">Role</label>
            <select name="role"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                <option value="admin"     {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="hr"        {{ $user->role == 'hr' ? 'selected' : '' }}>HR</option>
                <option value="applicant" {{ $user->role == 'applicant' ? 'selected' : '' }}>Applicant</option>
            </select>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('users.index') }}"
               class="px-4 py-2 bg-gray-300 rounded-lg">Cancel</a>

            <button class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Update Role
            </button>
        </div>

    </form>
</div>
@endsection
