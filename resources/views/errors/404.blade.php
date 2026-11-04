@extends('layouts.app')

@section('title', 'Page Not Found')

@section('content')
<div class="container mt-4">
    <h1>Page not found</h1>
    <p>The recipe you're looking for doesn't exist or may have been removed.</p>
    <a href="{{ route('recipes.index') }}">Back to the list</a>
</div>
@endsection