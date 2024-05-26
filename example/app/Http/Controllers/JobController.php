<?php

namespace App\Http\Controllers;
use App\Models\job;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\mail;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::with('employer')->latest()->paginate(5);
    
            return view('jobs/index', [
                'jobs' => $jobs
        ]);
    }
    
    public function create()
    {
        return view('jobs/create');
    }

    public function show(job $job)
    {
        return view ('jobs/show', ['job' => $job]);
    }

    public function store()
    {
        request()->validate([
            'title' => 'required|min:3',
            'salary' => 'required',
        ]);
        
        $job = job::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => 1
        ]);

        $employerUser = $job->employer->user;
        Mail::to($employerUser->email)->send(new \App\Mail\JobPosted($job));

        // mail::to('$job->employer->user')->
        // send(new \App\Mail\JobPosted($job));
    
        return redirect('/jobs');
    }

    public function edit(job $job)
    {
        // if (Auth::user()->cannot('edit-job', $job))
        // {
        //     abort(403);
        // }

        Gate::authorize('edit-job', $job);

        return view ('jobs/edit', ['job' => $job]);
    }

    public function update(job $job)
    {
        // authorize

        Gate::authorize('edit-job', $job);

        // validate
        request()->validate([
            'title' => 'required|min:3',
            'salary' => 'required',
        ]);

        // update
        $job->update([
            'title'=>request('title'),
            'salary'=>request('salary'),
        ]);

        // redirect to the job page
        return redirect('/jobs/'. $job->id);
    }

    public function destroy(job $job)
    {
        // authorize

        Gate::authorize('edit-job', $job);

        // delete the job
        $job->delete();

        // redirect
        return redirect('/jobs');
    }
}
