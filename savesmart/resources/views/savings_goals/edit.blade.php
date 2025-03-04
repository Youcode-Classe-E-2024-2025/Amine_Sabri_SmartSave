@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-100 to-indigo-100 py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-indigo-600">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        Tableau de bord
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('savings_goals.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-indigo-600 md:ml-2">Objectifs d'épargne</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Modifier l'objectif</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Form Card -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="px-4 py-3 sm:px-6 bg-gradient-to-r from-indigo-600 to-purple-600">
                <h2 class="text-2xl font-bold leading-7 text-white sm:text-3xl sm:truncate">
                    Modifier l'Objectif
                </h2>
            </div>
            <div class="px-4 py-3 sm:p-6">
                <form action="{{ route('savings_goals.update', $savingsGoal->id) }}" method="POST" class="space-y-6">
                    @csrf 
                    @method('PUT')
                    
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">
                            Nom de l'objectif
                        </label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 2a1 1 0 00-1 1v1.323l-3.954 1.582A1 1 0 004 6.32V16a1 1 0 001.029.976l5-1V17a1 1 0 102 0v-1.024l5 1A1 1 0 0018 16V6.32a1.001 1.001 0 00-.046-.315L14 4.323V3a1 1 0 10-2 0v1.323L10 3.323V3a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" name="name" id="name" class="focus:ring-indigo-500 border-2 border-black-500 py-2 focus:border-indigo-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md" value="{{ $savingsGoal->name }}" required>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label for="target_amount" class="block text-sm font-medium text-gray-700">
                                Montant objectif
                            </label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">MAD</span>
                                </div>
                                <input type="number" name="target_amount" id="target_amount" class="focus:ring-indigo-500 border-2 border-black-500 py-2 focus:border-indigo-500 block w-full pl-12 pr-12 sm:text-sm border-gray-300 rounded-md" value="{{ $savingsGoal->target_amount }}" step="0.01" required>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">DH</span>
                                </div>
                            </div>
                        </div>
    
                        <div>
                            <label for="saved_amount" class="block text-sm font-medium text-gray-700">
                                Montant déjà épargné
                            </label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">MAD</span>
                                </div>
                                <input type="number" name="saved_amount" id="saved_amount" class="focus:ring-indigo-500 border-2 border-black-500 py-2 focus:border-indigo-500 block w-full pl-12 pr-12 sm:text-sm border-gray-300 rounded-md" value="{{ $savingsGoal->saved_amount }}" step="0.01" required>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">DH</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="deadline" class="block text-sm font-medium text-gray-700">
                            Date d'échéance
                        </label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="date" name="deadline" id="deadline" class="focus:ring-indigo-500 border-2 border-black-500 py-2 focus:border-indigo-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md" value="{{ $savingsGoal->deadline ? $savingsGoal->deadline : '' }}">
                        </div>
                    </div>

                    <!-- Progress Visualization -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="text-sm font-medium text-gray-700 mb-2">Progression actuelle</h4>
                        <div class="relative pt-1">
                            @php
                                $progress = ($savingsGoal->target_amount > 0) ? ($savingsGoal->saved_amount / $savingsGoal->target_amount) * 100 : 0;
                            @endphp
                            <div class="flex mb-2 items-center justify-between">
                                <div>
                                    <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-indigo-600 bg-indigo-200">
                                        {{ number_format($savingsGoal->saved_amount, 2) }} MAD
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
                            <div class="text-right">
                                <span class="text-xs font-semibold inline-block text-gray-500">
                                    Objectif: {{ number_format($savingsGoal->target_amount, 2) }} MAD
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex items-center justify-end space-x-3">
                        <a href="{{ route('savings_goals.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Annuler
                        </a>
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gradient-to-r from-yellow-500 to-amber-600 hover:from-yellow-600 hover:to-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Enregistrer les modifications
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom styles for form inputs */
    .form-input:focus, .form-select:focus, .form-textarea:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
    }
</style>
@endsection

