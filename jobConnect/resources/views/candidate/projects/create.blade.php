@extends('layouts.app')

@section('title', 'Ajouter un projet')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card-surface p-4 p-md-5">
            <h1 class="h4 display-font mb-4">Ajouter un projet</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="image-placeholder mb-4">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <rect x="3" y="5" width="18" height="14" rx="2" />
                    <path d="M8 13l2.5-2.5L14 14l2-2 3 3" />
                    <circle cx="8" cy="9" r="1" />
                </svg>
                <span>Ajoutez une capture pour illustrer le projet</span>
            </div>

            <form method="POST" action="{{ route('candidate.projects.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Titre du projet</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Capture d'écran</label>
                    <input type="file" name="screenshot" class="form-control" accept="image/*">
                </div>

                <div class="mb-3">
                    <label class="form-label">Lien du dépôt (GitHub, GitLab...)</label>
                    <input type="url" name="repo_url" class="form-control" value="{{ old('repo_url') }}" placeholder="https://github.com/...">
                </div>

                <div class="mb-4">
                    <label class="form-label">Lien démo live (optionnel)</label>
                    <input type="url" name="live_url" class="form-control" value="{{ old('live_url') }}" placeholder="https://...">
                </div>

                <button type="submit" class="btn btn-candidate w-100">Ajouter</button>
            </form>
        </div>
    </div>
</div>
@endsection
