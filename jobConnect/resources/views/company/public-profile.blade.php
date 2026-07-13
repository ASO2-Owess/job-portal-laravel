@extends('layouts.app')

@section('title', $company->company_name)

@section('content')
<section class="page-hero mb-4">
    <div class="d-flex align-items-center gap-3 flex-wrap">
        @if ($company->logo_path)
            <img src="{{ asset('storage/' . $company->logo_path) }}" alt="{{ $company->company_name }}" class="rounded-circle" width="84" height="84" style="object-fit:cover;">
        @else
            <div class="image-placeholder" style="width:84px;height:84px;min-height:84px;border-radius:26px;">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M4 21V7l8-4 8 4v14" />
                    <path d="M9 21v-7h6v7" />
                    <path d="M8 9h.01M12 9h.01M16 9h.01" />
                </svg>
            </div>
        @endif
        <div>
            <span class="soft-label mb-2">Entreprise</span>
            <h1 class="display-font display-6 mb-1">{{ $company->company_name }}</h1>
            @if ($company->phone)
                <p class="text-secondary-custom mb-0">{{ $company->phone }}</p>
            @endif
        </div>
    </div>

    @if ($company->description)
        <p class="text-secondary-custom mt-4 mb-0" style="white-space: pre-line;">{{ $company->description }}</p>
    @endif
</section>

<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
    <div>
        <span class="soft-label mb-2">Recrutement</span>
        <h2 class="display-font h4 mb-0">Offres actives</h2>
    </div>
    <span class="status-pill success">{{ $activeJobs->count() }} offre(s)</span>
</div>

<div class="row g-4">
    @forelse ($activeJobs as $job)
        <div class="col-md-4">
            <article class="card-surface p-4 h-100">
                <div class="avatar-mark mb-3">J</div>
                <h3 class="h5 display-font mb-2">{{ $job->title }}</h3>
                <p class="text-secondary-custom small mb-3">{{ Str::limit($job->description, 90) }}</p>
                <a href="{{ route('jobs.show', $job) }}" class="btn btn-company btn-sm w-100">Voir l'offre</a>
            </article>
        </div>
    @empty
        <div class="col-12">
            <div class="card-surface p-5 text-center">
                <div class="avatar-mark mx-auto mb-3">0</div>
                <h3 class="h4 display-font mb-2">Aucune offre active</h3>
                <p class="text-secondary-custom mb-0">Cette entreprise n'a pas encore publie d'offre active.</p>
            </div>
        </div>
    @endforelse
</div>
@endsection
