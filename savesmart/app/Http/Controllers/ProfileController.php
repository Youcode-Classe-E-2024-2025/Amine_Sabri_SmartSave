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

    public function loginToProfile(Request $request, $profileId)
{
    $profile = Profile::findOrFail($profileId);

    if (!Hash::check($request->password, $profile->password)) {
        return back()->withErrors(['password' => 'Mot de passe incorrect.']);
    }

    session(['active_profile' => $profile->id]);

    return redirect()->route('dashboard');
}

}
