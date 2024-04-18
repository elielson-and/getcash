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

        Route::get('/gerenciamento', function () {
            return Inertia::render('Admin/Management');
        })->name('admin.management');


//        Route::get('/meu-perfil', function () {
//            return Inertia::render('AdminProfile/Edit');
//        })->name('admin.profile.edit');



    });
    Route::get('/meu-perfil', [ProfileController::class, 'edit'])->name('admin.profile.edit');

});
