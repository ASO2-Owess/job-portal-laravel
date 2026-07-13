@extends('layouts.app')

@section('title', 'Mon portfolio')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h4 display-font mb-0">Mon portfolio</h1>
    <a href="{{ route('candidate.projects.create') }}" class="btn btn-candidate">+ Ajouter un projet</a>
</div>

<div class="row g-4">
    @forelse ($projects as $project)
        <div class="col-md-4">
            <div class="card-surface p-0 h-100 overflow-hidden">
                @if ($project->screenshot_path)
                    <img src="{{ asset('storage/' . $project->screenshot_path) }}" class="w-100" style="height:160px;object-fit:cover;" alt="{{ $project->title }}">
                @else
                    <div class="image-placeholder w-100" style="height:160px;border-radius:0;">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <rect x="3" y="5" width="18" height="14" rx="2" />
                            <path d="M8 13l2.5-2.5L14 14l2-2 3 3" />
                            <circle cx="8" cy="9" r="1" />
                        </svg>
                        <span>Capture modifiable</span>
                    </div>
                @endif
                <div class="p-3">
                    <h3 class="h6 mb-2">{{ $project->title }}</h3>
                    <p class="text-secondary-custom small mb-3">{{ Str::limit($project->description, 80) }}</p>
                    <div class="d-flex gap-2 flex-wrap">
                        @if ($project->repo_url)
                            <a href="{{ $project->repo_url }}" target="_blank" class="btn btn-outline-light btn-sm">Dépôt</a>
                        @endif
                        @if ($project->live_url)
                            <a href="{{ $project->live_url }}" target="_blank" class="btn btn-outline-light btn-sm">Démo</a>
                        @endif
                        <a href="{{ route('candidate.projects.edit', $project) }}" class="btn btn-outline-light btn-sm">Éditer</a>
                        <form method="POST" action="{{ route('candidate.projects.destroy', $project) }}" onsubmit="return confirm('Supprimer ce projet ?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm">Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <p class="text-secondary-custom">Aucun projet ajouté pour l'instant.</p>
    @endforelse
</div>

@endsection
