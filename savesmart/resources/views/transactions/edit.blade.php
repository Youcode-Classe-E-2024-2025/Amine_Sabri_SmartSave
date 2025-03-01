@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-gray-700">Modifier la Transaction</h2>

    <!-- Formulaire de modification -->
    <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Type de transaction -->
        <div class="mb-4">
            <label for="type" class="block text-gray-700 font-semibold mb-2">Type de Transaction</label>
            <select id="type" name="type" class="w-full p-2 border border-gray-300 rounded">
                <option value="Revenu" {{ $transaction->type == 'Revenu' ? 'selected' : '' }}>Revenu</option>
                <option value="Dépense" {{ $transaction->type == 'Dépense' ? 'selected' : '' }}>Dépense</option>
            </select>
            @error('type')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Montant -->
        <div class="mb-4">
            <label for="amount" class="block text-gray-700 font-semibold mb-2">Montant (MAD)</label>
            <input type="number" id="amount" name="amount" step="0.01" value="{{ $transaction->amount }}" 
                   class="w-full p-2 border border-gray-300 rounded">
            @error('amount')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Catégorie -->
        <div class="mb-4">
            <label for="category_id" class="block text-gray-700 font-semibold mb-2">Catégorie</label>
            <select id="category_id" name="category_id" class="w-full p-2 border border-gray-300 rounded">
                <option value="">Non catégorisé</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $transaction->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Boutons d'action -->
        <div class="flex justify-end space-x-4">
            <a href="{{ route('home', session('current_profile')) }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                Annuler
            </a>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                Mettre à jour
            </button>
        </div>
    </form>
</div>
@endsection
