@extends('layouts.home')

@section('title', 'NRI Property Services')

@section('content')
<!-- Hero Section -->
<div class="position-relative py-5 bg-gradient-primary text-white text-center">
    <div class="container py-5">
        <h1 class="display-4 fw-bold mb-3">NRI Property Services</h1>
        <p class="lead mb-0 opacity-75">Manage your property investments from anywhere in the world</p>
    </div>
    <div class="position-absolute bottom-0 start-0 w-100 overflow-hidden" style="line-height: 0;">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none" style="position: relative; display: block; width: calc(100% + 1.3px); height: 60px;">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" fill="#ffffff"></path>
        </svg>
    </div>
</div>

<div class="container py-5">
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Tabs for Selling and Maintenance -->
    <div class="row justify-content-center mb-5">
        <div class="col-lg-8">
            <ul class="nav nav-tabs nav-fill border-bottom-0 mb-4" id="nriTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active fw-bold" id="selling-tab" data-bs-toggle="tab" data-bs-target="#selling" type="button" role="tab" aria-controls="selling" aria-selected="true">
                        <i class="bi bi-cash-coin me-2"></i>Sell Your Property
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold" id="maintenance-tab" data-bs-toggle="tab" data-bs-target="#maintenance" type="button" role="tab" aria-controls="maintenance" aria-selected="false">
                        <i class="bi bi-tools me-2"></i>Property Maintenance
                    </button>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="nriTabContent">
                <!-- Selling Property Form -->
                <div class="tab-pane fade show active" id="selling" role="tabpanel" aria-labelledby="selling-tab">
                    <div class="card border-0 shadow-lg">
                        <div class="card-body p-4 p-md-5">
                            <h3 class="fw-bold mb-4">
                                <i class="bi bi-house-fill text-danger me-2"></i>Sell Your Property
                            </h3>
                            <p class="text-secondary mb-4">Fill out the form below and our team will help you list and sell your property at the best price.</p>

                            <form action="{{ route('nri.submit') }}" method="POST">
                                @csrf
                                <input type="hidden" name="form_type" value="selling">

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="selling_name" name="name" placeholder="Your Full Name" required>
                                            <label for="selling_name">Full Name *</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="email" class="form-control" id="selling_email" name="email" placeholder="Your Email" required>
                                            <label for="selling_email">Email Address *</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="tel" class="form-control" id="selling_phone" name="phone" placeholder="Your Phone" required>
                                            <label for="selling_phone">Phone Number *</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <select class="form-select" id="selling_type" name="property_type" required>
                                                <option value="">Select Property Type</option>
                                                <option value="plot">Plot</option>
                                                <option value="flat">Flat</option>
                                                <option value="house">House</option>
                                                <option value="agricultural">Agricultural Land</option>
                                                <option value="commercial">Commercial</option>
                                                <option value="other">Other</option>
                                            </select>
                                            <label for="selling_type">Property Type *</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="selling_location" name="property_location" placeholder="Property Location">
                                            <label for="selling_location">Property Location / Address</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea class="form-control" id="selling_message" name="message" placeholder="Tell us about your property" style="height: 120px"></textarea>
                                            <label for="selling_message">Property Details</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-danger btn-lg w-100">
                                            <i class="bi bi-check-circle me-2"></i>Submit Selling Request
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Maintenance Property Form -->
                <div class="tab-pane fade" id="maintenance" role="tabpanel" aria-labelledby="maintenance-tab">
                    <div class="card border-0 shadow-lg">
                        <div class="card-body p-4 p-md-5">
                            <h3 class="fw-bold mb-4">
                                <i class="bi bi-tools text-warning me-2"></i>Property Maintenance
                            </h3>
                            <p class="text-secondary mb-4">Need help maintaining your property? Our team offers comprehensive maintenance and property management services for NRI property owners.</p>

                            <form action="{{ route('nri.submit') }}" method="POST">
                                @csrf
                                <input type="hidden" name="form_type" value="maintenance">

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="maintenance_name" name="name" placeholder="Your Full Name" required>
                                            <label for="maintenance_name">Full Name *</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="email" class="form-control" id="maintenance_email" name="email" placeholder="Your Email" required>
                                            <label for="maintenance_email">Email Address *</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="tel" class="form-control" id="maintenance_phone" name="phone" placeholder="Your Phone" required>
                                            <label for="maintenance_phone">Phone Number *</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <select class="form-select" id="maintenance_type" name="property_type" required>
                                                <option value="">Select Property Type</option>
                                                <option value="plot">Plot</option>
                                                <option value="flat">Flat</option>
                                                <option value="house">House</option>
                                                <option value="agricultural">Agricultural Land</option>
                                                <option value="commercial">Commercial</option>
                                            </select>
                                            <label for="maintenance_type">Property Type *</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="maintenance_location" name="property_location" placeholder="Property Location">
                                            <label for="maintenance_location">Property Location / Address</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea class="form-control" id="maintenance_message" name="message" placeholder="Describe maintenance needs" style="height: 120px"></textarea>
                                            <label for="maintenance_message">Maintenance Requirements / Issues *</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-warning btn-lg w-100">
                                            <i class="bi bi-check-circle me-2"></i>Submit Maintenance Request
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Benefits Section -->
    <div class="row g-4 mt-5">
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 text-center shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="fs-1 text-danger mb-3">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Trusted Service</h5>
                    <p class="text-secondary mb-0">Expert handling of all your property needs with complete transparency.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 text-center shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="fs-1 text-success mb-3">
                        <i class="bi bi-telephone-fill"></i>
                    </div>
                    <h5 class="fw-bold mb-2">24/7 Support</h5>
                    <p class="text-secondary mb-0">Round-the-clock assistance for all your queries and concerns.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 text-center shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="fs-1 text-primary mb-3">
                        <i class="bi bi-globe"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Global Reach</h5>
                    <p class="text-secondary mb-0">Serving NRI clients worldwide with local expertise.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 text-center shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="fs-1 text-info mb-3">
                        <i class="bi bi-lightning-charge"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Quick Response</h5>
                    <p class="text-secondary mb-0">Fast processing of your requests with regular updates.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Info Section -->
    <div class="row mt-5 pt-5 border-top">
        <div class="col-md-4 text-center mb-4 mb-md-0">
            <h5 class="fw-bold mb-3">Call Us</h5>
            <a href="tel:+919445002020" class="text-danger text-decoration-none fs-5 fw-bold">+91 944 500 2020</a>
            <p class="text-secondary mt-2">Mon - Fri: 9 AM - 6 PM IST</p>
        </div>
        <div class="col-md-4 text-center mb-4 mb-md-0">
            <h5 class="fw-bold mb-3">Email Us</h5>
            <a href="mailto:info@2020homes.com" class="text-danger text-decoration-none fs-5 fw-bold">info@2020homes.com</a>
            <p class="text-secondary mt-2">We'll respond within 24 hours</p>
        </div>
        <div class="col-md-4 text-center">
            <h5 class="fw-bold mb-3">WhatsApp</h5>
            <a href="https://wa.me/919445002020" class="text-danger text-decoration-none fs-5 fw-bold" target="_blank">Chat with us</a>
            <p class="text-secondary mt-2">Quick support available</p>
        </div>
    </div>
</div>

<style>
    .nav-link {
        color: #2c3e50 !important;
        border-bottom: 3px solid transparent;
        transition: all 0.3s ease;
        padding: 1rem;
    }

    .nav-link:hover {
        color: #dc3545 !important;
        border-bottom-color: #dc3545 !important;
    }

    .nav-link.active {
        color: #dc3545 !important;
        border-bottom-color: #dc3545 !important;
        background-color: transparent;
    }

    .card {
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12) !important;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }
</style>

@endsection
