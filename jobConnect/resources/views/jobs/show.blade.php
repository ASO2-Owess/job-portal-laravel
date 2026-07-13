@extends('layouts.app')

@section('title', $jobPost->title)

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="card-surface p-4 p-md-5">
            <div class="d-flex align-items-center gap-3 mb-4">
                @if ($jobPost->client->logo_path)
                    <img src="{{ asset('storage/' . $jobPost->client->logo_path) }}" alt="{{ $jobPost->client->company_name }}" class="rounded-circle" width="64" height="64" style="object-fit: cover;">
                @else
                    <div class="image-placeholder" style="width:64px;height:64px;min-height:64px;border-radius:20px;">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M4 21V7l8-4 8 4v14" />
                            <path d="M9 21v-7h6v7" />
                        </svg>
                    </div>
                @endif
                <div>
                    <p class="mb-1 fw-semibold">{{ $jobPost->client->company_name }}</p>
                    <span class="status-pill success">{{ $jobPost->status }}</span>
                </div>
            </div>

            <span class="soft-label mb-3">Offre d'emploi</span>
            <h1 class="display-font h2 mb-3">{{ $jobPost->title }}</h1>
            <p class="text-secondary-custom" style="white-space: pre-line;">{{ $jobPost->description }}</p>

            <hr class="my-4" style="border-color: var(--border-subtle);">

            @auth('candidate')
                @if ($hasApplied)
                    <div class="image-placeholder mb-3">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M20 6L9 17l-5-5" />
                        </svg>
                        <span>Vous avez deja postule a cette offre</span>
                    </div>
                    <button class="btn btn-outline-light w-100" disabled>Deja postule</button>
                @else
                    <form method="POST" action="{{ route('candidate.jobs.apply', $jobPost) }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Message de motivation</label>
                            <textarea name="cover_letter" class="form-control" rows="5" placeholder="Expliquez pourquoi vous etes le bon candidat pour ce poste..." required>{{ old('cover_letter') }}</textarea>
                            @error('cover_letter')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-candidate w-100">Postuler a cette offre</button>
                    </form>
                @endif
            @else
                @auth('company')
                    <div class="image-placeholder mb-3">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M20 21a8 8 0 0 0-16 0" />
                            <circle cx="12" cy="8" r="4" />
                        </svg>
                        <span>Seul un compte candidat peut postuler</span>
                    </div>
                    <p class="text-secondary-custom small mb-0">Vous etes connecte avec un compte entreprise. Utilisez un compte candidat approprie pour envoyer une candidature.</p>
                @else
                    <div class="image-placeholder mb-3">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M15 3h4a2 2 0 0 1 2 2v4" />
                            <path d="M10 14L21 3" />
                            <path d="M21 14v5a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5" />
                        </svg>
                        <span>Connexion candidat requise</span>
                    </div>
                    <a href="{{ route('candidate.login') }}" class="btn btn-candidate w-100">Se connecter pour postuler</a>
                @endauth
            @endauth
        </div>
    </div>
</div>
@endsection
