@extends('layouts.app')

@section('content')
    <h2>Créer un Profil</h2>
    <form method="POST" action="{{ route('profiles.store') }}">
        @csrf
        <input type="text" name="name" placeholder="Nom du profil" required>
        <input type="password" name="password" placeholder="Mot de passe du profil" required>
        <button type="submit">Créer</button>
    </form>
@endsection
