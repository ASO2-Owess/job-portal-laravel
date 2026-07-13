<?php

use App\Http\Controllers\Auth\CandidateAuthController;
use App\Http\Controllers\Auth\CompanyAuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Company\JobPostController as CompanyJobPostController;
use App\Http\Controllers\Candidate\DashboardController as CandidateDashboardController;
use App\Http\Controllers\Candidate\ApplicationController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\Candidate\ProjectController;
use App\Http\Controllers\Candidate\ProfileController;
use App\Http\Controllers\Company\ProfileController as CompanyProfileController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{jobPost}', [JobController::class, 'show'])->name('jobs.show');
Route::get('/companies/{company}', [JobController::class, 'companyProfile'])->name('companies.show');

// --- Company auth ---
Route::prefix('company')->name('company.')->group(function () {
    Route::get('register', [CompanyAuthController::class, 'showRegister'])->name('register');
    Route::post('register', [CompanyAuthController::class, 'register']);
    Route::get('login', [CompanyAuthController::class, 'showLogin'])->name('login');
    Route::post('login', [CompanyAuthController::class, 'login']);
    Route::post('logout', [CompanyAuthController::class, 'logout'])->name('logout');

   Route::middleware('auth:company')->group(function () {
        Route::get('dashboard', [CompanyJobPostController::class, 'dashboard'])->name('dashboard');

        Route::get('jobs', [CompanyJobPostController::class, 'index'])->name('jobs.index');
        Route::get('jobs/create', [CompanyJobPostController::class, 'create'])->name('jobs.create');
        Route::post('jobs', [CompanyJobPostController::class, 'store'])->name('jobs.store');
        Route::get('jobs/{jobPost}/edit', [CompanyJobPostController::class, 'edit'])->name('jobs.edit');
        Route::put('jobs/{jobPost}', [CompanyJobPostController::class, 'update'])->name('jobs.update');
        Route::delete('jobs/{jobPost}', [CompanyJobPostController::class, 'destroy'])->name('jobs.destroy');
        Route::get('jobs/{jobPost}/applications', [CompanyJobPostController::class, 'applications'])->name('jobs.applications');
        Route::patch('applications/{application}/status', [CompanyJobPostController::class, 'updateApplicationStatus'])->name('applications.status');
        Route::get('profile', [CompanyProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profile', [CompanyProfileController::class, 'update'])->name('profile.update');
    });
});

// --- Candidate auth ---
Route::prefix('candidate')->name('candidate.')->group(function () {
    Route::get('register', [CandidateAuthController::class, 'showRegister'])->name('register');
    Route::post('register', [CandidateAuthController::class, 'register']);
    Route::get('login', [CandidateAuthController::class, 'showLogin'])->name('login');
    Route::post('login', [CandidateAuthController::class, 'login']);
    Route::post('logout', [CandidateAuthController::class, 'logout'])->name('logout');

   Route::middleware('auth:candidate')->group(function () {
        Route::get('dashboard', [CandidateDashboardController::class, 'index'])->name('dashboard');

        Route::post('jobs/{jobPost}/apply', [ApplicationController::class, 'apply'])->name('jobs.apply');
        Route::get('applications', [ApplicationController::class, 'index'])->name('applications.index');
         Route::get('projects', [ProjectController::class, 'index'])->name('projects.index');
        Route::get('projects/create', [ProjectController::class, 'create'])->name('projects.create');
        Route::post('projects', [ProjectController::class, 'store'])->name('projects.store');
        Route::get('projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
        Route::put('projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
        Route::delete('projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
        Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    });
});
