@extends('layouts.app')

@section('content')
    <h2>Ajouter une transaction</h2>
    
    <form action="{{ route('transactions.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="type">Type de transaction</label>
            <select name="type" id="type" class="form-control">
                <option value="Revenu">Revenu</option>
                <option value="Dépense">Dépense</option>
            </select>
        </div>

        <div class="form-group">
            <label for="amount">Montant</label>
            <input type="number" name="amount" id="amount" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="category_id">Catégorie</label>
            <select name="category_id" id="category_id" class="form-control">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Ajouter la transaction</button>
    </form>
@endsection
