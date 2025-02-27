<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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

    public function loginToProfile(Request $request, $profileId)
{
    $profile = Profile::findOrFail($profileId);

    if (!Hash::check($request->password, $profile->password)) {
        return back()->withErrors(['password' => 'Mot de passe incorrect.']);
    }

    session(['active_profile' => $profile->id]);

    return redirect()->route('dashboard');
}




public function showUnlockForm(Profile $profile)
    {
        return view('profiles.unlock', compact('profile'));
    }

    // Vérifier le mot de passe du profil
    public function unlockProfile(Request $request, Profile $profile)
    {
        $request->validate([
            'password' => 'required'
        ]);

        if (Hash::check($request->password, $profile->password)) {
            Session::put('unlocked_profile', $profile->id);
            return redirect()->route('transactions.index', $profile->id);
        }

        return back()->with('error', 'Mot de passe incorrect.');
    }

    // Page d'accueil après déverrouillage
    public function home(Profile $profile)
    {
        if (Session::get('unlocked_profile') !== $profile->id) {
            return redirect()->route('profiles.unlock', $profile->id)->with('error', 'Veuillez entrer le mot de passe.');
        }

        return view('profiles.home', compact('profile'));
    }

}
