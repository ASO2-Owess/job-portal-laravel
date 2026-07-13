@extends('layouts.app')

@section('title', 'Inscription Candidat')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card-surface p-4 p-md-5">
            <h1 class="h4 display-font mb-1">Créer un compte candidat</h1>
            <p class="text-secondary-custom small mb-4">Trouvez l'offre qui vous correspond.</p>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('candidate.register') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nom complet</label>
                    <input type="text" name="full_name" class="form-control" value="{{ old('full_name') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Téléphone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Mot de passe</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Confirmer le mot de passe</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-candidate w-100">Créer mon compte</button>
            </form>

            <p class="text-secondary-custom small mt-3 mb-0">
                Déjà un compte ? <a href="{{ route('candidate.login') }}" class="text-white">Connexion</a>
            </p>
        </div>
    </div>
</div>
@endsection
