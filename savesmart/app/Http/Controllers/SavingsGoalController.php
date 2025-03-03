<?php

namespace App\Http\Controllers;

use App\Models\SavingsGoal;
use App\Models\Profile;
use Illuminate\Http\Request;

class SavingsGoalController extends Controller
{
    // Afficher la liste des objectifs d'épargne
    public function index()
    {
        $goals = SavingsGoal::all();
        return view('savings_goals.index', compact('goals'));
    }

    // Afficher le formulaire de création
    public function create()
    {
        $profiles = Profile::all(); // Récupérer les profils pour les assigner aux objectifs
        return view('savings_goals.create', compact('profiles'));
    }

    // Enregistrer un nouvel objectif d'épargne
    public function store(Request $request)
    {
        $request->validate([
            'profile_id' => 'required|exists:profiles,id',
            'name' => 'required|string|max:255',
            'target_amount' => 'required|numeric|min:0',
            'saved_amount' => 'nullable|numeric|min:0',
            'deadline' => 'nullable|date'
        ]);

        SavingsGoal::create($request->all());

        return redirect()->route('savings_goals.index')->with('success', 'Objectif ajouté avec succès.');
    }

    // Afficher un objectif spécifique
    public function show(SavingsGoal $savingsGoal)
    {
        return view('savings_goals.show', compact('savingsGoal'));
    }

    // Afficher le formulaire d'édition
    public function edit(SavingsGoal $savingsGoal)
    {
        $profiles = Profile::all();
        return view('savings_goals.edit', compact('savingsGoal', 'profiles'));
    }

    // Mettre à jour un objectif d'épargne
    public function update(Request $request, SavingsGoal $savingsGoal)
    {
        $request->validate([
            'profile_id' => 'required|exists:profiles,id',
            'name' => 'required|string|max:255',
            'target_amount' => 'required|numeric|min:0',
            'saved_amount' => 'nullable|numeric|min:0',
            'deadline' => 'nullable|date'
        ]);

        $savingsGoal->update($request->all());

        return redirect()->route('savings_goals.index')->with('success', 'Objectif mis à jour avec succès.');
    }

    // Supprimer un objectif
    public function destroy(SavingsGoal $savingsGoal)
    {
        $savingsGoal->delete();
        return redirect()->route('savings_goals.index')->with('success', 'Objectif supprimé avec succès.');
    }
}
