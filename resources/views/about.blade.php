@extends('layouts.home')

@section('title', 'About Us')

@section('content')
<!-- Hero Section -->
<div class="position-relative py-5 bg-gradient-primary text-white text-center">
    <div class="container py-5">
        <h1 class="display-4 fw-bold mb-3">About 2020Homes</h1>
        <p class="lead mb-0 opacity-75">Building dreams, one property at a time.</p>
    </div>
    <!-- Decorative shape -->
    <div class="position-absolute bottom-0 start-0 w-100 overflow-hidden" style="line-height: 0;">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none" style="position: relative; display: block; width: calc(100% + 1.3px); height: 60px;">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" fill="#ffffff"></path>
        </svg>
    </div>
</div>

<div class="container py-5">
    <div class="row align-items-center g-5 mb-5">
        <div class="col-lg-6">
            <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Our Office" class="img-fluid rounded-4 shadow-lg">
        </div>
        <div class="col-lg-6">
            <h6 class="text-primary fw-bold text-uppercase ls-md">Our Story</h6>
            <h2 class="fw-bold mb-4">We're Changing the Way You Buy Real Estate</h2>
            <p class="text-secondary mb-4">Founded in 2020, 2020Homes has quickly established itself as a trusted name in the real estate market. We noticed a gap in the market for a transparent, customer-centric approach to property buying and selling.</p>
            <p class="text-secondary mb-4">Our mission is to simplify the real estate process by providing verified listings, transparent pricing, and expert guidance at every step.</p>

            <div class="row g-4 mt-2">
                <div class="col-sm-6">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 bg-primary bg-opacity-10 p-3 rounded-circle text-primary">
                            <i class="bi bi-check-circle-fill fs-4"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="fw-bold mb-1">Verified Listings</h5>
                            <p class="text-secondary small mb-0">100% Checked properties</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 bg-primary bg-opacity-10 p-3 rounded-circle text-primary">
                            <i class="bi bi-people-fill fs-4"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="fw-bold mb-1">Expert Support</h5>
                            <p class="text-secondary small mb-0">Guidance at every step</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row text-center mt-5">
        <div class="col-md-4 mb-4">
            <h2 class="display-4 fw-bold text-primary">500+</h2>
            <p class="text-secondary">Properties Sold</p>
        </div>
        <div class="col-md-4 mb-4">
            <h2 class="display-4 fw-bold text-primary">1200+</h2>
            <p class="text-secondary">Happy Customers</p>
        </div>
        <div class="col-md-4 mb-4">
            <h2 class="display-4 fw-bold text-primary">50+</h2>
            <p class="text-secondary">Awards Won</p>
        </div>
    </div>
</div>
@endsection
