<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\SessionController;


Route::view('/', 'index');
Route::view('/contact', 'contact');

// Route::controller(jobcontroller::class)->group(function(){
//     Route::get('/jobs', 'index');
//     Route::get('/jobs/create', 'create');
//     Route::get('/jobs/{job}', 'show');
//     Route::post('/jobs', 'store');
//     Route::get('/jobs/{job}/edit', 'edit');
//     Route::patch('/jobs/{job}', 'update');
//     Route::delete('/jobs/{job}', 'destroy');
// });

Route::resource('jobs', jobcontroller::class)->middleware('auth');

// Route::resource('jobs', jobcontroller::class, [
// 'only' => ['index', 'show', 'create', 'store']  
// ]);

// OR

// Route::resource('jobs', jobcontroller::class, [
// 'except' => ['edit']  
// ]);

// AUTH
Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);