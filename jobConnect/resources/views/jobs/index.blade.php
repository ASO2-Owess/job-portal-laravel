@extends('layouts.app')

@section('title', 'Offres d\'emploi')

@section('content')

<h1 class="h4 display-font mb-4">Toutes les offres</h1>

<form method="GET" action="{{ route('jobs.index') }}" class="mb-4">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Rechercher un poste..." value="{{ request('search') }}">
        <button class="btn btn-company" type="submit">Rechercher</button>
    </div>
</form>

<div class="row g-4">
    @forelse ($jobPosts as $job)
        <div class="col-md-4">
            <div class="card-surface p-4 h-100">
                <div class="d-flex align-items-center gap-2 mb-3">
                    @if ($job->client->logo_path)
                        <img src="{{ asset('storage/' . $job->client->logo_path) }}" alt="{{ $job->client->company_name }}" class="rounded-circle" width="36" height="36" style="object-fit: cover;">
                    @else
                        <div class="image-placeholder" style="width:40px;height:40px;min-height:40px;border-radius:14px;">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M4 21V7l8-4 8 4v14" />
                                <path d="M9 21v-7h6v7" />
                            </svg>
                        </div>
                    @endif
                    <span class="text-secondary-custom small">{{ $job->client->company_name }}</span>
                </div>

                <h3 class="h5 mb-2">{{ $job->title }}</h3>
                <p class="text-secondary-custom small mb-3">{{ Str::limit($job->description, 90) }}</p>

                <a href="{{ route('jobs.show', $job) }}" class="btn btn-company btn-sm w-100 mt-auto">Voir l'offre</a>
            </div>
        </div>
    @empty
        <p class="text-secondary-custom">Aucune offre disponible.</p>
    @endforelse
</div>

<div class="mt-4">
    {{ $jobPosts->links() }}
</div>

@endsection
