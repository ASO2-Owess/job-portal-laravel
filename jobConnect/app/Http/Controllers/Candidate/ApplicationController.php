<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Models\JobPost;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
   public function apply(Request $request, JobPost $jobPost)
{
    abort_unless(Auth::guard('candidate')->check(), 403);

    $candidate = Auth::guard('candidate')->user();

    $alreadyApplied = $jobPost->applications()
        ->where('freelancer_id', $candidate->id)
        ->exists();

    if ($alreadyApplied) {
        return back()->with('status', 'Vous avez déjà postulé à cette offre.');
    }

    $validated = $request->validate([
        'cover_letter' => ['required', 'string', 'min:20', 'max:2000'],
    ]);

    $jobPost->applications()->create([
        'freelancer_id' => $candidate->id,
        'cover_letter' => $validated['cover_letter'],
        'status' => 'pending',
    ]);

    return back()->with('status', 'Candidature envoyée avec succès.');
}

    public function index()
    {
        $candidate = Auth::guard('candidate')->user();

        $applications = $candidate->applications()->with('jobPost.client')->latest()->paginate(10);

        return view('candidate.applications', compact('applications'));
    }
}
