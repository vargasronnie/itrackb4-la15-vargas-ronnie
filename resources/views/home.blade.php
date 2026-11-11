@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container py-5">

    <div class="text-center mb-5">
        <img src="{{ asset('img/photo.jpg') }}" width="96" height="96" class="rounded-circle mb-3" alt="Photo of Ronnie Vargas">
        <h5 class="mb-1">Ronnie Vargas</h5>
        <p class="text-muted mb-0">BS Information Technology · 4th Year · Block A</p>
    </div>

    <div class="text-center mb-5">
        <h2 class="fw-bold">Plan what to cook, from one place</h2>
        <p class="text-muted mb-0">Browse recipes by cuisine, and add the ones you make.</p>
    </div>

    <div class="row justify-content-center g-3 mb-5">
        <div class="col-6 col-md-3">
            <div class="card text-center h-100">
                <div class="card-body">
                    <div class="text-muted small">Recipes saved</div>
                    <div class="fs-2 fw-semibold">{{ $recipeCount }}</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card text-center h-100">
                <div class="card-body">
                    <div class="text-muted small">Cuisines</div>
                    <div class="fs-2 fw-semibold">{{ $cuisineCount }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center">
        <a href="{{ route('recipes.index') }}" class="btn btn-dark px-4">See all recipes</a>
    </div>

</div>
@endsection