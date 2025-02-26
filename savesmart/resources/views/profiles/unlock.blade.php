@extends('layouts.app')

@section('content')
    <h2>Déverrouiller le profil {{ $profile->name }}</h2>
    
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('profiles.unlock.post', $profile->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Mot de passe du profil :</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Déverrouiller</button>
    </form>
@endsection
