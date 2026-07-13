@extends('layouts.app')

@section('title', 'Mes offres')

@section('content')
<section class="page-hero mb-4">
    <span class="soft-label mb-3">Espace entreprise</span>
    <div class="row align-items-end g-3">
        <div class="col-lg-8">
            <h1 class="display-font display-6 mb-2">Mes offres</h1>
            <p class="text-secondary-custom mb-0">Pilotez vos annonces, consultez les candidatures et gardez le statut de chaque mission visible.</p>
        </div>
        <div class="col-lg-4 text-lg-end">
            <a href="{{ route('company.jobs.create') }}" class="btn btn-company">Publier une offre</a>
        </div>
    </div>
</section>

<div class="row g-3">
    @forelse ($jobPosts as $job)
        <div class="col-12">
            <article class="card-surface p-3 p-md-4">
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
                    <div class="d-flex gap-3 align-items-start">
                        <div class="avatar-mark">J</div>
                        <div>
                            <h2 class="h5 display-font mb-2">{{ $job->title }}</h2>
                            <span class="status-pill {{ $job->status === 'completed' ? 'success' : ($job->status === 'cancelled' ? 'danger' : 'pending') }}">
                                {{ $job->status }}
                            </span>
                        </div>
                    </div>

                    <div class="d-flex gap-2 flex-wrap justify-content-end">
                        <a href="{{ route('company.jobs.applications', $job) }}" class="btn btn-outline-light btn-sm">Candidatures</a>
                        <a href="{{ route('company.jobs.edit', $job) }}" class="btn btn-outline-light btn-sm">Editer</a>
                        <form method="POST" action="{{ route('company.jobs.destroy', $job) }}" onsubmit="return confirm('Supprimer cette offre ?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm">Supprimer</button>
                        </form>
                    </div>
                </div>
            </article>
        </div>
    @empty
        <div class="col-12">
            <div class="card-surface p-5 text-center">
                <div class="avatar-mark mx-auto mb-3">0</div>
                <h2 class="h4 display-font mb-2">Aucune offre publiee</h2>
                <p class="text-secondary-custom mb-3">Commencez par creer votre premiere annonce.</p>
                <a href="{{ route('company.jobs.create') }}" class="btn btn-company">Publier une offre</a>
            </div>
        </div>
    @endforelse
</div>

<div class="mt-4">
    {{ $jobPosts->links() }}
</div>
@endsection
