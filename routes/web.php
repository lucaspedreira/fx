<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/transacoes/{transacao?}', [TransactionController::class, 'index'])->name('transactions.index');
Route::post('transacoes', [TransactionController::class, 'store'])->name('transactions.store');
Route::put('transacoes/{transacao}', [TransactionController::class, 'update'])->name('transactions.update');
Route::delete('transacoes/{transacao?}', [TransactionController::class, 'destroy'])->name('transactions.destroy');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
