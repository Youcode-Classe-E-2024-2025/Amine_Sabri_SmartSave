<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::whereHas('profile', function ($query) {
            $query->where('user_id', Auth::id());
        })->latest()->get();

        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('transactions.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:Revenu,Dépense',
            'amount' => 'required|numeric|min:0.01',
            'category_id' => 'nullable|exists:categories,id'
        ]);

        Transaction::create([
            'profile_id' => session('current_profile'), 
            'type' => $request->type,
            'amount' => $request->amount,
            'category_id' => $request->category_id
        ]);

        return redirect()->route('home',session('current_profile'))->with('success', 'Transaction ajoutée avec succès.');
    }

    public function edit(Transaction $transaction)
{
    // Vérifier si l'utilisateur a le droit de modifier cette transaction
    if ($transaction->profile_id !== session('current_profile')) {
        return redirect()->route('home', session('current_profile'))->with('error', 'Accès non autorisé.');
    }

    $categories = Category::all(); // Récupérer toutes les catégories
    return view('transactions.edit', compact('transaction', 'categories'));
}

public function update(Request $request, Transaction $transaction)
{
    // Vérifier l'accès
    if ($transaction->profile_id !== session('current_profile')) {
        return redirect()->route('home', session('current_profile'))->with('error', 'Accès non autorisé.');
    }

    $request->validate([
        'type' => 'required|in:Revenu,Dépense',
        'amount' => 'required|numeric|min:0.01',
        'category_id' => 'nullable|exists:categories,id'
    ]);

    $transaction->update([
        'type' => $request->type,
        'amount' => $request->amount,
        'category_id' => $request->category_id
    ]);

    return redirect()->route('home', session('current_profile'))->with('success', 'Transaction mise à jour avec succès.');
}

public function destroy(Transaction $transaction)
{
    // Vérifier l'accès
    if ($transaction->profile_id !== session('current_profile')) {
        return redirect()->route('home', session('current_profile'))->with('error', 'Accès non autorisé.');
    }

    $transaction->delete();

    return redirect()->route('home', session('current_profile'))->with('success', 'Transaction supprimée avec succès.');
}

}
