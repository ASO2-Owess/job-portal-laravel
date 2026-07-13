<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobPostController extends Controller
{
    public function dashboard()
    {
        $company = Auth::guard('company')->user();

        $activeJobsCount = $company->jobPosts()->where('status', 'open')->count();
        $applicationsCount = JobApplication::whereHas('jobPost', function ($query) use ($company) {
            $query->where('client_id', $company->id);
        })->count();

        $recentJobs = $company->jobPosts()->latest()->take(5)->get();

        return view('company.dashboard', compact('activeJobsCount', 'applicationsCount', 'recentJobs'));
    }

    public function index()
    {
        $jobPosts = Auth::guard('company')->user()->jobPosts()->latest()->paginate(10);

        return view('company.jobs.index', compact('jobPosts'));
    }

    public function create()
    {
        return view('company.jobs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);

        Auth::guard('company')->user()->jobPosts()->create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'status' => 'open',
        ]);

        return redirect()->route('company.jobs.index')->with('status', 'Offre publiée avec succès.');
    }

    public function edit(JobPost $jobPost)
    {
        abort_if($jobPost->client_id !== Auth::guard('company')->id(), 403);

        return view('company.jobs.edit', compact('jobPost'));
    }

    public function update(Request $request, JobPost $jobPost)
    {
        abort_if($jobPost->client_id !== Auth::guard('company')->id(), 403);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'status' => ['required', 'in:open,in_progress,completed,cancelled'],
        ]);

        $jobPost->update($validated);

        return redirect()->route('company.jobs.index')->with('status', 'Offre mise à jour.');
    }

    public function destroy(JobPost $jobPost)
    {
        abort_if($jobPost->client_id !== Auth::guard('company')->id(), 403);

        // Use the static destroy method to avoid instance delete signature issues
        JobPost::destroy($jobPost->id);

        return redirect()->route('company.jobs.index')->with('status', 'Offre supprimée.');
    }

    public function applications(JobPost $jobPost)
    {
        abort_if($jobPost->client_id !== Auth::guard('company')->id(), 403);

        $applications = $jobPost->applications()->with('freelancer.projects')->latest()->get();

        return view('company.jobs.applications', compact('jobPost', 'applications'));
    }

    public function updateApplicationStatus(Request $request, JobApplication $application)
    {
        abort_if($application->jobPost->client_id !== Auth::guard('company')->id(), 403);

        $validated = $request->validate([
            'status' => ['required', 'in:pending,accepted,rejected'],
        ]);

        $application->update($validated);

        return back()->with('status', 'Statut mis à jour.');
    }
}
