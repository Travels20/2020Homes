
@extends('layouts.guest')

@section('title', 'Login')

@section('content')
<div class="container-fluid d-flex align-items-center justify-content-center min-vh-100" 
     style="background-color: #f4f6f9;">
    
    <div class="card glass-card p-5" style="max-width: 450px; width: 100%; border: 1px solid rgba(0,0,0,0.05);">
        <div class="text-center mb-5">
            <div class="btn-gradient-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" 
                 style="width: 64px; height: 64px; font-size: 32px;">
                <i class="bi bi-house-heart-fill"></i>
            </div>
            <h2 class="fw-bold mb-1">Welcome Back</h2>
            <p class="text-secondary">Sign in to your 2020Homes account</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-4">
                <label for="email" class="form-label text-secondary fw-semibold">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text border-end-0 bg-transparent text-secondary">
                        <i class="bi bi-envelope"></i>
                    </span>
                    <input type="email" class="form-control border-start-0 ps-0 bg-transparent" 
                           id="email" name="email" required autofocus
                           placeholder="name@example.com"
                           style="height: 50px;">
                </div>
                @error('email')
                    <div class="text-danger mt-1 small">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="form-label text-secondary fw-semibold">Password</label>
                <div class="input-group">
                    <span class="input-group-text border-end-0 bg-transparent text-secondary">
                        <i class="bi bi-lock"></i>
                    </span>
                    <input type="password" class="form-control border-start-0 ps-0 bg-transparent" 
                           id="password" name="password" required
                           placeholder="Enter your password"
                           style="height: 50px;">
                </div>
                @error('password')
                    <div class="text-danger mt-1 small">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label text-secondary" for="remember">
                        Remember me
                    </label>
                </div>
                <a href="#" class="text-primary text-decoration-none small">Forgot Password?</a>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-gradient-primary w-100 py-3 fw-bold shadow-sm" style="font-size: 16px;">
                Sign In <i class="bi bi-arrow-right ms-2"></i>
            </button>
        </form>

        <div class="text-center mt-5">
            <p class="text-secondary mb-0">
                Don't have an account? <a href="{{ route('register') }}" class="text-primary fw-bold text-decoration-none">Create Account</a>
            </p>
        </div>
    </div>
</div>

<style>
.glass-card {
    background: rgba(255, 255, 255, 0.7);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border-radius: 20px;
    box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
}
.input-group-text {
    border-color: rgba(0,0,0,0.1);
}
.form-control {
    border-color: rgba(0,0,0,0.1);
    box-shadow: none !important;
}
.form-control:focus {
    border-color: #b32d2e;
}
</style>
@endsection
