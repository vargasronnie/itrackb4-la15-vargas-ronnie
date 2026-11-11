<?php

namespace App\Http\Controllers;

use App\Models\Cuisine;
use App\Models\Recipe;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'recipeCount'  => Recipe::count(),
            'cuisineCount' => Cuisine::count(),
        ]);
    }
}