<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PaymentStoreComController;
use App\Http\Controllers\PaymentComAdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StoreController;

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::view('/', 'welcome');


// ADMIN 
Route::prefix("admin")->middleware("auth")->group(function () {

    // Route::view('dashboard', 'dashboard')->middleware(['verified'])  -> name('dashboard'); 
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');  
    
    Route::get('/paiement-store', [PaymentStoreComController::class, 'paiement_store_page']) -> name('paiement_store');  
    Route::get('/paiement-commerciaux', [PaymentComAdminController::class, 'paiement_commerciaux_page']) 
    -> name('paiement_commerciaux');  
    Route::get('/ajouter-produit', [ProductController::class, 'ajouter_produit_page']) -> name('ajouter_produit');
    Route::post('/create_user', [UserController::class, 'create_user'])->name('create_user');  
    Route::get('/store-liste', [StoreController::class, 'liste_store'])->name('liste_store');  

    
});


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
