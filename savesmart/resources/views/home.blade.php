@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-3xl font-bold mb-6 text-gray-800">Tableau de Bord - Admin</h2>
        <a href="{{ route('categories.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-4 inline-block">Ajouter une catégorie</a>
        <a href="{{ route('transactions.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md mb-4 inline-block">+ Nouvelle Transaction</a>

        {{-- Statistiques principales --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="p-4 bg-blue-100 text-blue-800 rounded-lg shadow">
                <h3 class="text-lg font-semibold">Total Transactions</h3>
                <p class="text-2xl font-bold">33</p>
            </div>
            <div class="p-4 bg-green-100 text-green-800 rounded-lg shadow">
                <h3 class="text-lg font-semibold">Total Revenus</h3>
                <p class="text-2xl font-bold">33 MAD</p>
            </div>
            <div class="p-4 bg-red-100 text-red-800 rounded-lg shadow">
                <h3 class="text-lg font-semibold">Total Dépenses</h3>
                <p class="text-2xl font-bold">33 MAD</p>
            </div>
            <div class="p-4 bg-purple-100 text-purple-800 rounded-lg shadow">
                <h3 class="text-lg font-semibold">Nombre de Transactions</h3>
                <p class="text-2xl font-bold">33</p>
            </div>
        </div>

        {{-- Graphiques --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="p-4 bg-gray-100 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-2">Répartition Revenus vs Dépenses</h3>
                <canvas id="pieChart"></canvas>
            </div>
            <div class="p-4 bg-gray-100 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-2">Évolution des Transactions (Mensuel)</h3>
                <canvas id="barChart"></canvas>
            </div>
        </div>

        {{-- Liste des transactions récentes --}}
        <div class="mt-6 p-4 bg-white rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-4">Transactions récentes</h3>
            <table class="w-full border-collapse border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 border">Type</th>
                        <th class="p-3 border">Montant</th>
                        <th class="p-3 border">Catégorie</th>
                        <th class="p-3 border">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr class="border">
                            <td class="p-3 border text-center font-semibold 
                                {{ $transaction->type === 'Revenu' ? 'text-green-600' : 'text-red-600' }}">
                                {{ $transaction->type }}
                            </td>
                            <td class="p-3 border text-center">{{ number_format($transaction->amount, 2) }} MAD</td>
                            <td class="p-3 border text-center">{{ $transaction->category->name ?? 'Non catégorisé' }}</td>
                            <td class="p-3 border text-center">{{ $transaction->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Script pour les graphiques avec Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Graphique en Pie Chart
        const ctxPie = document.getElementById('pieChart').getContext('2d');
        new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: ['Revenus', 'Dépenses'],
                datasets: [{
                    data: [22, 44],
                    backgroundColor: ['#10B981', '#EF4444']
                }]
            }
        });

        // Graphique en Bar Chart
        
    </script>
@endsection
