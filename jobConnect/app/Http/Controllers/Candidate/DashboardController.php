<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $candidate = Auth::guard('candidate')->user();

        $applications = $candidate->applications()->with('jobPost')->latest()->take(5)->get();
        $projectsCount = $candidate->projects()->count();

        return view('candidate.dashboard', compact('applications', 'projectsCount'));
    }
}
