@extends('layouts.app')

@section('title', 'Dashboard Entreprise')

@section('content')

<h1 class="h4 display-font mb-4">Tableau de bord</h1>

<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="card-surface p-4">
            <p class="text-secondary-custom small mb-1">Offres actives</p>
            <p class="display-font h2 mb-0">{{ $activeJobsCount }}</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card-surface p-4">
            <p class="text-secondary-custom small mb-1">Candidatures reçues</p>
            <p class="display-font h2 mb-0">{{ $applicationsCount }}</p>
        </div>
    </div>
    <div class="col-md-4 d-flex align-items-stretch">
        <a href="{{ route('company.jobs.create') }}" class="btn btn-company w-100 d-flex align-items-center justify-content-center">
            + Publier une offre
        </a>
    </div>
</div>

<h2 class="h5 display-font mb-3">Mes dernières offres</h2>

<div class="row g-3">
    @forelse ($recentJobs as $job)
        <div class="col-12">
            <div class="card-surface p-3 d-flex flex-row justify-content-between align-items-center">
                <div>
                    <p class="mb-1 fw-semibold">{{ $job->title }}</p>
                    <span class="status-pill success">{{ $job->status }}</span>
                </div>
                <a href="{{ route('company.jobs.edit', $job) }}" class="btn btn-outline-light btn-sm">Voir</a>
            </div>
        </div>
    @empty
        <p class="text-secondary-custom">Vous n'avez pas encore publié d'offre.</p>
    @endforelse
</div>

@endsection
