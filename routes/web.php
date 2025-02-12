<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LaboranController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\TeknisiController;

use App\Http\Controllers\UsersController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\LabController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/login', function () {
    return redirect('/');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin',[AdminController::class,'index'])->name('admin.index');
    Route::get('fakultas', [FakultasController::class, 'index'])->name('fakultas.index');
    Route::get('fakultas/create', [FakultasController::class, 'create'])->name('fakultas.create');
    Route::post('fakultas', [FakultasController::class, 'store'])->name('fakultas.store');
    Route::delete('fakultas/{fakultas}', [FakultasController::class, 'destroy'])->name('fakultas.destroy');
    
    Route::get('users', [UsersController::class, 'index'])->name('users.index');
    Route::get('users/{user}/edit', [UsersController::class, 'edit'])->name('users.edit');
    Route::put('users/{user}', [UsersController::class, 'update'])->name('users.update');
    Route::delete('users/{user}', [UsersController::class, 'destroy'])->name('users.destroy');

    Route::get('labs', [LabController::class, 'index'])->name('labs.index');
    Route::get('labs/create', [LabController::class, 'create'])->name('labs.create');
    Route::post('labs', [LabController::class, 'store'])->name('labs.store');
    Route::delete('labs/{lab}', [LabController::class, 'destroy'])->name('labs.destroy');

});

Route::middleware(['auth', 'teknisi'])->group(function () {
    Route::get('/teknisi',[TeknisiController::class,'index'])->name('teknisi.index');
});

Route::middleware(['auth', 'laboran'])->group(function () {
    Route::get('/laboran',[LaboranController::class,'index'])->name('laboran.index');
});

Route::middleware(['auth', 'pengguna'])->group(function () {
    Route::get('/pengguna',[PenggunaController::class,'index'])->name('pengguna.index');
});

require __DIR__.'/auth.php';

