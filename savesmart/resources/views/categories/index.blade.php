@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-semibold mb-4">Liste des Catégories</h2>
    <a href="{{ route('categories.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-4 inline-block">Ajouter une catégorie</a>
    
    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <ul class="list-disc pl-5 space-y-3">
        @foreach($categories as $category)
            <li class="flex items-center justify-between">
                <span class="text-lg">{{ $category->name }}</span>
                <div class="space-x-2">
                    <a href="{{ route('categories.edit', $category->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Modifier</a>
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Supprimer</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
@endsection
