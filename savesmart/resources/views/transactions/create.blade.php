@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-2xl font-bold mb-4">Nouvelle Transaction</h2>

    <form action="{{ route('transactions.store') }}" method="POST">
        @csrf
        <label class="block mb-2">Type :</label>
        <select name="type" class="w-full p-2 border rounded-md mb-4">
            <option value="Revenu">Revenu</option>
            <option value="Dépense">Dépense</option>
        </select>

        <label class="block mb-2">Montant :</label>
        <input type="number" name="amount" class="w-full p-2 border rounded-md mb-4">

        <label class="block mb-2">Catégorie :</label>
        <select name="category_id" class="w-full p-2 border rounded-md mb-4">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Ajouter</button>
    </form>
</div>
@endsection
