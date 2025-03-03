<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Transaction;
use App\Models\SavingsGoal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Profile $profile){
        // dd($profile->id);
        $transactions = Transaction::paginate(5);
        // $transactions = Transaction::where('profile_id',$profile->id)->paginate(5);
        $totalAmount = Transaction::sum('amount');
        // $totalAmount = Transaction::where('profile_id', $profile->id)->sum('amount');
        $lastTransaction = Transaction::latest()->first();
        // $lastTransaction = Transaction::where('profile_id', $profile->id)->latest()->first();
        // dd($transactions);

        $objectifinanciers = SavingsGoal::latest()->first();
        session(['current_profile'=>$profile->id]);
        return view('home', compact('transactions','totalAmount','lastTransaction','objectifinanciers'));
    }
}
