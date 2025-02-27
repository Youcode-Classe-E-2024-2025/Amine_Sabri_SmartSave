@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-semibold mb-4">Transactions pour {{ $profile->name }}</h2>

        <a href="{{ route('transactions.create', $profile->id) }}" 
           class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
            Ajouter une transaction
        </a>

        <div class="overflow-x-auto mt-4">
            <table class="w-full border-collapse border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2 text-left">Type</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Montant</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Catégorie</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Description</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $transaction->type == 'income' ? 'Revenu' : 'Dépense' }}</td>
                            <td class="px-4 py-2 font-semibold">
                                {{ number_format($transaction->amount, 2) }} {{ $profile->currency }}
                            </td>
                            <td class="px-4 py-2">{{ $transaction->category }}</td>
                            <td class="px-4 py-2">{{ $transaction->description }}</td>
                            <td class="px-4 py-2">{{ $transaction->date }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
