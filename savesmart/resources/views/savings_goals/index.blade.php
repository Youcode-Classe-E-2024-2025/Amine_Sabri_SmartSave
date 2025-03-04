@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="md:flex md:items-center md:justify-between mb-8">
            <div class="flex-1 min-w-0">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                    Liste des Objectifs d'Épargne
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Suivez et gérez vos objectifs financiers
                </p>
            </div>
            <div class="mt-4 flex space-x-3 md:mt-0">
                <a href="{{ route('exportGoals.all') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    Exporter CSV
                </a>
                <a href="{{ route('savings_goals.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Ajouter un Objectif
                </a>
            </div>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="rounded-md bg-green-50 p-4 mb-6 border border-green-200">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">
                            {{ session('success') }}
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Stats Summary -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm p-6 flex items-center">
                <div class="rounded-full bg-blue-100 p-3 mr-4">
                    <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total des objectifs</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $goals->count() }}</p>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-6 flex items-center">
                <div class="rounded-full bg-green-100 p-3 mr-4">
                    <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total épargné</p>
                    <p class="text-2xl font-bold text-gray-800">{{ number_format($goals->sum('saved_amount'), 2) }} MAD</p>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-6 flex items-center">
                <div class="rounded-full bg-indigo-100 p-3 mr-4">
                    <svg class="h-6 w-6 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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

        <!-- Filter and Search -->
        <div class="bg-white p-4 rounded-lg shadow-sm mb-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="text" id="search" placeholder="Rechercher un objectif..." class="pl-10 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="flex space-x-2">
                    <select id="sort-by" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        <option value="name">Trier par nom</option>
                        <option value="target">Trier par montant</option>
                        <option value="progress">Trier par progression</option>
                        <option value="deadline">Trier par échéance</option>
                    </select>
                    <select id="filter-by" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        <option value="all">Tous les objectifs</option>
                        <option value="completed">Objectifs complétés</option>
                        <option value="in-progress">Objectifs en cours</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Goals Table -->
        <div class="bg-white shadow-sm overflow-hidden sm:rounded-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nom
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Montant Objectif
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Montant Épargné
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Échéance
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Progrès
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($goals as $goal)
                            @php
                                $percentage = $goal->target_amount > 0 ? ($goal->saved_amount / $goal->target_amount) * 100 : 0;
                                $progressColor = $percentage >= 100 ? 'bg-green-500' : 'bg-indigo-600';
                                $deadlineFormatted = $goal->deadline ? \Carbon\Carbon::parse($goal->deadline)->format('d/m/Y') : 'Pas de date';
                            @endphp
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $goal->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ number_format($goal->target_amount, 2) }} MAD</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ number_format($goal->saved_amount, 2) }} MAD</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $deadlineFormatted }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="{{ $progressColor }} h-2.5 rounded-full" style="width: {{ min(100, $percentage) }}%"></div>
                                        </div>
                                        <span class="ml-2 text-sm font-medium text-gray-700">{{ number_format($percentage, 1) }}%</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                        <a href="{{ route('savings_goals.show', $goal->id) }}" class="text-indigo-600 hover:text-indigo-900">
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('savings_goals.edit', $goal->id) }}" class="text-yellow-600 hover:text-yellow-900">
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('savings_goals.destroy', $goal->id) }}" method="POST" class="inline-block">
                                            @csrf 
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Confirmer la suppression ?')">
                                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Empty State -->
            @if($goals->isEmpty())
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="mt-2 text-lg font-medium text-gray-900">Aucun objectif d'épargne</h3>
                <p class="mt-1 text-sm text-gray-500">Commencez par créer votre premier objectif d'épargne.</p>
                <div class="mt-6">
                    <a href="{{ route('savings_goals.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Créer un objectif
                    </a>
                </div>
            </div>
            @endif
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $goals->links() }}
        </div>
    </div>
</div>

<script>
    // Simple JavaScript for search and filter functionality
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search');
        const sortSelect = document.getElementById('sort-by');
        const filterSelect = document.getElementById('filter-by');
        const tableRows = document.querySelectorAll('tbody tr');
        
        // Search functionality
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            
            tableRows.forEach(row => {
                const name = row.querySelector('td:first-child').textContent.toLowerCase();
                if (name.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
        
        // Filter functionality
        filterSelect.addEventListener('change', function() {
            const filterValue = this.value;
            
            tableRows.forEach(row => {
                const progressText = row.querySelector('td:nth-child(5) span').textContent;
                const progress = parseFloat(progressText);
                
                if (filterValue === 'all') {
                    row.style.display = '';
                } else if (filterValue === 'completed' && progress >= 100) {
                    row.style.display = '';
                } else if (filterValue === 'in-progress' && progress < 100) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
        
        // Basic sort functionality (can be enhanced)
        sortSelect.addEventListener('change', function() {
            const sortValue = this.value;
            const tbody = document.querySelector('tbody');
            const rows = Array.from(tableRows);
            
            rows.sort((a, b) => {
                if (sortValue === 'name') {
                    const nameA = a.querySelector('td:first-child').textContent.toLowerCase();
                    const nameB = b.querySelector('td:first-child').textContent.toLowerCase();
                    return nameA.localeCompare(nameB);
                } else if (sortValue === 'target') {
                    const targetA = parseFloat(a.querySelector('td:nth-child(2)').textContent.replace(/[^\d.-]/g, ''));
                    const targetB = parseFloat(b.querySelector('td:nth-child(2)').textContent.replace(/[^\d.-]/g, ''));
                    return targetB - targetA;
                } else if (sortValue === 'progress') {
                    const progressA = parseFloat(a.querySelector('td:nth-child(5) span').textContent);
                    const progressB = parseFloat(b.querySelector('td:nth-child(5) span').textContent);
                    return progressB - progressA;
                }
                return 0;
            });
            
            // Re-append sorted rows
            rows.forEach(row => tbody.appendChild(row));
        });
    });
</script>
@endsection

