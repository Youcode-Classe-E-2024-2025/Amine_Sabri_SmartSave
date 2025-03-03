@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Modifier le profil</h2>

    <form action="{{ route('profiles.update', $profile->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" class="form-control" name="name" value="{{ old('name', $profile->name) }}" required>
        </div>

        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" class="form-control" name="password">
            <small>Si vous ne voulez pas modifier le mot de passe, laissez ce champ vide.</small>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
