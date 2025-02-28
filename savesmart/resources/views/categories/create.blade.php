@extends('layouts.app')

@section('content')
    <h2>Ajouter une nouvelle catégorie</h2>
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name">Nom de la catégorie</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Ajouter</button>
    </form>
@endsection
