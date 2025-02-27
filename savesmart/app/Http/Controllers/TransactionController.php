<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Profile;
use App\Models\Category;
use Illuminate\Http\Request;
class TransactionController extends Controller
{
    public function index(Profile $profile)
    {
        $transactions = $profile->transactions()->with('category')->get();
        return view('transactions.index', compact('profile', 'transactions'));
    }

    public function create(Profile $profile)
    {
        $categories = Category::all();
        return view('transactions.create', compact('profile', 'categories'));
    }

    public function store(Request $request, Profile $profile)
    {
        $request->validate([
            'type' => 'required|in:Revenu,Dépense',
            'amount' => 'required|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        Transaction::create([
            'profile_id' => $profile->id,
            'type' => $request->type,
            'amount' => $request->amount,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('transactions.index', $profile->id);
    }
}
