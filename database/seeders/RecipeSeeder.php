<?php

namespace Database\Seeders;

use App\Models\Cuisine;
use App\Models\Recipe;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    public function run(): void
    {
        $filipino = Cuisine::create(['name' => 'Filipino']);
        $italian  = Cuisine::create(['name' => 'Italian']);
        $thai     = Cuisine::create(['name' => 'Thai']);

        $recipes = [
            ['Chicken Adobo', 'Main Course', $filipino, 60, 'Easy', 4, false],
            ['Leche Flan', 'Dessert', $filipino, 90, 'Medium', 8, true],
            ['Pancit Canton', 'Main Course', $filipino, 30, 'Easy', 4, false],
            ['Lumpiang Shanghai', 'Appetizer', $filipino, 45, 'Easy', 6, false],
            ['Halo-Halo', 'Dessert', $filipino, 20, 'Easy', 2, true],
            ['Sinigang', 'Main Course', $filipino, 50, 'Medium', 6, false],
            ['Ginataang Gulay', 'Main Course', $filipino, 35, 'Easy', 4, true],
            ['Turon', 'Dessert', $filipino, 25, 'Easy', 8, true],
            ['Spaghetti Carbonara', 'Main Course', $italian, 30, 'Medium', 4, false],
            ['Tiramisu', 'Dessert', $italian, 40, 'Hard', 6, true],
            ['Bruschetta', 'Appetizer', $italian, 15, 'Easy', 4, true],
            ['Margherita Pizza', 'Main Course', $italian, 45, 'Medium', 2, true],
            ['Minestrone', 'Appetizer', $italian, 55, 'Medium', 6, true],
            ['Panna Cotta', 'Dessert', $italian, 35, 'Medium', 6, true],
            ['Lasagna', 'Main Course', $italian, 90, 'Hard', 8, false],
            ['Pad Thai', 'Main Course', $thai, 35, 'Medium', 2, false],
            ['Mango Sticky Rice', 'Dessert', $thai, 50, 'Medium', 4, true],
            ['Thai Spring Rolls', 'Appetizer', $thai, 30, 'Easy', 4, true],
            ['Green Curry', 'Main Course', $thai, 40, 'Medium', 4, false],
            ['Tom Yum Soup', 'Appetizer', $thai, 25, 'Easy', 3, false],
        ];

        foreach ($recipes as [$name, $category, $cuisine, $time, $difficulty, $servings, $vegetarian]) {
            Recipe::create([
                'name'          => $name,
                'category'      => $category,
                'cuisine_id'    => $cuisine->id,
                'time'          => $time,
                'difficulty'    => $difficulty,
                'servings'      => $servings,
                'is_vegetarian' => $vegetarian,
                'notes'         => null,
            ]);
        }
    }
}