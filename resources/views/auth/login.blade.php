@extends('layouts.app')

@section('title', 'Log in')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-6 col-lg-4">

            <div class="card shadow-sm">
                <div class="card-body p-4">

                    <h4 class="fw-bold mb-1">Log in</h4>
                    <p class="text-muted small mb-4">Sign in to add and manage recipes.</p>

                    <form method="POST" action="{{ route('login.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password"
                                   class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-dark w-100">Log in</button>
                    </form>

                </div>
            </div>

            <p class="text-center text-muted small mt-3 mb-0">
                No account yet?
                <a href="{{ route('register') }}" class="link-dark">Register</a>
            </p>

        </div>
    </div>
</div>
@endsection