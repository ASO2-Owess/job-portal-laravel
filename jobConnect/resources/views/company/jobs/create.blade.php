@extends('layouts.app')

@section('title', 'Publier une offre')

@section('content')
<section class="page-hero mb-4">
    <span class="soft-label mb-3">Nouvelle mission</span>
    <div class="row align-items-end g-3">
        <div class="col-lg-8">
            <h1 class="display-font display-6 mb-2">Publier une offre</h1>
            <p class="text-secondary-custom mb-0">Creez une annonce claire pour attirer rapidement les bons candidats.</p>
        </div>
        <div class="col-lg-4 text-lg-end">
            <a href="{{ route('company.jobs.index') }}" class="btn btn-outline-light">Retour aux offres</a>
        </div>
    </div>
</section>

<div class="row justify-content-center">
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

            <form method="POST" action="{{ route('company.jobs.store') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Titre du poste</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="Ex: Developpeur Laravel freelance" required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Description</label>
                    <textarea name="description" class="form-control" rows="8" placeholder="Detaillez le contexte, les responsabilites, les competences et les livrables attendus." required>{{ old('description') }}</textarea>
                </div>

                <button type="submit" class="btn btn-company w-100 py-2">Publier l'offre</button>
            </form>
        </div>
    </div>
</div>
@endsection
