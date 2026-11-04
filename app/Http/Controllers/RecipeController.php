<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\Cuisine;
use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index(Request $request)
    {
        $cuisineId = $request->query('cuisine_id');

        $query = Recipe::withh('cuisine');

        if ($cuisineId) {
            $query = $query->where('cuisine_id', $cuisineId);
        }

        $recipes = $query->get();

        return view('recipes.index', compact('recipes'));
    }

    public function create()
    {
        $cuisines = Cuisine::all();

        return view('recipes.create', compact('cuisines'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|max:50',
            'category'   => 'required|in:Main Course,Dessert,Appetizer',
            'cuisine_id' => 'required|exists:cuisines,id',
            'time'       => 'required|integer|min:1|max:300',
            'difficulty' => 'required|in:Easy,Medium,Hard',
            'servings'   => 'required|integer|min:1|max:20',
        ]);

        $recipe = Recipe::create($validated);

        Log::info('Recipe saved', [
            'id' => $recipe->id,
        ]);

        return redirect()
            ->route('recipes.index')
            ->with('success', 'Recipe added successfully');
    }

    public function show(Recipe $recipe)
    {
        return view('recipes.show', compact('recipe'));
    }

    public function edit(Recipe $recipe)
    {
        $cuisines = Cuisine::all();

        return view('recipes.edit', compact('recipe', 'cuisines'));
    }

    public function update(Request $request, Recipe $recipe)
    {
        $validated = $request->validate([
            'name' => 'required',
            'time' => 'required',
            'cuisine_id' => 'required|exists:cuisines,id',
        ]);

        $recipe->update($validated);

        return redirect()->route('recipes.index');
    }

    public function destroy(Recipe $recipe)
    {
        abort_if($recipe->cuisine->recipes()->count() === 1, 403);

        $recipe->delete();

        return redirect()->route('recipes.index');
    }

    public function featured()
    {
        //
    }

    public function filter($cuisine)
    {
        //
    }
}