<?php

use illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\LoginRegisterController;
use App\Http\Controllers\ReviewController;
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
Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::post('/logout', 'logout')->name('logout');
});
// middleware auth untuk halaman dashboard dan route buku
Route::middleware(['auth'])->group(function() {
    Route::get('/dashboard', [BukuController::class, 'index'])->name('dashboard');

    Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');
    Route::get('/buku/create', [BukuController::class, 'create'])->name('buku.create');
    Route::post('/buku', [BukuController::class, 'store'])->name('buku.store');
    Route::delete('/buku/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');
    Route::get('/buku/{id}/edit', [BukuController::class, 'edit'])->name('buku.edit');
    Route::put('/buku/{id}', [BukuController::class, 'update'])->name('buku.update');
    Route::get('/buku/search',[BukuController::class, 'search'])->name('buku.search');
});

Route::middleware(['auth', 'role:admin,internal_reviewer'])->group(function () {
    Route::get('/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/reviews/store', [ReviewController::class, 'store'])->name('reviews.store');
});

Route::get('/reviews/reviewer/{user}', [ReviewController::class, 'showByReviewer'])->name('reviews.byReviewer');
Route::get('/reviews/tag/{tag}', [ReviewController::class, 'showByTag'])->name('reviews.byTag');
// Route::middleware(['auth', 'role:admin,internal_reviewer'])->get('/formulir-review-buku', [ReviewController::class, 'showForm'])->name('review.form');




