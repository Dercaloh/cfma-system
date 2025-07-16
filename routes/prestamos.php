<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Loans\LoanController;

Route::middleware(['auth', 'role:Aprendiz,Funcionario,Instructor,Vocero Principal,Vocero Suplente'])
    ->get('/prestamos/solicitar', [LoanController::class, 'create'])->name('prestamos.solicitar');

Route::middleware('auth')->prefix('prestamos')->name('prestamos.')->group(function () {
    Route::resource('/', LoanController::class)->parameters(['' => 'loan']);
    Route::get('{loan}/debug', [LoanController::class, 'show'])->name('debug');
    Route::post('{loan}/aprobar', [LoanController::class, 'approve'])->name('aprobar');
    Route::post('{loan}/entregar', [LoanController::class, 'checkOut'])->name('entregar');
    Route::post('{loan}/devolver', [LoanController::class, 'checkIn'])->name('devolver');
});
