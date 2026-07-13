@extends('layouts.app')

@section('title', 'Mon profil entreprise')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card-surface p-4 p-md-5">
            <h1 class="h4 display-font mb-4">Mon profil entreprise</h1>

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
                @if ($company->logo_path)
                    <img src="{{ asset('storage/' . $company->logo_path) }}" class="rounded-circle" width="72" height="72" style="object-fit:cover;">
                @else
                    <div class="image-placeholder" style="width:72px;height:72px;min-height:72px;border-radius:22px;">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M4 21V7l8-4 8 4v14" />
                            <path d="M9 21v-7h6v7" />
                            <path d="M8 9h.01M12 9h.01M16 9h.01" />
                        </svg>
                    </div>
                @endif
                <div>
                    <p class="mb-0 fw-semibold">{{ $company->company_name }}</p>
                    <span class="text-secondary-custom small d-block">Logo modifiable ci-dessous</span>
                    <a href="{{ route('companies.show', $company) }}" class="small">Voir mon profil public</a>
                </div>
            </div>

            <form method="POST" action="{{ route('company.profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nom de l'entreprise</label>
                    <input type="text" name="company_name" class="form-control" value="{{ old('company_name', $company->company_name) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $company->email) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Téléphone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $company->phone) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="4">{{ old('description', $company->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Logo</label>
                    <input type="file" name="logo" class="form-control" accept="image/*">
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

                <button type="submit" class="btn btn-company w-100">Enregistrer</button>
            </form>
        </div>
    </div>
</div>
@endsection
