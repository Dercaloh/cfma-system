<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\ProfileController;

Route::middleware('auth')->prefix('perfil')->name('profile.')->group(function () {
    Route::get('/', [ProfileController::class, 'edit'])->name('edit');
    Route::patch('/', [ProfileController::class, 'update'])->name('update');
    Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password');
    Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
});
