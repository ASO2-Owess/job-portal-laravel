<?php

use App\Http\Controllers\Api\JobPostCompletionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->patch('/job-posts/{jobPost}/complete', [JobPostCompletionController::class, 'complete']);
