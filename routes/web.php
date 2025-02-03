<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentStoreComController;
use App\Http\Controllers\PaymentComAdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;


use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



// ADMIN 
Route::prefix("admin")->middleware([ "auth" , "VerifyIsAdmin" ])->group(function () {

    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/paiement-store', [PaymentStoreComController::class, 'paiement_store_page'])->name('paiement_store');
    Route::get('/paiement-commerciaux', [PaymentComAdminController::class, 'paiement_commerciaux_page'])
        ->name('paiement_commerciaux');
    Route::get('/ajouter-produit', [ProductController::class, 'ajouter_produit_page'])->name('ajouter_produit');
    Route::get('/modifier-produit/{id}', [ProductController::class, 'modifier_produit_page'])->name('modifier_produit_page');
    Route::post('/modifier-produit/{id}', [ProductController::class, 'modifier_produit'])->name('modifier_produit');
    Route::delete('/supp-produit/{id}', [ProductController::class, 'supp_produit'])->name('supp_produit');
    Route::post('/create_user', [UserController::class, 'create_user'])->name('create_user');
    Route::post('/add_product', [ProductController::class, 'add_product'])->name('add_product');
    Route::get('/store-liste', [StoreController::class, 'liste_store'])->name('liste_store');

});


// Commercial 
Route::prefix("commercial")->middleware(["auth" , "verifyIsCommercial" ])->group(function () {

    Route::get('/dashboard', [UserController::class, 'dashboard_commercial'])->name('dashboard_commercial');
    Route::get('/create-store', [UserController::class, 'create_store_page'])->name('create_store_page');
    Route::post('/create_store', [UserController::class, 'create_store'])->name('create_store');
    Route::get('/store-liste', [StoreController::class, 'commercial_liste_store'])->name('commercial_liste_store');
});



// prop_store 
Route::prefix("store")->middleware(["auth" , "VerifyIsPropStore"])->group(function () {

    Route::get('/dashboard', [UserController::class, 'dashboard_store'])->name('dashboard_store');
 
});


require __DIR__.'/auth.php';
