@extends('layouts.guest')

@section('title', 'Register')

@section('content')
<div class="container-fluid d-flex align-items-center justify-content-center min-vh-100 py-5" 
     style="background-color: #f4f6f9;">
    
    <div class="card glass-card p-5" style="max-width: 500px; width: 100%; border: 1px solid rgba(0,0,0,0.05);">
        <div class="text-center mb-5">
            <div class="btn-gradient-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" 
                 style="width: 64px; height: 64px; font-size: 32px;">
                <i class="bi bi-person-plus-fill"></i>
            </div>
            <h2 class="fw-bold mb-1">Create Account</h2>
            <p class="text-secondary">Join 2020Homes today</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="form-label text-secondary fw-semibold">Full Name</label>
                <div class="input-group">
                    <span class="input-group-text border-end-0 bg-transparent text-secondary">
                        <i class="bi bi-person"></i>
                    </span>
                    <input type="text" class="form-control border-start-0 ps-0 bg-transparent" 
                           id="name" name="name" value="{{ old('name') }}" required autofocus
                           placeholder="John Doe"
                           style="height: 50px;">
                </div>
                @error('name')
                    <div class="text-danger mt-1 small">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email Address -->
            <div class="mb-4">
                <label for="email" class="form-label text-secondary fw-semibold">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text border-end-0 bg-transparent text-secondary">
                        <i class="bi bi-envelope"></i>
                    </span>
                    <input type="email" class="form-control border-start-0 ps-0 bg-transparent" 
                           id="email" name="email" value="{{ old('email') }}" required
                           placeholder="name@example.com"
                           style="height: 50px;">
                </div>
                @error('email')
                    <div class="text-danger mt-1 small">{{ $message }}</div>
                @enderror
            </div>

            <!-- Phone Number -->
            <div class="mb-4">
                <label for="phone" class="form-label text-secondary fw-semibold">Phone Number</label>
                <div class="input-group">
                    <span class="input-group-text border-end-0 bg-transparent text-secondary">
                        <i class="bi bi-telephone"></i>
                    </span>
                    <input type="text" class="form-control border-start-0 ps-0 bg-transparent" 
                           id="phone" name="phone" value="{{ old('phone') }}" required
                           placeholder="9876543210"
                           style="height: 50px;">
                </div>
                @error('phone')
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
                           placeholder="Minimum 8 characters"
                           style="height: 50px;">
                </div>
                @error('password')
                    <div class="text-danger mt-1 small">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <label for="password_confirmation" class="form-label text-secondary fw-semibold">Confirm Password</label>
                <div class="input-group">
                    <span class="input-group-text border-end-0 bg-transparent text-secondary">
                        <i class="bi bi-shield-lock"></i>
                    </span>
                    <input type="password" class="form-control border-start-0 ps-0 bg-transparent" 
                           id="password_confirmation" name="password_confirmation" required
                           placeholder="Re-enter password"
                           style="height: 50px;">
                </div>
            </div>

            <!-- Terms -->
            <div class="mb-4 form-check">
                <input type="checkbox" class="form-check-input" id="terms" required>
                <label class="form-check-label text-secondary small" for="terms">
                    I agree to the <a href="#" class="text-primary text-decoration-none">Terms of Service</a> and <a href="#" class="text-primary text-decoration-none">Privacy Policy</a>
                </label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-gradient-primary w-100 py-3 fw-bold shadow-sm" style="font-size: 16px;">
                Create Account <i class="bi bi-arrow-right ms-2"></i>
            </button>
        </form>

        <div class="text-center mt-5">
            <p class="text-secondary mb-0">
                Already have an account? <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none">Sign In</a>
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
