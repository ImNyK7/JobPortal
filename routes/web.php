<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicantProfileController;

Route::get('/', function () {
    return view('welcome');
});

// =====================
// 🔹 Registration Routes
// =====================
Route::get('/register', function () {
    return view('auth.register');
})->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// =====================
// 🔹 Login Routes
// =====================
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// =====================
// 🔒 Protected Routes (must be logged in)
// =====================
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile Settings
    Route::get('/settings', [ApplicantProfileController::class, 'edit'])->name('settings');
    Route::post('/settings', [ApplicantProfileController::class, 'update'])->name('settings.update');

    Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
    Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
    Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
    Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');

    Route::get('/jobs/{id}/edit', [JobController::class, 'edit'])->name('jobs.edit');
    Route::put('/jobs/{id}', [JobController::class, 'update'])->name('jobs.update');

    Route::delete('/jobs/{id}', [JobController::class, 'destroy'])->name('jobs.destroy');
});

Route::get('/job-list', [JobController::class, 'publicList'])->name('jobs.list');

Route::get('/job/{id}', [JobController::class, 'show'])->name('jobs.show');



