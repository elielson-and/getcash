<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientDocumentationController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


// Rotas de cliente
Route::middleware('auth', 'verified')->group(function () {

    Route::get('/painel-do-cliente', function () {
        return Inertia::render('Client/Dashboard');
    });

    Route::get('/documentacao', [ClientDocumentationController::class, 'index'])->name('documentacao');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
