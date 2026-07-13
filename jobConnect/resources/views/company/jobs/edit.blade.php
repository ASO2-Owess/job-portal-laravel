@extends('layouts.app')

@section('title', 'Editer l\'offre')

@section('content')
<section class="page-hero mb-4">
    <span class="soft-label mb-3">Gestion des offres</span>
    <div class="row align-items-end g-3">
        <div class="col-lg-8">
            <h1 class="display-font display-6 mb-2">Editer l'offre</h1>
            <p class="text-secondary-custom mb-0">Ajustez le titre, la description et le statut de publication de cette mission.</p>
        </div>
        <div class="col-lg-4 text-lg-end">
            <a href="{{ route('company.jobs.index') }}" class="btn btn-outline-light">Retour aux offres</a>
        </div>
    </div>
</section>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card-surface p-4 p-md-5">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('company.jobs.update', $jobPost) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">Titre du poste</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $jobPost->title) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Description</label>
                    <textarea name="description" class="form-control" rows="8" required>{{ old('description', $jobPost->description) }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Statut</label>
                    <select name="status" class="form-select">
                        @foreach (['open' => 'Ouverte', 'in_progress' => 'En cours', 'completed' => 'Terminee', 'cancelled' => 'Annulee'] as $status => $label)
                            <option value="{{ $status }}" @selected(old('status', $jobPost->status) === $status)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-company w-100 py-2">Enregistrer les changements</button>
            </form>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="soft-card p-4 mb-3">
            <div class="avatar-mark mb-3">S</div>
            <p class="small text-uppercase fw-bold text-secondary-custom mb-1">Statut actuel</p>
            <span class="status-pill {{ $jobPost->status === 'completed' ? 'success' : ($jobPost->status === 'cancelled' ? 'danger' : 'pending') }}">
                {{ $jobPost->status }}
            </span>
        </div>

        <div class="soft-card p-4">
            <p class="small text-uppercase fw-bold text-secondary-custom mb-2">Actions</p>
            <a href="{{ route('company.jobs.applications', $jobPost) }}" class="btn btn-outline-light w-100 mb-2">Voir les candidatures</a>
            <a href="{{ route('jobs.show', $jobPost) }}" class="btn btn-outline-light w-100">Voir la page publique</a>
        </div>
    </div>
</div>
@endsection
