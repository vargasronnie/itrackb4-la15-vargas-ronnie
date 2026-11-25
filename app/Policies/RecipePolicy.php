<?php

namespace App\Policies;

use App\Models\Recipe;
use App\Models\User;

class RecipePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Recipe $recipe): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function update(User $user, Recipe $recipe): bool
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, Recipe $recipe): bool
    {
        return $user->role === 'admin';
    }

    public function restore(User $user, Recipe $recipe): bool
    {
        return false;
    }

    public function forceDelete(User $user, Recipe $recipe): bool
    {
        return false;
    }
}