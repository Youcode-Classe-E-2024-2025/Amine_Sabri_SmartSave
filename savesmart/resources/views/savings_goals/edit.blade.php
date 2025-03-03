@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Modifier l'Objectif</h2>

    <form action="{{ route('savings_goals.update', $savingsGoal->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Nom:</label>
            <input type="text" name="name" class="form-control" value="{{ $savingsGoal->name }}" required>
        </div>
        <div class="mb-3">
            <label>Montant Objectif:</label>
            <input type="number" name="target_amount" class="form-control" value="{{ $savingsGoal->target_amount }}" required>
        </div>
        <div class="mb-3">
            <label>Échéance:</label>
            <input type="date" name="deadline" class="form-control" value="{{ $savingsGoal->deadline }}">
        </div>
        <button type="submit" class="btn btn-warning">Modifier</button>
    </form>
</div>
@endsection
