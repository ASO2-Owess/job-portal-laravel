@extends('layouts.app')

@section('title', 'JobConnect - Trouvez le bon match')

@section('content')
<section class="page-hero mb-4">
    <div class="row align-items-center g-4">
        <div class="col-lg-7">
            <span class="soft-label mb-3">Plateforme emploi</span>
            <h1 class="display-font display-4 fw-bold mb-3">JobConnect</h1>
            <p class="lead text-secondary-custom mb-4">Un espace clair pour publier des missions, suivre les candidatures et connecter les entreprises aux bons profils.</p>
            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('candidate.register') }}" class="btn btn-candidate btn-lg">Je cherche un emploi</a>
                <a href="{{ route('company.register') }}" class="btn btn-company btn-lg">Je recrute</a>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="soft-card p-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex gap-2">
                        <span class="rounded-circle d-inline-block" style="width:10px;height:10px;background:#ef4444;"></span>
                        <span class="rounded-circle d-inline-block" style="width:10px;height:10px;background:#f59e0b;"></span>
                        <span class="rounded-circle d-inline-block" style="width:10px;height:10px;background:#10b981;"></span>
                    </div>
                    <span class="status-pill success">Live</span>
                </div>
                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <div class="soft-card p-3 shadow-none">
                            <div class="avatar-mark mb-2">C</div>
                            <p class="small text-secondary-custom mb-0">Candidatures</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="soft-card p-3 shadow-none">
                            <div class="avatar-mark mb-2" style="background:linear-gradient(135deg,#f97316,#fb923c);">O</div>
                            <p class="small text-secondary-custom mb-0">Offres actives</p>
                        </div>
                    </div>
                </div>
                <div class="soft-card p-3 shadow-none">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="avatar-mark">J</div>
                        <div class="w-100">
                            <div class="rounded-pill mb-2" style="height:10px;background:#9ca3af;width:70%;"></div>
                            <div class="rounded-pill" style="height:8px;background:#d1d5db;width:92%;"></div>
                        </div>
                    </div>
                    <div class="rounded-pill mb-2" style="height:8px;background:#d1d5db;width:80%;"></div>
                    <div class="rounded-pill" style="height:8px;background:#e5e7eb;width:64%;"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
    <div>
        <span class="soft-label mb-2">Opportunites</span>
        <h2 class="display-font h4 mb-0">Offres recentes</h2>
    </div>
    <a href="{{ route('jobs.index') }}" class="btn btn-outline-light">Voir toutes les offres</a>
</div>

<div class="row g-4">
    @forelse ($jobPosts as $job)
        <div class="col-md-4">
            <article class="card-surface p-4 h-100">
                <div class="d-flex align-items-center gap-2 mb-3">
                    @if ($job->client->logo_path)
                        <img src="{{ asset('storage/' . $job->client->logo_path) }}" alt="{{ $job->client->company_name }}" class="rounded-circle" width="42" height="42" style="object-fit: cover;">
                    @else
                        <div class="image-placeholder" style="width:42px;height:42px;min-height:42px;border-radius:14px;">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M4 21V7l8-4 8 4v14" />
                                <path d="M9 21v-7h6v7" />
                            </svg>
                        </div>
                    @endif
                    <span class="text-secondary-custom small">{{ $job->client->company_name }}</span>
                </div>

                <h3 class="h5 display-font mb-2">{{ $job->title }}</h3>
                <p class="text-secondary-custom small mb-3">{{ Str::limit($job->description, 92) }}</p>
                <a href="{{ route('jobs.show', $job) }}" class="btn btn-company btn-sm w-100 mt-auto">Voir l'offre</a>
            </article>
        </div>
    @empty
        <div class="col-12">
            <div class="card-surface p-5 text-center">
                <h3 class="h4 display-font mb-2">Aucune offre disponible</h3>
                <p class="text-secondary-custom mb-0">Les nouvelles offres apparaitront ici.</p>
            </div>
        </div>
    @endforelse
</div>
@endsection
