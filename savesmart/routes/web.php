<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;




Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');




Route::middleware(['auth'])->group(function () {
    Route::get('/profiles', [ProfileController::class, 'index'])->name('profiles.index');
    Route::get('/profiles/create', [ProfileController::class, 'create'])->name('profiles.create');
    Route::post('/profiles', [ProfileController::class, 'store'])->name('profiles.store');
    Route::get('/profiles/{profile}/unlock', [ProfileController::class, 'showUnlockForm'])->name('profiles.unlock');
    Route::post('/profiles/{profile}/unlock', [ProfileController::class, 'unlockProfile'])->name('profiles.unlock.post');
    Route::get('/home/{profile}', [ProfileController::class, 'home'])->name('profiles.home');
});
// Route::post('/profiles/{profile}/login', [ProfileController::class, 'loginToProfile'])->name('profiles.login');



use App\Http\Controllers\TransactionController;

Route::middleware(['auth'])->group(function () {
    Route::get('/profiles/{profile}/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/profiles/{profile}/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
});