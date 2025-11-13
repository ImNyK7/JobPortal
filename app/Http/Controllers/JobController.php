<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
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
        $jobs = Job::orderBy('created_at', 'desc')->get();

        return view('jobs.public_list', compact('jobs'));
    }

    public function show($id)
    {
        $job = Job::findOrFail($id);

        return view('jobs.show', compact('job'));
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
