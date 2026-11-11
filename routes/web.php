<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/recipes/featured', [RecipeController::class, 'featured'])
    ->name('recipes.featured');

Route::get('/recipes/filter/{cuisine}', [RecipeController::class, 'filter'])
    ->name('recipes.filter');

Route::resource('recipes', RecipeController::class);