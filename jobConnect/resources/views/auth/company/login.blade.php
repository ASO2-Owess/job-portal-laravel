@extends('layouts.app')

@section('title', 'Connexion Entreprise')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card-surface p-4 p-md-5">
            <h1 class="h4 display-font mb-1">Connexion Entreprise</h1>
            <p class="text-secondary-custom small mb-4">Accédez à votre espace de recrutement.</p>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('company.login') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Mot de passe</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="form-check mb-4">
                    <input type="checkbox" name="remember" class="form-check-input" id="remember">
                    <label class="form-check-label text-secondary-custom" for="remember">Se souvenir de moi</label>
                </div>

                <button type="submit" class="btn btn-company w-100">Connexion</button>
            </form>

            <p class="text-secondary-custom small mt-3 mb-0">
                Pas encore de compte ? <a href="{{ route('company.register') }}" class="text-white">Inscription</a>
            </p>
        </div>
    </div>
</div>
@endsection
