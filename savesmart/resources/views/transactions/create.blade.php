@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-semibold mb-4">Ajouter une transaction</h2>

    <form action="{{ route('transactions.store') }}" method="POST" class="space-y-4">
        @csrf
        <input type="hidden" name="profile_id" value="{{ $profile->id }}">

        <div class="grid items-center grid-cols-6 gap-4">
            <div class="flex flex-col">
                <label for="type" class="mb-2">Type:</label>
                <select name="type" id="type" class="px-3 py-2 border rounded" required>
                    <option value="Revenu">Revenu</option>
                    <option value="Dépense">Dépense</option>
                </select>
            </div>

            <div class="flex flex-col">
                <label for="amount" class="mb-2">Montant:</label>
                <input type="number" name="amount" id="amount" class="px-3 py-2 border rounded" step="0.01" required>
            </div>

            <div class="flex flex-col">
                <label for="category" class="mb-2">Catégorie:</label>
                <input type="text" name="category" id="category" class="px-3 py-2 border rounded" required>
            </div>

            <div class="flex flex-col">
                <label for="description" class="mb-2">Description:</label>
                <textarea name="description" id="description" class="px-3 h-10  border rounded"></textarea>
            </div>

            <div class="flex flex-col">
                <label for="date" class="mb-2">Date:</label>
                <input type="date" name="date" id="date" class="px-3 py-2 border rounded" required>
            </div>
            <div>

                <button type="submit" class="mt-4 px-16 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Ajouter</button>
            </div>
        </div>

    </form>
@endsection
