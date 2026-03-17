<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('dashboard',[ProjectController::class, 'allProjects'])->name('dashboard');
    Route::get('atividades/{id}/projeto',[ActivityController::class, 'index'])->name('atividades');
    Route::post('atividades/{id}/projeto',[ActivityController::class, 'store'])->name('atividades.store');
    Route::put('atividades/{id}',[ActivityController::class, 'update'])->name('atividades.update');
    Route::delete('atividades/{id}',[ActivityController::class, 'destroy'])->name('atividades.destroy');
});

require __DIR__.'/auth.php';
