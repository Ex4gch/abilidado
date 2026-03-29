<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\EmployerAuthController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/profile', [ProfileController::class, 'index'])->middleware(['auth']);
Route::post('/verify-pwd', [ProfileController::class, 'verifyPwd'])->middleware('auth');

Route::post('/apply/{id}', [ApplicationController::class, 'apply']);
Route::get('/applications', [ApplicationController::class, 'index']);
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{id}', [JobController::class, 'show'])->name('jobs.show');

// Add these inside your routes
Route::middleware('guest')->group(function () {
    Route::get('/register/employer', [EmployerAuthController::class, 'create'])->name('register.employer');
    Route::post('/register/employer', [EmployerAuthController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('/employer/dashboard', [EmployerController::class, 'dashboard'])->name('employer.dashboard');
    
    // We will add the POST route for creating jobs here later!
});

Route::middleware('auth')->group(function () {
    Route::get('/employer/dashboard', [EmployerController::class, 'dashboard'])->name('employer.dashboard');
    
    // ADD THIS NEW LINE:
    Route::post('/employer/jobs', [EmployerController::class, 'storeJob']);
    Route::get('/employer/applicants', [EmployerController::class, 'applicants'])->name('employer.applicants');
    Route::patch('/employer/applications/{application}/status', [EmployerController::class, 'updateApplicationStatus']);

});



require __DIR__.'/auth.php';


