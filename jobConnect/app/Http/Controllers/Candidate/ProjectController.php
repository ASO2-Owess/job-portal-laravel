<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Auth::guard('candidate')->user()->projects()->latest()->get();

        return view('candidate.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('candidate.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'screenshot' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'repo_url' => ['nullable', 'url', 'max:255'],
            'live_url' => ['nullable', 'url', 'max:255'],
        ]);

        $screenshotPath = null;
        if ($request->hasFile('screenshot')) {
            $screenshotPath = $request->file('screenshot')->store('projects', 'public');
        }

        Auth::guard('candidate')->user()->projects()->create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'screenshot_path' => $screenshotPath,
            'repo_url' => $validated['repo_url'] ?? null,
            'live_url' => $validated['live_url'] ?? null,
        ]);

        return redirect()->route('candidate.projects.index')->with('status', 'Projet ajouté.');
    }

    public function edit(Project $project)
    {
        abort_if($project->candidate_id !== Auth::guard('candidate')->id(), 403);

        return view('candidate.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        abort_if($project->candidate_id !== Auth::guard('candidate')->id(), 403);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'screenshot' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'repo_url' => ['nullable', 'url', 'max:255'],
            'live_url' => ['nullable', 'url', 'max:255'],
        ]);

        if ($request->hasFile('screenshot')) {
            if ($project->screenshot_path) {
                Storage::disk('public')->delete($project->screenshot_path);
            }
            $validated['screenshot_path'] = $request->file('screenshot')->store('projects', 'public');
        }

        $project->update($validated);

        return redirect()->route('candidate.projects.index')->with('status', 'Projet mis à jour.');
    }

    public function destroy(Project $project)
    {
        abort_if($project->candidate_id !== Auth::guard('candidate')->id(), 403);

        if ($project->screenshot_path) {
            Storage::disk('public')->delete($project->screenshot_path);
        }

        Project::destroy($project->id);

        return redirect()->route('candidate.projects.index')->with('status', 'Projet supprimé.');
    }
}
