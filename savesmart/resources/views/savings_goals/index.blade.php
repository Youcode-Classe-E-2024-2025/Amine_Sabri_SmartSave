@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Liste des Objectifs d'Épargne</h2>
    <a href="{{ route('savings_goals.create') }}" class="btn btn-primary mb-3">Ajouter un Objectif</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Montant Objectif</th>
                <th>Montant Épargné</th>
                <th>Échéance</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($goals as $goal)
            <tr>
                <td>{{ $goal->name }}</td>
                <td>{{ $goal->target_amount }} €</td>
                <td>{{ $goal->saved_amount }} €</td>
                <td>{{ $goal->deadline ?? 'Pas de date' }}</td>
                <td>
                    <a href="{{ route('savings_goals.show', $goal->id) }}" class="btn btn-info">Voir</a>
                    <a href="{{ route('savings_goals.edit', $goal->id) }}" class="btn btn-warning">Modifier</a>
                    <form action="{{ route('savings_goals.destroy', $goal->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
