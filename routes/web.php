<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

Route::get('/recipes/featured', [RecipeController::class, 'featured'])->name('recipes.featured');
Route::get('/recipes/filter/{cuisine}', [RecipeController::class, 'filter'])->name('recipes.filter');

Route::resource('recipes', RecipeController::class)
    ->middlewareFor(['create', 'store', 'edit', 'update', 'destroy'], 'auth');