@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-100 to-indigo-100 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header with Export Button -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-12">
            <h2 class="text-center md:text-left text-4xl font-extrabold text-indigo-900 mb-6 md:mb-0">Vos Objectifs d'Épargne</h2>
            <div class="flex space-x-4">
                @if(session('current_profile'))
                    <a href="{{ route('exportGoals.profile', session('current_profile')) }}" 
                    class="inline-flex items-center px-5 py-3 border border-transparent text-base font-medium rounded-lg shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200 ease-in-out transform hover:-translate-y-1">
                        <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Exporter en CSV
                    </a>
                @endif
                <a href="{{ route('savings_goals.create') }}" 
                   class="inline-flex items-center px-5 py-3 border border-transparent text-base font-medium rounded-lg shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 ease-in-out transform hover:-translate-y-1">
                    <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Nouvel Objectif
                </a>
            </div>
        </div>

        <!-- Stats Summary -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="bg-white rounded-xl shadow-md p-6 flex items-center">
                <div class="rounded-full bg-blue-100 p-3 mr-4">
                    <svg class="h-8 w-8 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total des objectifs</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $goals->count() }}</p>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-md p-6 flex items-center">
                <div class="rounded-full bg-green-100 p-3 mr-4">
                    <svg class="h-8 w-8 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total épargné</p>
                    <p class="text-2xl font-bold text-gray-800">{{ number_format($goals->sum('saved_amount'), 2) }} MAD</p>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-md p-6 flex items-center">
                <div class="rounded-full bg-purple-100 p-3 mr-4">
                    <svg class="h-8 w-8 text-purple-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Progression moyenne</p>
                    <p class="text-2xl font-bold text-gray-800">
                        @php
                            $avgProgress = $goals->count() > 0 ? 
                                $goals->map(function($goal) {
                                    return ($goal->target_amount > 0) ? ($goal->saved_amount / $goal->target_amount) * 100 : 0;
                                })->avg() : 0;
                        @endphp
                        {{ number_format($avgProgress, 1) }}%
                    </p>
                </div>
            </div>
        </div>

        <!-- Goals Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($goals as $goal)
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden transform transition duration-500 hover:scale-105">
                    <!-- Card Header with Status Badge -->
                    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-6 py-4">
                        <div class="flex justify-between items-center">
                            <h3 class="text-xl font-bold text-white truncate">{{ $goal->name }}</h3>
                            @php
                                $progress = ($goal->target_amount > 0) ? ($goal->saved_amount / $goal->target_amount) * 100 : 0;
                                $statusClass = $progress >= 100 ? 'bg-green-500' : 'bg-yellow-500';
                                $statusText = $progress >= 100 ? 'Complété' : 'En cours';
                            @endphp
                            <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-white {{ $statusClass }}">
                                {{ $statusText }}
                            </span>
                        </div>
                    </div>
                    
                    <!-- Card Body -->
                    <div class="p-6">
                        <div class="space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">Montant cible</span>
                                <span class="text-lg font-bold text-indigo-600">{{ number_format($goal->target_amount, 2) }} MAD</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">Économisé</span>
                                <span class="text-lg font-bold text-green-600">{{ number_format($goal->saved_amount, 2) }} MAD</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">Restant</span>
                                <span class="text-lg font-bold text-orange-600">{{ number_format(max(0, $goal->target_amount - $goal->saved_amount), 2) }} MAD</span>
                            </div>
                        </div>
                        
                        <!-- Progress Bar -->
                        <div class="mt-6">
                            <div class="relative pt-1">
                                <div class="flex mb-2 items-center justify-between">
                                    <div>
                                        <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-indigo-600 bg-indigo-200">
                                            Progression
                                        </span>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-xs font-semibold inline-block text-indigo-600">
                                            {{ round($progress, 1) }}%
                                        </span>
                                    </div>
                                </div>
                                <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-indigo-200">
                                    <div style="width: {{ min(100, $progress) }}%" 
                                         class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center {{ $progress >= 100 ? 'bg-green-500' : 'bg-indigo-500' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="mt-6 flex justify-between">
                            <a href="{{ route('savings_goals.edit', $goal->id) }}" 
                               class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                                <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Modifier
                            </a>
                            <form action="{{ route('savings_goals.destroy', $goal->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-150 ease-in-out"
                                        onclick="return confirm('Voulez-vous vraiment supprimer cet objectif ?')">
                                    <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Empty State -->
        @if($goals->isEmpty())
        <div class="text-center py-12">
            <svg class="mx-auto h-16 w-16 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h3 class="mt-2 text-lg font-medium text-gray-900">Aucun objectif d'épargne</h3>
            <p class="mt-1 text-sm text-gray-500">Commencez par créer votre premier objectif d'épargne.</p>
            <div class="mt-6">
                <a href="{{ route('savings_goals.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Créer un objectif
                </a>
            </div>
        </div>
        @endif

        <!-- Pagination -->
        <div class="mt-12">
            {{ $goals->links() }}
        </div>
    </div>
</div>
@endsection

