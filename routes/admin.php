<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


// Rotas de administrador
Route::middleware('auth', 'admin', 'verified')->group(function () {


    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', function () {
            return Inertia::render('Dashboard');
        })->name('dashboard');

//        Route::get('/configuracoes', function () {
//            return Inertia::render('Dashboard');
//        })->name('admin.settings');
    });



    //-------------------------------------------------------------------


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
