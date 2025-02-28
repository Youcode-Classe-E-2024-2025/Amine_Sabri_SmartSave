@extends('layouts.app')

@section('content')
    <h2>Liste des Catégories</h2>
    <a href="{{ route('categories.create') }}" class="btn btn-primary">Ajouter une catégorie</a>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <ul>
        @foreach($categories as $category)
            <li>
                {{ $category->name }}
                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Modifier</a>
                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
