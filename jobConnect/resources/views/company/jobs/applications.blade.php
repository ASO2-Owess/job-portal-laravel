@extends('layouts.app')

@section('title', 'Candidatures - ' . $jobPost->title)

@push('styles')
<style>
    body {
        background:
            radial-gradient(circle at 6% 12%, rgba(79, 70, 229, 0.14), transparent 28%),
            radial-gradient(circle at 88% 18%, rgba(249, 115, 22, 0.12), transparent 24%),
            linear-gradient(135deg, #f8f9ff 0%, #eef1ff 46%, #fff7f0 100%);
        color: #1f2937;
    }

    .applications-page {
        margin-inline: calc(50% - 50vw);
        padding: 12px clamp(16px, 4vw, 48px) 40px;
        overflow: hidden;
    }

    .applications-board {
        max-width: 1280px;
        margin: 0 auto;
    }

    .glass-panel,
    .candidate-panel,
    .metric-card,
    .portfolio-item {
        background: rgba(255, 255, 255, 0.88);
        border: 1px solid rgba(148, 163, 184, 0.18);
        box-shadow: 0 22px 60px rgba(79, 70, 229, 0.13);
        backdrop-filter: blur(18px);
    }

    .glass-panel {
        border-radius: 18px;
        padding: clamp(20px, 4vw, 36px);
        position: relative;
    }

    .glass-panel::after {
        content: "";
        position: absolute;
        right: clamp(20px, 5vw, 64px);
        top: 26px;
        width: 154px;
        height: 122px;
        border-radius: 28px;
        background:
            linear-gradient(145deg, rgba(79, 70, 229, 0.18), rgba(124, 58, 237, 0.04)),
            linear-gradient(#ffffff, #ffffff);
        box-shadow: inset 0 0 0 1px rgba(79, 70, 229, 0.12), 0 18px 34px rgba(79, 70, 229, 0.14);
        z-index: 0;
    }

    .hero-content {
        position: relative;
        z-index: 1;
        max-width: 760px;
    }

    .soft-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 7px 12px;
        border-radius: 999px;
        color: #4f46e5;
        background: rgba(79, 70, 229, 0.09);
        font-size: 0.76rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
    }

    .hero-title {
        color: #111827;
        font-size: clamp(1.8rem, 3.4vw, 3.2rem);
        line-height: 1.04;
        letter-spacing: 0;
    }

    .hero-copy,
    .muted-text {
        color: #697386;
    }

    .metric-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 14px;
    }

    .metric-card {
        border-radius: 14px;
        padding: 18px;
        min-height: 118px;
    }

    .metric-icon,
    .avatar-fallback {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 42px;
        height: 42px;
        border-radius: 14px;
        color: #ffffff;
        font-weight: 800;
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        box-shadow: 0 12px 28px rgba(79, 70, 229, 0.28);
    }

    .metric-icon.orange {
        background: linear-gradient(135deg, #f97316, #fb923c);
        box-shadow: 0 12px 28px rgba(249, 115, 22, 0.24);
    }

    .metric-card p,
    .candidate-meta,
    .portfolio-item p {
        color: #7b8193;
    }

    .candidate-panel {
        border-radius: 16px;
        padding: 18px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .candidate-panel:hover {
        transform: translateY(-3px);
        box-shadow: 0 26px 70px rgba(79, 70, 229, 0.18);
    }

    .candidate-avatar {
        width: 54px;
        height: 54px;
        border-radius: 18px;
        object-fit: cover;
        box-shadow: 0 14px 30px rgba(15, 23, 42, 0.12);
    }

    .candidate-name,
    .panel-title {
        color: #111827;
    }

    .status-pill {
        background: #f8fafc;
        border: 1px solid #e5e7eb;
    }

    .status-pill.success { color: #059669; }
    .status-pill.pending { color: #d97706; }
    .status-pill.danger { color: #dc2626; }

    .cover-letter {
        color: #4b5563;
        background: #f8fafc;
        border: 1px solid #edf0f4;
        border-radius: 12px;
        padding: 14px;
        white-space: pre-line;
    }

    .action-button {
        border-radius: 10px;
        font-weight: 700;
        min-width: 104px;
    }

    .portfolio-strip {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 12px;
    }

    .portfolio-item {
        border-radius: 12px;
        padding: 10px;
        box-shadow: 0 12px 28px rgba(15, 23, 42, 0.08);
    }

    .portfolio-thumb {
        width: 100%;
        aspect-ratio: 16 / 9;
        object-fit: cover;
        border-radius: 9px;
        background: #eef2ff;
    }

    .empty-state {
        min-height: 340px;
        display: grid;
        place-items: center;
        text-align: center;
    }

    .empty-visual {
        width: 96px;
        height: 96px;
        border-radius: 28px;
        margin: 0 auto 18px;
        background: linear-gradient(135deg, rgba(79, 70, 229, 0.14), rgba(249, 115, 22, 0.18));
        display: grid;
        place-items: center;
        color: #4f46e5;
        font-weight: 900;
        font-size: 2rem;
    }

    @media (max-width: 991.98px) {
        .metric-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .glass-panel::after {
            opacity: 0.35;
        }
    }

    @media (max-width: 575.98px) {
        .metric-grid {
            grid-template-columns: 1fr;
        }

        .candidate-panel {
            padding: 15px;
        }

        .action-button {
            flex: 1 1 100%;
        }
    }
</style>
@endpush

@section('content')
@php
    $totalApplications = $applications->count();
    $acceptedApplications = $applications->where('status', 'accepted')->count();
    $pendingApplications = $applications->where('status', 'pending')->count();
    $rejectedApplications = $applications->where('status', 'rejected')->count();
    $statusClasses = ['accepted' => 'success', 'rejected' => 'danger', 'pending' => 'pending'];
    $statusLabels = ['accepted' => 'Acceptee', 'rejected' => 'Rejetee', 'pending' => 'En attente'];
@endphp

<div class="applications-page">
    <div class="applications-board">
        <section class="glass-panel mb-4">
            <div class="hero-content">
                <span class="soft-label mb-3">Pipeline de recrutement</span>
                <h1 class="display-font hero-title mb-3">{{ $jobPost->title }}</h1>
                <p class="hero-copy mb-4">
                    Suivez les candidatures, consultez les CV, comparez les portfolios et mettez a jour le statut de chaque profil depuis un tableau clair et rapide.
                </p>
                <div class="d-flex gap-2 flex-wrap">
                    <a href="{{ route('company.jobs.index') }}" class="btn btn-light action-button">Retour offres</a>
                    <a href="{{ route('company.jobs.edit', $jobPost) }}" class="btn btn-company action-button">Modifier l'offre</a>
                </div>
            </div>
        </section>

        <section class="metric-grid mb-4">
            <div class="metric-card">
                <div class="metric-icon mb-3">T</div>
                <p class="small fw-semibold mb-1 text-uppercase">Total</p>
                <h2 class="display-font mb-0">{{ $totalApplications }}</h2>
            </div>
            <div class="metric-card">
                <div class="metric-icon mb-3">P</div>
                <p class="small fw-semibold mb-1 text-uppercase">En attente</p>
                <h2 class="display-font mb-0">{{ $pendingApplications }}</h2>
            </div>
            <div class="metric-card">
                <div class="metric-icon orange mb-3">A</div>
                <p class="small fw-semibold mb-1 text-uppercase">Acceptees</p>
                <h2 class="display-font mb-0">{{ $acceptedApplications }}</h2>
            </div>
            <div class="metric-card">
                <div class="metric-icon orange mb-3">R</div>
                <p class="small fw-semibold mb-1 text-uppercase">Rejetees</p>
                <h2 class="display-font mb-0">{{ $rejectedApplications }}</h2>
            </div>
        </section>

        <div class="row g-4">
            @forelse ($applications as $application)
                @php
                    $candidate = $application->freelancer;
                    $status = $application->status ?? 'pending';
                    $projects = $candidate?->projects ?? collect();
                @endphp

                <div class="col-12">
                    <article class="candidate-panel">
                        <div class="d-flex justify-content-between align-items-start gap-3 flex-wrap">
                            <div class="d-flex gap-3 align-items-start">
                                @if ($candidate?->profile_photo_path)
                                    <img src="{{ asset('storage/' . $candidate->profile_photo_path) }}" alt="{{ $candidate->full_name }}" class="candidate-avatar">
                                @else
                                    <div class="image-placeholder" style="width:54px;height:54px;min-height:54px;border-radius:18px;">
                                        <svg viewBox="0 0 24 24" aria-hidden="true">
                                            <path d="M20 21a8 8 0 0 0-16 0" />
                                            <circle cx="12" cy="8" r="4" />
                                        </svg>
                                    </div>
                                @endif

                                <div>
                                    <h2 class="h5 candidate-name mb-1">{{ $candidate?->full_name ?? 'Candidat supprime' }}</h2>
                                    <p class="candidate-meta small mb-2">{{ $candidate?->email ?? 'Email indisponible' }}</p>
                                    <span class="status-pill {{ $statusClasses[$status] ?? 'pending' }}">
                                        {{ $statusLabels[$status] ?? ucfirst($status) }}
                                    </span>
                                </div>
                            </div>

                            <div class="d-flex gap-2 flex-wrap justify-content-end">
                                @if ($candidate?->cv_path)
                                    <a href="{{ asset('storage/' . $candidate->cv_path) }}" target="_blank" class="btn btn-outline-secondary btn-sm action-button">Voir CV</a>
                                @endif
                                <form method="POST" action="{{ route('company.applications.status', $application) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="accepted">
                                    <button class="btn btn-outline-success btn-sm action-button">Accepter</button>
                                </form>
                                <form method="POST" action="{{ route('company.applications.status', $application) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="rejected">
                                    <button class="btn btn-outline-danger btn-sm action-button">Rejeter</button>
                                </form>
                            </div>
                        </div>

                        @if ($application->cover_letter)
                            <div class="cover-letter small mt-3">{{ $application->cover_letter }}</div>
                        @endif

                        @if ($projects->count() > 0)
                            <div class="mt-4">
                                <div class="d-flex align-items-center justify-content-between gap-2 mb-2">
                                    <h3 class="h6 panel-title mb-0">Portfolio</h3>
                                    <span class="small muted-text">{{ $projects->count() }} projet(s)</span>
                                </div>
                                <div class="portfolio-strip">
                                    @foreach ($projects as $project)
                                        <div class="portfolio-item">
                                            @if ($project->screenshot_path)
                                                <img src="{{ asset('storage/' . $project->screenshot_path) }}" alt="{{ $project->title }}" class="portfolio-thumb mb-2">
                                            @else
                                                <div class="image-placeholder portfolio-thumb mb-2">
                                                    <svg viewBox="0 0 24 24" aria-hidden="true">
                                                        <rect x="3" y="5" width="18" height="14" rx="2" />
                                                        <path d="M8 13l2.5-2.5L14 14l2-2 3 3" />
                                                        <circle cx="8" cy="9" r="1" />
                                                    </svg>
                                                    <span>Apercu</span>
                                                </div>
                                            @endif
                                            <p class="small fw-semibold mb-1 text-dark">{{ $project->title }}</p>
                                            @if ($project->repo_url)
                                                <a href="{{ $project->repo_url }}" target="_blank" class="small fw-semibold">Voir le depot</a>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </article>
                </div>
            @empty
                <div class="col-12">
                    <div class="glass-panel empty-state">
                        <div>
                            <div class="empty-visual">0</div>
                            <h2 class="h4 display-font mb-2">Aucune candidature</h2>
                            <p class="muted-text mb-0">Cette offre n'a pas encore recu de candidature.</p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
