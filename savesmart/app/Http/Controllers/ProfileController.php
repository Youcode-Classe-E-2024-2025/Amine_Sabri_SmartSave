<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $profiles = Auth::user()->profiles;
        return view('profiles.index', compact('profiles'));
    }

    public function create()
    {
        return view('profiles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6'
        ]);

        Profile::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('profiles.index')->with('success', 'Profil créé avec succès !');
    }


    public function edit(Profile $profile)
{
    // Vérifie si le profil appartient à l'utilisateur connecté
    if ($profile->user_id !== Auth::id()) {
        return redirect()->route('profiles.index')->with('error', 'Vous n\'avez pas accès à ce profil.');
    }

    return view('profiles.edit', compact('profile'));
}

public function update(Request $request, Profile $profile)
{
    // Vérifie si le profil appartient à l'utilisateur connecté
    if ($profile->user_id !== Auth::id()) {
        return redirect()->route('profiles.index')->with('error', 'Vous n\'avez pas accès à ce profil.');
    }

    // Validation des données
    $request->validate([
        'name' => 'required|string|max:255',
        'password' => 'nullable|string|min:6' // Le mot de passe est optionnel
    ]);

    // Mise à jour du profil
    $profile->name = $request->name;
    if ($request->password) {
        $profile->password = Hash::make($request->password);
    }
    $profile->save();

    return redirect()->route('profiles.index')->with('success', 'Profil mis à jour avec succès !');
}

public function destroy(Profile $profile)
{
    // Vérifie si le profil appartient à l'utilisateur connecté
    if ($profile->user_id !== Auth::id()) {
        return redirect()->route('profiles.index')->with('error', 'Vous n\'avez pas accès à ce profil.');
    }

    // Suppression du profil
    $profile->delete();

    return redirect()->route('profiles.index')->with('success', 'Profil supprimé avec succès !');
}

}
