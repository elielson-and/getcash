<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientDocumentationController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\WalletController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


// Rotas de cliente
Route::middleware('auth', 'verified')->group(function () {

    // Route::get('/inicio', function () {
    //     return Inertia::render('Client/Home');
    // })->name('inicio');

    Route::get('/painel-do-cliente', function () {
        return Inertia::render('Client/Home');
    })->name('painel-cliente');

    Route::get('/documentacao', [DocumentController::class, 'index'])->name('documentacao');
    Route::get('/transacoes', function () {
        return Inertia::render('Client/Transactions');
    })->name('transacoes');

    Route::get('/suporte', function () {
        return Inertia::render('Client/Support');
    })->name('suporte');

    Route::get('/termos-de-uso', function () {
        return Inertia::render('Client/Terms');
    })->name('termos');


    Route::get('/perfil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    //Docs
    Route::post('/documentation/store', [DocumentController::class, 'store'])->name('document.store');

    Route::get('/get-document-status', [DocumentController::class, 'status'])->name('doc-status');

    // Wallet

    // Get wallet data
    Route::get('/get-wallet', [WalletController::class, 'show']);
});
