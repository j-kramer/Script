<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::resource('categories', CategoryController::class)->only('index');
Route::resource('tickets', TicketController::class)->only('index');
Route::resource('users', UserController::class)->except('store');

/*
+ * Authentication routes
+ */
require __DIR__.'/auth.php';
