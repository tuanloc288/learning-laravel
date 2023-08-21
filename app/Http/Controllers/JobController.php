<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JobController extends Controller
{
    // all
    public function index()
    {
        return view('jobs.index', [
            // can use simplePaginate to show only prev and next arrow
            'jobs' => Job::latest()->filter(request(['tag', 'search']))->paginate(4)
            // latest() will add ORDER BY 'created_at' DESC to sql query
        ]);
    }

    // single
    public function show(Job $job)
    {
        return view('jobs.show', [
            'job' => $job
        ]);
    }

    // show create form
    public function create()
    {
        return view('jobs.create');
    }

    // store job data
    // for mass assignment rule error
    // solution can be found in Job model
    public function store(Request $request)
    {
        $formData = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('jobs', 'company')],
            'tags' => 'required',
            'website' => 'required',
            'location' => 'required',
            'email' => ['required', 'email'],
            'description' => 'required'
        ]);

        if ($request->hasFile('logo')) {
            // store this file to folder name logos in folder storage/app/public
            $formData['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formData['user_id'] = auth()->id();

        Job::create($formData);

        return redirect('/')->with('msgSuccess', 'Job created successfully');
    }

    // show edit form
    public function edit(Job $job)
    {
        return view('jobs.edit', ['job' => $job]);
    }

    // submit update
    public function update(Request $request, Job $job)
    {
        // make sure logged in user is the owner
        if($job->user_id === auth()->id()){
            abort(403, 'Unauthorized action');
        }

        $formData = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'tags' => 'required',
            'website' => 'required',
            'location' => 'required',
            'email' => ['required', 'email'],
            'description' => 'required'
        ]);

        if ($request->hasFile('logo')) {
            // store this file to folder name logos in folder storage/app/public
            $formData['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $job->update($formData);

        return back()->with('msgSuccess', 'Job updated successfully');
    }

    // delete job
    public function delete(Job $job)
    {
        if($job->user_id === auth()->id()){
            abort(403, 'Unauthorized action');
        }
        
        $job->delete();

        return redirect('/')->with('msgSuccess', 'Job deleted successfully');
    }

    // manage jobs
    public function manage()
    {
        return view(
            'jobs.manage',
            // just ignore the bug here
            // this auth...get will get all jobs 
            // that belong to the current user
            // jobs() method declare at user model
            ['jobs' => auth()->user()->jobs()->get()]
        );
    }
}
