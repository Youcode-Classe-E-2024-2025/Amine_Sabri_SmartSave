@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto mt-10 bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Déverrouiller le profil <strong>{{ $profile->name }}</strong></h2>

        @if(session('error'))
            <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('profiles.unlock.post', $profile->id) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-600 text-sm font-medium mb-1">Mot de passe du profil :</label>
                <input type="password" name="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                Déverrouiller
            </button>
        </form>
    </div>
@endsection
