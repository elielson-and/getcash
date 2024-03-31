<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientDocumentationController;
use App\Http\Controllers\DocumentController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


// Rotas de cliente
Route::middleware('auth', 'verified')->group(function () {

    Route::get('/painel-do-cliente', function () {
        return Inertia::render('Client/Dashboard');
    });

    Route::get('/documentacao', [DocumentController::class, 'index'])->name('documentacao');
    Route::get('/transacoes', function () {
        return Inertia::render('Client/Transactions');
    })->name('transacoes');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    //Docs
    Route::post('/documentation/store', [DocumentController::class, 'store'])->name('document.store');
});
