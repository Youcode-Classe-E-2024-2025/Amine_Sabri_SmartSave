@extends('layouts.app')

@section('content')
    <h2>Vos Profils</h2>
    <a href="{{ route('profiles.create') }}">Créer un nouveau profil</a>
    <ul>
        @foreach ($profiles as $profile)
            <li>
                <a href="{{ route('profiles.unlock', $profile->id) }}">{{ $profile->name }}</a>
            </li>
        @endforeach
    </ul>
@endsection
