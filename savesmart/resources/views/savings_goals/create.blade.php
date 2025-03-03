@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Créer un Objectif d'Épargne</h2>

    <form action="{{ route('savings_goals.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nom:</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Montant Objectif:</label>
            <input type="number" name="target_amount" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Échéance:</label>
            <input type="date" name="deadline" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Ajouter</button>
    </form>
</div>
@endsection
