@extends('layouts.app')

@section('title', 'Mes candidatures')

@section('content')

<h1 class="h4 display-font mb-4">Mes candidatures</h1>

<div class="row g-3">
    @forelse ($applications as $application)
        <div class="col-12">
            <div class="card-surface p-3 d-flex flex-row justify-content-between align-items-center flex-wrap gap-2">
                <div>
                    <p class="mb-1 fw-semibold">{{ $application->jobPost->title }}</p>
                    <p class="text-secondary-custom small mb-1">{{ $application->jobPost->client->company_name }}</p>
                    <span class="status-pill {{ $application->status === 'accepted' ? 'success' : ($application->status === 'rejected' ? 'danger' : 'pending') }}">
                        {{ $application->status }}
                    </span>
                </div>
            </div>
        </div>
    @empty
        <p class="text-secondary-custom">Vous n'avez pas encore postulé à une offre.</p>
    @endforelse
</div>

<div class="mt-4">
    {{ $applications->links() }}
</div>

@endsection
