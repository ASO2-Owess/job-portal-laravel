@extends('layouts.app')

@section('title', 'Mon profil')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card-surface p-4 p-md-5">
            <h1 class="h4 display-font mb-4">Mon profil</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="d-flex align-items-center gap-3 mb-4">
                @if ($candidate->profile_photo_path)
                    <img src="{{ asset('storage/' . $candidate->profile_photo_path) }}" class="rounded-circle" width="72" height="72" style="object-fit:cover;">
                @else
                    <div class="image-placeholder" style="width:72px;height:72px;min-height:72px;border-radius:22px;">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M20 21a8 8 0 0 0-16 0" />
                            <circle cx="12" cy="8" r="4" />
                        </svg>
                    </div>
                @endif
                <div>
                    <p class="mb-0 fw-semibold">{{ $candidate->full_name }}</p>
                    <span class="text-secondary-custom small d-block">Photo modifiable ci-dessous</span>
                    @if ($candidate->cv_path)
                        <a href="{{ asset('storage/' . $candidate->cv_path) }}" target="_blank" class="small">Voir mon CV actuel</a>
                    @else
                        <span class="text-secondary-custom small">Aucun CV téléversé</span>
                    @endif
                </div>
            </div>

            <form method="POST" action="{{ route('candidate.profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nom complet</label>
                    <input type="text" name="full_name" class="form-control" value="{{ old('full_name', $candidate->full_name) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $candidate->email) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Téléphone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $candidate->phone) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Photo de profil</label>
                    <input type="file" name="profile_photo" class="form-control" accept="image/*">
                </div>

                <div class="mb-3">
                    <label class="form-label">CV (PDF, Word)</label>
                    <input type="file" name="cv" class="form-control" accept=".pdf,.doc,.docx">
                </div>

                <hr class="my-4" style="border-color: var(--border-subtle);">

                <div class="mb-3">
                    <label class="form-label">Nouveau mot de passe (laisser vide pour ne pas changer)</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="mb-4">
                    <label class="form-label">Confirmer le nouveau mot de passe</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>

                <button type="submit" class="btn btn-candidate w-100">Enregistrer</button>
            </form>
        </div>
    </div>
</div>
@endsection
