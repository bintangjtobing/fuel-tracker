<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FuelEntryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::view('/','auth.index');
Route::get('/dashboard', [DashboardController::class,'index'])->name('home');
// Route untuk menampilkan semua entri bahan bakar
Route::get('/fuel-track', [FuelEntryController::class, 'index'])->name('fuel_entries.index');

// Route untuk menampilkan form tambah entri bahan bakar
Route::get('/fuel-track/create', [FuelEntryController::class, 'create'])->name('fuel_entries.create');

// Route untuk menyimpan entri bahan bakar baru
Route::post('/fuel-track', [FuelEntryController::class, 'store'])->name('fuel_entries.store');

// Route untuk menampilkan detail entri bahan bakar
Route::get('/fuel-track/{id}', [FuelEntryController::class, 'show'])->name('fuel_entries.show');

// Route untuk menampilkan form edit entri bahan bakar
Route::get('/fuel-track/{id}/edit', [FuelEntryController::class, 'edit'])->name('fuel_entries.edit');

// Route untuk menyimpan entri bahan bakar yang telah diedit
Route::put('/fuel-track/{id}', [FuelEntryController::class, 'update'])->name('fuel_entries.update');

// Route untuk menghapus entri bahan bakar
Route::delete('/fuel-track/{id}', [FuelEntryController::class, 'destroy'])->name('fuel_entries.destroy');


use App\Http\Controllers\TransactionController;

Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
Route::get('/transactions/{transaction}/edit', [TransactionController::class, 'edit'])->name('transactions.edit');
Route::put('/transactions/{transaction}', [TransactionController::class, 'update'])->name('transactions.update');
Route::delete('/transactions/{transaction}', [TransactionController::class, 'destroy'])->name('transactions.destroy');
