<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// ---------------------- Start Seller Route -----------------------------

Route::prefix('seller')->group(function () {

    Route::get('/login', [SellerController::class, 'seller_login_form'])->name('seller_login_form');
    Route::post('/login/owner', [SellerController::class, 'login'])->name('seller.login');
    Route::get('/dashboard', [SellerController::class, 'dashboard'])->name('seller.dashboard')->middleware('seller');
    Route::get('/logout', [SellerController::class, 'logout'])->name('seller.logout');
    Route::get('/register/owner', [SellerController::class, 'seller_register_form'])->name('seller_register_form');
    Route::post('/register', [SellerController::class, 'register'])->name('seller.register');
});

// ---------------------- End Seller Route -----------------------------

Route::prefix('admin')->group(function () {

    Route::get('/login', [AdminController::class, 'login_form'])->name('login_form');
    Route::post('/login/owner', [AdminController::class, 'login'])->name('admin.login');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('admin');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/register/owner', [AdminController::class, 'register_form'])->name('register_form');
    Route::post('/register', [AdminController::class, 'register'])->name('admin.register');
});

// ---------------------- End Admin Route -----------------------------

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
