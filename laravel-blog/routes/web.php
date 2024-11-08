<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeServer;
use App\Http\Controllers\PremiumController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeServer::class)->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('articles', ArticleController::class)->middleware('auth')->except('show');
Route::get('articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
Route::resource('categories', CategoryController::class)->middleware('auth')->only(['store', 'destroy']);
Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function() {
    Route::get('premium', [PremiumController::class,'edit'])->name('premium.edit');
    Route::patch('premium', [PremiumController::class, 'update'])->name('premium.update');
});

require __DIR__.'/auth.php';
