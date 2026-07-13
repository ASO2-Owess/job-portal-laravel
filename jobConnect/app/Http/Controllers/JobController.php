<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $query = JobPost::with('client')->where('status', 'open');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $jobPosts = $query->latest()->paginate(9)->withQueryString();

        return view('jobs.index', compact('jobPosts'));
    }

    public function show(JobPost $jobPost)
    {
        $jobPost->load('client');

        $hasApplied = false;
        if (Auth::guard('candidate')->check()) {
            $hasApplied = $jobPost->applications()
                ->where('freelancer_id', Auth::guard('candidate')->id())
                ->exists();
        }

        return view('jobs.show', compact('jobPost', 'hasApplied'));
    }
    public function companyProfile(\App\Models\Company $company)
{
    $activeJobs = $company->jobPosts()->where('status', 'open')->latest()->get();

    return view('company.public-profile', compact('company', 'activeJobs'));
}
}
