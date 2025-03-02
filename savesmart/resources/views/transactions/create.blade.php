@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="flex mb-5" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home',session('current_profile')) }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-indigo-600">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        Tableau de bord
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Nouvelle Transaction</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Form Card -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-4 sm:px-6 border-b border-gray-200">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                    Nouvelle Transaction
                </h2>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    Ajoutez une nouvelle transaction à votre comptabilité.
                </p>
            </div>
            <div class="px-4 py-4 sm:p-6">
                <form action="{{ route('transactions.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <label for="type" class="block text-sm font-medium text-gray-700">Type de transaction</label>
                            <select id="type" name="type" class="mt-1 block border-2 border-black-500 w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="Revenu">Revenu</option>
                                <option value="Dépense">Dépense</option>
                            </select>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="amount" class="block text-sm font-medium text-gray-700">Montant</label>
                            <div class="mt-1 relative rounded-md shadow-sm ">
                                <input type="number" name="amount" id="amount" class="mt-1 block border-2 border-black-500 w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md " placeholder="0.00" step="0.01" required>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">
                                        DH
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-span-6">
                            <label for="category_id" class="block text-sm font-medium text-gray-700">Catégorie</label>
                            <select id="category_id" name="category_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-2 border-black-500 border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-span-6">
                            <label for="description" class="block text-sm font-medium text-gray-700">
                                Description (optionnel)
                            </label>
                            <div class="mt-1">
                                <textarea id="description" name="description" rows="3" class="shadow-sm focus:ring-indigo-500 border-2 border-black-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Détails supplémentaires sur la transaction..."></textarea>
                            </div>
                        </div>

                        <div class="col-span-6">
                            <label for="date" class="block text-sm font-medium text-gray-700">
                                Date de la transaction
                            </label>
                            <input type="date" name="date" id="date" class="mt-1 block border-2 border-black-500 w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" value="{{ date('Y-m-d') }}">
                        </div>
                    </div>
                    <div class="mt-6 flex items-center justify-end space-x-3">
                        <a href="{{ route('home',session('current_profile')) }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Annuler
                        </a>
                        <button type="submit" class="bg-indigo-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Ajouter la transaction
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

