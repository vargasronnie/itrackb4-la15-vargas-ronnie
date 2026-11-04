@extends('layouts.app')

@section('title', 'Something Went Wrong')

@section('content')
<div class="container mt-4">
    <h1>Something went wrong on our side</h1>
    <p>This is a problem with the application, not with the address you entered. Please try again in a moment.</p>
    <a href="{{ route('recipes.index') }}">Back to the list</a>
</div>
@endsection