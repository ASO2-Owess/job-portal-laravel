@extends('layouts.app')

@section('title', 'Dashboard Candidat')

@section('content')

<h1 class="h4 display-font mb-4">Mon espace</h1>

<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="card-surface p-4">
            <p class="text-secondary-custom small mb-1">Candidatures envoyées</p>
            <p class="display-font h2 mb-0">{{ $applications->count() }}</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card-surface p-4">
            <p class="text-secondary-custom small mb-1">Projets portfolio</p>
            <p class="display-font h2 mb-0">{{ $projectsCount }}</p>
        </div>
    </div>
    <div class="col-md-4 d-flex align-items-stretch">
        <a href="#" class="btn btn-candidate w-100 d-flex align-items-center justify-content-center">
            + Ajouter un projet
        </a>
    </div>
</div>

<h2 class="h5 display-font mb-3">Mes dernières candidatures</h2>

<div class="row g-3">
    @forelse ($applications as $application)
        <div class="col-12">
            <div class="card-surface p-3 d-flex flex-row justify-content-between align-items-center">
                <div>
                    <p class="mb-1 fw-semibold">{{ $application->jobPost->title }}</p>
                    <span class="status-pill {{ $application->status === 'accepted' ? 'success' : ($application->status === 'rejected' ? 'danger' : 'pending') }}">
                        {{ $application->status }}
                    </span>
                </div>
                <a href="#" class="btn btn-outline-light btn-sm">Voir l'offre</a>
            </div>
        </div>
    @empty
        <p class="text-secondary-custom">Vous n'avez pas encore postulé à une offre.</p>
    @endforelse
</div>

@endsection
