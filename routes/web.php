<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicantProfileController;
use App\Http\Controllers\UserController;

/* ================================
|   PUBLIC ROUTES
================================ */
Route::get('/', fn() => view('welcome'));

Route::get('/register', fn() => view('auth.register'))->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/login', fn() => view('auth.login'))->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

/* ================================
|   PROTECTED ROUTES (AUTH REQUIRED)
================================ */
Route::middleware(['auth'])->group(function () {

    /* LOGOUT */
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    /* ================================
    |  SETTINGS (ALL ROLES CAN ACCESS)
    ================================= */
    Route::get('/settings', [ApplicantProfileController::class, 'edit'])->name('settings');
    Route::post('/settings', [ApplicantProfileController::class, 'update'])->name('settings.update');

    /* ================================
    |  ADMIN ONLY (USER MANAGEMENT)
    ================================= */
    Route::middleware(['role:admin'])->group(function () {

        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/{id}/edit-role', [UserController::class, 'editRole'])->name('users.edit.role');
        Route::put('/users/{id}/update-role', [UserController::class, 'updateRole'])->name('users.update.role');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    });

    /* ================================
    |  ADMIN + HR (JOB MANAGEMENT)
    ================================= */
    Route::middleware(['role:admin,hr'])->group(function () {

        // Job CRUD
        Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
        Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
        Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
        Route::get('/jobs/{id}/edit', [JobController::class, 'edit'])->name('jobs.edit');
        Route::put('/jobs/{id}', [JobController::class, 'update'])->name('jobs.update');
        Route::delete('/jobs/{id}', [JobController::class, 'destroy'])->name('jobs.destroy');

        // Hide/Show job post
        Route::patch('/jobs/{id}/toggle-visibility', [JobController::class, 'toggleVisibility'])->name('jobs.toggle');

        // Applicants for a job
        Route::get('/job/{id}/applicants', [JobController::class, 'applicants'])->name('jobs.applicants');

    });

    /* ================================
    |  SHARED BY ALL LOGGED-IN USERS
    ================================= */
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

    // Job details + applying
    Route::get('/job/{id}', [JobController::class, 'show'])->name('jobs.show');
    Route::get('/job/{id}/apply', [JobController::class, 'applyForm'])->name('jobs.apply');
    Route::post('/job/{id}/apply', [JobController::class, 'submitApplication'])->name('jobs.apply.submit');

});


/* ================================
|   PUBLIC JOB LIST
================================ */
Route::get('/job-list', [JobController::class, 'publicList'])->name('jobs.list');
