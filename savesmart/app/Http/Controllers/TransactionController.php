<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Category;
// use App\Models\Profile;

class TransactionController extends Controller
{
    // Afficher le formulaire pour créer une transaction
    public function create()
    {
        $categories = Category::all(); // Récupérer toutes les catégories
        return view('transactions.create', compact('categories'));
    }

    // Enregistrer la transaction
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'amount' => 'required|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        // Associer la transaction au profil connecté
        Transaction::create([
            'profile_id' => auth()->user()->profiles()->first()->id, // Sélectionner le premier profil de l'utilisateur
            'type' => $request->type,
            'amount' => $request->amount,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('profiles.index')->with('success', 'Transaction ajoutée avec succès!');
    }
}
