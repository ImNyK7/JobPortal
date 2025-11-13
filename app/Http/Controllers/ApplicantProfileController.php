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
        $profile = ApplicantProfile::where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'address' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'last_education' => 'nullable|string|max:255',
            'previous_job' => 'nullable|string|max:255',
            'skills' => 'nullable|string|max:255',
            'about' => 'nullable|string',
            'cv' => 'nullable|mimes:pdf|max:2048',
        ]);

        // Save CV if uploaded
        if ($request->hasFile('cv')) {
            $path = $request->file('cv')->store('cv_uploads', 'public');
            $profile->cv_path = $path;
        }

        $profile->update($request->except('cv'));

        return back()->with('success', 'Profile updated successfully!');
    }
}
