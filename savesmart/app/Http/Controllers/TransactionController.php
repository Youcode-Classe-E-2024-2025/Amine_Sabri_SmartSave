<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Profile;

class TransactionController extends Controller
{
    public function index(Profile $profile)
    {
        $transactions = $profile->transactions()->latest()->get();
        return view('transactions.index', compact('transactions', 'profile'));
    }

    public function create(Profile $profile)
    {
        return view('transactions.create', compact('profile'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'profile_id' => 'required|exists:profiles,id',
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric|min:0.01',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
        ]);

        Transaction::create($request->all());

        return redirect()->route('transactions.index', $request->profile_id)
                         ->with('success', 'Transaction ajoutée avec succès!');
    }
}
