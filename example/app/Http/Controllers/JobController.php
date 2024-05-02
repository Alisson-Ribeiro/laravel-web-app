<?php

namespace App\Http\Controllers;
use App\Models\job;
use Illuminate\Http\Request;

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
        
        job::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => 1
        ]);
    
        return redirect('/jobs');
    }

    public function edit(job $job)
    {
        return view ('jobs/edit', ['job' => $job]);
    }

    public function update(job $job)
    {
        // authorize ( On hold...)

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
        // authorize ( On hold...)

        // delete the job
        $job->delete();

        // redirect
        return redirect('/jobs');
    }
}
