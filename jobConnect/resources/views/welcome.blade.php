@extends('layouts.app')

@section('title', 'JobConnect')

@section('content')
<section class="page-hero">
    <span class="soft-label mb-3">Plateforme emploi</span>
    <h1 class="display-font display-4 fw-bold mb-3">JobConnect</h1>
    <p class="lead text-secondary-custom mb-4">Publiez des offres, suivez les candidatures et trouvez le bon profil dans une interface claire.</p>
    <div class="d-flex gap-2 flex-wrap">
        <a href="{{ route('jobs.index') }}" class="btn btn-company btn-lg">Voir les offres</a>
        <a href="{{ route('company.register') }}" class="btn btn-outline-light btn-lg">Je recrute</a>
    </div>
</section>
@endsection
