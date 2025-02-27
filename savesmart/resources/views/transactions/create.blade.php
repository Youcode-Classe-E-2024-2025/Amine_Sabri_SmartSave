@extends('layouts.app')

@section('content')
    <h2>Ajouter une transaction</h2>

    <form action="{{ route('transactions.store') }}" method="POST">
        @csrf
        <input type="hidden" name="profile_id" value="{{ $profile->id }}">

        <label>Type:</label>
        <select name="type" required>
            <option value="income">Revenu</option>
            <option value="expense">Dépense</option>
        </select>

        <label>Montant:</label>
        <input type="number" name="amount" step="0.01" required>

        <label>Catégorie:</label>
        <input type="text" name="category" required>

        <label>Description:</label>
        <textarea name="description"></textarea>

        <label>Date:</label>
        <input type="date" name="date" required>

        <button type="submit">Ajouter</button>
    </form>
@endsection
