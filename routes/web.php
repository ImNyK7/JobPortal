<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicantProfileController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

// Registration
Route::get('/register', fn() => view('auth.register'))->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Login
Route::get('/login', fn() => view('auth.login'))->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Protected Routes
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

    // Settings
    Route::get('/settings', [ApplicantProfileController::class, 'edit'])->name('settings');
    Route::post('/settings', [ApplicantProfileController::class, 'update'])->name('settings.update');

    // Job CRUD
    Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
    Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
    Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
    Route::get('/jobs/{id}/edit', [JobController::class, 'edit'])->name('jobs.edit');
    Route::put('/jobs/{id}', [JobController::class, 'update'])->name('jobs.update');
    Route::delete('/jobs/{id}', [JobController::class, 'destroy'])->name('jobs.destroy');

    // Apply
    Route::get('/job/{id}/apply', [JobController::class, 'applyForm'])->name('jobs.apply');
    Route::post('/job/{id}/apply', [JobController::class, 'submitApplication'])->name('jobs.apply.submit');

    // Applicants list
    Route::get('/job/{id}/applicants', [JobController::class, 'applicants'])->name('jobs.applicants');

    // Users (Admin/HR)
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{id}/edit-role', [UserController::class, 'editRole'])->name('users.edit.role');
    Route::put('/users/{id}/update-role', [UserController::class, 'updateRole'])->name('users.update.role');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Public job list
Route::get('/job-list', [JobController::class, 'publicList'])->name('jobs.list');

// Public job detail
Route::get('/job/{id}', [JobController::class, 'show'])->name('jobs.show');

Route::patch('/jobs/{id}/toggle-visibility', [JobController::class, 'toggleVisibility'])
     ->name('jobs.toggle');
