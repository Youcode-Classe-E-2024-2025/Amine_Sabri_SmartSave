<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });




Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard')->middleware('auth');
// Route::middleware()->group(function () {
// });
// Route::get('/admin/dashboard', function () {
//     return view('admin.dashboard',['profiles'=>'']);
// })->name('admin.dashboard');

use App\Http\Controllers\ProfileController;

Route::middleware(['auth'])->group(function () {
    Route::get('/profiles', [ProfileController::class, 'index'])->name('profiles.index');
    Route::get('/profiles/create', [ProfileController::class, 'create'])->name('profiles.create');
    Route::post('/profiles', [ProfileController::class, 'store'])->name('profiles.store');
    Route::get('/profiles/{profile}/unlock', [ProfileController::class, 'showUnlockForm'])->name('profiles.unlock');
Route::post('/profiles/{profile}/unlock', [ProfileController::class, 'unlockProfile'])->name('profiles.unlock.post');
Route::get('/home/{profile}', [ProfileController::class, 'home'])->middleware('auth')->name('profiles.home');
});
// Route::post('/profiles/{profile}/login', [ProfileController::class, 'loginToProfile'])->name('profiles.login');
