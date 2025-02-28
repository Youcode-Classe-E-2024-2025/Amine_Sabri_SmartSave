<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Profile $profile){
        // dd($profile->id);
        $transactions = Transaction::where('profile_id',$profile->id)->get();
        // dd($transactions);
        session(['current_profile'=>$profile->id]);
        return view('home', compact('transactions'));
    }
}
