<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\ApplicantProfile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    /**
     * Show form to create a new job posting.
     */


    public function create()
    {
        return view('jobs.create', [
            'title' => 'Add Job'
        ]);
    }

    public function edit($id)
    {
        $job = Job::where('id', $id)
            ->where('created_by', Auth::id())
            ->firstOrFail();

        return view('jobs.edit', compact('job'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'           => 'required|string|max:255',
            'description'     => 'required|string',
            'location'        => 'nullable|string|max:255',
            'employment_type' => 'required|string',
            'salary'          => 'nullable|numeric',
            'deadline'        => 'nullable|date',
        ]);

        $job = Job::where('id', $id)
            ->where('created_by', Auth::id())
            ->firstOrFail();

        $job->update($request->all());

        return redirect()->route('jobs.index')->with('success', 'Job updated successfully!');
    }

    public function submitApplication(Request $request, $id)
    {
        // Check if user already applied
        $already = JobApplication::where('job_id', $id)
            ->where('user_id', Auth::id())
            ->exists();

        if ($already) {
            return redirect()->route('jobs.show', $id)
                ->with('already_applied', true);
        }

        $profile = ApplicantProfile::where('user_id', Auth::id())->first();

        // If user wants to use existing CV
        if ($request->use_existing_cv && $profile && $profile->cv_path) {
            $cvPath = $profile->cv_path;
        } else {
            $request->validate([
                'cv' => 'required|mimes:pdf|max:2048',
            ]);

            $cvPath = $request->file('cv')->store('cv_uploads', 'public');
        }

        JobApplication::create([
            'job_id' => $id,
            'user_id' => Auth::id(),
            'cv_path' => $cvPath,
            'cover_letter' => $request->cover_letter,
        ]);

        return redirect()->route('jobs.show', $id)
            ->with('application_success', true);
    }



    /**
     * Store new job in the database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'           => 'required|string|max:255',
            'description'     => 'required|string',
            'location'        => 'nullable|string|max:255',
            'employment_type' => 'required|string|max:100',
            'salary'          => 'nullable|numeric',
            'deadline'        => 'nullable|date',
        ]);

        Job::create([
            'title'           => $request->title,
            'description'     => $request->description,
            'location'        => $request->location,
            'employment_type' => $request->employment_type,
            'salary'          => $request->salary,
            'deadline'        => $request->deadline,
            'created_by'      => Auth::id(),
        ]);

        return redirect()->route('jobs.index')->with('success', 'Job created successfully!');
    }

    public function destroy($id)
    {
        $job = Job::where('id', $id)
            ->where('created_by', Auth::id())
            ->firstOrFail();

        $job->delete();

        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully!');
    }

    public function publicList()
    {
        // Show all jobs to everyone
        $jobs = Job::where('is_hidden', false)
               ->orderBy('created_at', 'desc')
               ->get();

        return view('jobs.public_list', compact('jobs'));
    }

    public function show($id)
    {
        $job = Job::findOrFail($id);

        $applications = [];

        if (Auth::user()->role === 'hr' || Auth::user()->role === 'admin') {
            $applications = JobApplication::where('job_id', $id)
                ->with('user')
                ->get();
        }

        return view('jobs.show', compact('job', 'applications'));
    }



    public function applyForm($id)
    {
        $job = Job::findOrFail($id);

        // get the logged-in user's applicant profile (may be null)
        $profile = ApplicantProfile::where('user_id', Auth::id())->first();

        // pass both job and profile to the view
        return view('jobs.apply', compact('job', 'profile'));
    }

    public function toggleVisibility($id)
    {
        $job = Job::where('id', $id)
            ->where('created_by', Auth::id())
            ->firstOrFail();

        // Toggle true/false
        $job->is_hidden = !$job->is_hidden;
        $job->save();

        return redirect()->route('jobs.index')
            ->with('success', $job->is_hidden ? 'Job hidden successfully!' : 'Job is now visible!');
    }



    public function applicants($id)
    {
        $job = Job::where('id', $id)
            ->where('created_by', Auth::id()) // only HR who owns this job
            ->firstOrFail();

        $applications = JobApplication::where('job_id', $id)->with('user')->get();

        return view('jobs.applicants', compact('job', 'applications'));
    }


    /**
     * Display list of all jobs.
     */
    public function index()
    {
        $jobs = Job::where('created_by', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('jobs.index', compact('jobs'));
    }
}
