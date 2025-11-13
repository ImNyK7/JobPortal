<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ApplicantProfile;

class ApplicantProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $profile = ApplicantProfile::firstOrCreate(['user_id' => $user->id]);
        return view('settings', compact('user', 'profile'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'last_education' => 'required|string|max:100',
            'previous_job' => 'nullable|string|max:100',
            'skills' => 'nullable|string|max:255',
            'about' => 'nullable|string|max:500',
        ]);

        $profile = ApplicantProfile::updateOrCreate(
            ['user_id' => Auth::id()],
            $request->only('address', 'date_of_birth', 'last_education', 'previous_job', 'skills', 'about')
        );

        return redirect()->route('settings')->with('success', 'Profile updated successfully!');
    }
}
