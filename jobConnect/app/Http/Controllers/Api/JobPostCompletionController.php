<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompleteJobRequest;
use App\Http\Resources\JobPostResource;
use App\Models\JobPost;
use Illuminate\Support\Facades\Gate;

class JobPostCompletionController extends Controller
{
    public function complete(CompleteJobRequest $request, JobPost $jobPost)
    {
        Gate::authorize('complete', $jobPost);

        $jobPost->update([
            'status' => 'completed',
            'completed_at' => now(),
        ]);

        // Le champ "notes" validé est disponible ici si tu veux le stocker
        // (ex: dans une table job_completion_notes ou une colonne dédiée) :
        // $request->validated('notes')

        return new JobPostResource($jobPost->load('client'));
    }
}
