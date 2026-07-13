@extends('layouts.app')

@section('title', 'Éditer le projet')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card-surface p-4 p-md-5">
            <h1 class="h4 display-font mb-4">Éditer le projet</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if ($project->screenshot_path)
                <img src="{{ asset('storage/' . $project->screenshot_path) }}" class="mb-3 rounded w-100" style="max-height:190px;object-fit:cover;">
            @else
                <div class="image-placeholder mb-4">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <rect x="3" y="5" width="18" height="14" rx="2" />
                        <path d="M8 13l2.5-2.5L14 14l2-2 3 3" />
                        <circle cx="8" cy="9" r="1" />
                    </svg>
                    <span>Ajoutez une capture d'ecran</span>
                </div>
            @endif

            <form method="POST" action="{{ route('candidate.projects.update', $project) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Titre du projet</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $project->title) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="4">{{ old('description', $project->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nouvelle capture d'écran (optionnel)</label>
                    <input type="file" name="screenshot" class="form-control" accept="image/*">
                </div>

                <div class="mb-3">
                    <label class="form-label">Lien du dépôt</label>
                    <input type="url" name="repo_url" class="form-control" value="{{ old('repo_url', $project->repo_url) }}">
                </div>

                <div class="mb-4">
                    <label class="form-label">Lien démo live</label>
                    <input type="url" name="live_url" class="form-control" value="{{ old('live_url', $project->live_url) }}">
                </div>

                <button type="submit" class="btn btn-candidate w-100">Enregistrer</button>
            </form>
        </div>
    </div>
</div>
@endsection
