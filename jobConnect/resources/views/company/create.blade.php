@extends('layouts.app')

@section('title', 'Publier une offre')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card-surface p-4 p-md-5">
            <h1 class="h4 display-font mb-4">Publier une offre</h1>

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
                    <label class="form-label">Titre du poste</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="6" required>{{ old('description') }}</textarea>
                </div>

                <button type="submit" class="btn btn-company w-100">Publier</button>
            </form>
        </div>
    </div>
</div>
@endsection
