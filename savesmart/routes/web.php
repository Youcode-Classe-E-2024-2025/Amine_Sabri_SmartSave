<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SavingsGoalController;




Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');



use App\Http\Controllers\HomeController;

Route::middleware(['auth'])->group(function () {
    Route::get('/profiles', [ProfileController::class, 'index'])->name('profiles.index');
    Route::get('/profiles/create', [ProfileController::class, 'create'])->name('profiles.create');
    Route::post('/profiles', [ProfileController::class, 'store'])->name('profiles.store');
    Route::get('/profiles/{profile}/edit', [ProfileController::class, 'edit'])->name('profiles.edit'); // Formulaire d'édition
    Route::put('/profiles/{profile}', [ProfileController::class, 'update'])->name('profiles.update'); // Mise à jour du profil
    Route::delete('/profiles/{profile}', [ProfileController::class, 'destroy'])->name('profiles.destroy'); // Suppression du profil
    Route::resource('categories', CategoryController::class);
    Route::get('/home/{profile}', [HomeController::class, 'index'])->name('home');
    Route::get('/profilPersonnel/{profile}', [HomeController::class, 'affiche'])->name('profilePesronnel');
});



Route::resource('transactions', TransactionController::class);
Route::resource('savings_goals', SavingsGoalController::class);

Route::get('/export-goals', [SavingsGoalController::class, 'exportGoals'])->name('goals.export');