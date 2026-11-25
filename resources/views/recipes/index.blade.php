@extends('layouts.app')

@section('title', 'Recipe List')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">My Recipe List</h1>

        @can('create', App\Models\Recipe::class)
            <a href="{{ route('recipes.create') }}" class="btn btn-primary">+ Add Recipe</a>
        @endcan
    </div>

    @cannot('create', App\Models\Recipe::class)
        <p class="text-muted small">You are viewing this list in read-only mode.</p>
    @endcannot

    <form method="GET" action="{{ route('recipes.index') }}" class="card card-body mb-4">
        <div class="row g-2 align-items-end">

            <div class="col-md-4">
                <label class="form-label">Search by name</label>
                <input type="text" name="search" class="form-control" value="{{ request('search') }}">
            </div>

            <div class="col-md-3">
                <label class="form-label">Cuisine</label>
                <select name="cuisine_id" class="form-select">
                    <option value="">All</option>
                    @foreach ($cuisines as $cuisine)
                        <option value="{{ $cuisine->id }}" @selected(request('cuisine_id') == $cuisine->id)>{{ $cuisine->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <label class="form-label">Vegetarian</label>
                <select name="is_vegetarian" class="form-select">
                    <option value="">Any</option>
                    <option value="1" @selected(request('is_vegetarian') === '1')>Yes</option>
                    <option value="0" @selected(request('is_vegetarian') === '0')>No</option>
                </select>
            </div>

            <div class="col-md-2">
                <label class="form-label">Sort by</label>
                <select name="sort" class="form-select">
                    <option value="name" @selected(request('sort', 'name') === 'name')>Name</option>
                    <option value="time" @selected(request('sort') === 'time')>Time</option>
                </select>
            </div>

            <div class="col-12 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Apply</button>
                <a href="{{ route('recipes.index') }}" class="btn btn-outline-secondary">Clear</a>
            </div>

        </div>
    </form>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Category</th>
                <th>Cuisine</th>
                <th>Time</th>
                <th>Difficulty</th>
                @can('create', App\Models\Recipe::class)
                    <th>Action</th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @forelse ($recipes as $recipe)
                <tr>
                    <td>{{ $recipe->id }}</td>
                    <td>
                        <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-outline-primary">{{ $recipe->name }}</a>
                    </td>
                    <td>{{ $recipe->category }}</td>
                    <td>{{ $recipe->cuisine->name }}</td>
                    <td>{{ $recipe->time }}</td>
                    <td>{{ $recipe->difficulty }}</td>

                    @canany(['update', 'delete'], $recipe)
                        <td>
                            @can('update', $recipe)
                                <a href="{{ route('recipes.edit', $recipe) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            @endcan

                            @can('delete', $recipe)
                                <form method="POST" action="{{ route('recipes.destroy', $recipe) }}" class="d-inline"
                                      onsubmit="return confirm('Delete this recipe?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            @endcan
                        </td>
                    @endcanany
                </tr>
            @empty
                <tr>
                    <td colspan="{{ Gate::check('create', App\Models\Recipe::class) ? 7 : 6 }}" class="text-center text-muted">
                        No recipes found matching your filters.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $recipes->links() }}

</div>
@endsection