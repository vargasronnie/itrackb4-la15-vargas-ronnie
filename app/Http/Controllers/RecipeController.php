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
    $search     = $request->query('search');
    $cuisineId  = $request->query('cuisine_id');
    $vegetarian = $request->query('is_vegetarian');
    $sort       = $request->query('sort', 'name');

    // Part I: only allowed columns can reach orderBy
    $allowedSorts = ['name', 'time'];
    if (! in_array($sort, $allowedSorts)) {
        $sort = 'name';
    }

    $query = Recipe::with('cuisine');

    if ($search) {
        $query->where('name', 'like', "%{$search}%");
    }

    if ($cuisineId) {
        $query->where('cuisine_id', $cuisineId);
    }

    // Part H: compare properly, because "0" (No) is falsy in PHP
    if ($vegetarian !== null && $vegetarian !== '') {
        $query->where('is_vegetarian', (bool) $vegetarian);
    }

    $recipes = $query->orderBy($sort)->paginate(10)->withQueryString();

    return view('recipes.index', [
        'recipes'    => $recipes,
        'cuisines'   => Cuisine::all(),
        'search'     => $search,
        'cuisineId'  => $cuisineId,
        'vegetarian' => $vegetarian,
        'sort'       => $sort,
    ]);
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