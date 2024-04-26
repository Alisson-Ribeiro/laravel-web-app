<?php

use Illuminate\Support\Facades\Route;
use App\Models\job;

Route::get('/', function () {
    
    return view('index');
});


Route::get('/jobs', function () {
    $jobs = job::with('employer')->latest()->paginate(5);
    
    return view('jobs/index', [
        'jobs' => $jobs
    ]);
});

// CREATE
Route::get('/jobs/create', function() {
    
    return view('jobs/create');
});

// SHOW
Route::get('/jobs/{id}', function ($id) {
    $job = job::find($id);
    
    return view ('jobs/show', ['job' => $job]);
});

// STORE
Route::post('/jobs', function(){
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
});

// EDIT
Route::get('/jobs/{id}/edit', function ($id) {
    $job = job::find($id);
    
    return view ('jobs/edit', ['job' => $job]);
});

// UPDATE
Route::patch('/jobs/{id}', function ($id) {
   
    // validate
    request()->validate([
        'title' => 'required|min:3',
        'salary' => 'required',
    ]);

    // authorize ( On hold...)

    // update
    $job = job::findOrFail($id);

    $job->update([
        'title'=>request('title'),
        'salary'=>request('salary'),
    ]);

    // redirect to the job page
    return redirect('/jobs/'. $job->id);

});

// DELETE
Route::delete('/jobs/{id}', function ($id) {
    // authorize ( On hold...)

    // delete the job
    $job = job::findOrFail($id)->delete();

    // redirect
    return redirect('/jobs');

});

Route::get('/contact', function () {
    
    return view('contact');
});