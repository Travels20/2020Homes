@extends('layouts.home')

@section('title', '2020Homes')

@section('content')
    <!-- Hero Section with Modern Bootstrap 5 Carousel -->
    {{-- <section class="hero-section position-relative overflow-hidden">
          <div id="heroCarousel" class="carousel slide carousel-fade h-100 w-100 position-absolute top-0 start-0" data-bs-ride="carousel" data-bs-interval="5000" data-bs-pause="false">
            @php
                $banners = \App\Models\SiteSetting::get('banners');
                $banners = $banners ? json_decode($banners) : [];
            @endphp

            @if(count($banners) > 1)
                <div class="carousel-indicators position-absolute bottom-0 start-50 translate-middle-x mb-4">
                    @foreach($banners as $index => $banner)
                        <button type="button"
                                data-bs-target="#heroCarousel"
                                data-bs-slide-to="{{ $index }}"
                                class="{{ $index === 0 ? 'active' : '' }}"
                                aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                                aria-label="Slide {{ $index + 1 }}"
                                style="width: 12px; height: 12px; border-radius: 50%; margin: 0 4px; border: 2px solid white;">
                        </button>
                    @endforeach
                </div>
            @endif

            <div class="carousel-inner h-100">
                @if(count($banners) > 0)
                    @foreach($banners as $index => $banner)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }} h-100">
                            <div class="hero-slide h-100 position-relative"
                                 style="background-image: url('{{ \Illuminate\Support\Facades\Storage::disk('s3')->url($banner) }}');
                                         background-size: cover;
                                         background-position: center;
                                         background-attachment: fixed;">
                                 <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0, 0, 0, 0.35);"></div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="carousel-item active h-100">
                        <div class="hero-slide h-100 position-relative"
                             style="background-image: url('{{ asset('images/bannerimage.webp') }}');
                                     background-size: cover;
                                     background-position: center;
                                     background-attachment: fixed;">
                             <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0, 0, 0, 0.35);"></div>
                        </div>
                    </div>
                @endif
            </div>

               @if(count($banners) > 1)
                <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark bg-opacity-50 rounded-circle p-3" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-dark bg-opacity-50 rounded-circle p-3" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            @endif
        </div>

           <div class="container position-relative z-3 py-5">
            <div class="row min-vh-100 align-items-center">
                <div class="col-lg-10 col-xl-8">

                    <h1 class="fw-bold text-white mb-4 hero-title-modern"
                        data-aos="fade-up" data-aos-delay="200">
                        Build Your Future, One Property at a Time.
                    </h1>

                       <p class="text-white mb-5 fs-5 hero-subtitle"
                       data-aos="fade-up" data-aos-delay="300">
                        Discover your dream property from our extensive collection of residential plots, luxury flats, and agricultural land across India.
                    </p>

                       <div class="hero-actions d-flex gap-3 flex-wrap" data-aos="fade-up" data-aos-delay="400">
                        <a href="{{ route('front.properties') }}"
                           class="btn btn-danger btn-lg px-5 py-3 rounded-pill fw-bold shadow-lg">
                            <i class="bi bi-search me-2"></i>Browse Properties
                        </a>
                        @auth
                            <a href="{{ route('dashboard') }}"
                               class="btn btn-light btn-lg px-5 py-3 rounded-pill fw-bold shadow-lg">
                                <i class="bi bi-plus-circle me-2"></i>Post Property Free
                            </a>
                        @else
                            <a href="{{ route('vendor.register.page') }}"
                               class="btn btn-light btn-lg px-5 py-3 rounded-pill fw-bold shadow-lg">
                                <i class="bi bi-plus-circle me-2"></i>Post Property Free
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>

          <div class="social-sidebar-vertical d-none d-lg-flex flex-column gap-3 py-4 px-3 align-items-center rounded-start position-absolute top-50 end-0 translate-middle-y z-3 shadow">
            <a href="#" class="text-white fs-5 text-decoration-none hover-scale" aria-label="Twitter">
                <i class="bi bi-twitter"></i>
            </a>
            <a href="#" class="text-white fs-5 text-decoration-none hover-scale" aria-label="Facebook">
                <i class="bi bi-facebook"></i>
            </a>
            <a href="#" class="text-white fs-5 text-decoration-none hover-scale" aria-label="Instagram">
                <i class="bi bi-instagram"></i>
            </a>
            <a href="#" class="text-white fs-5 text-decoration-none hover-scale" aria-label="YouTube">
                <i class="bi bi-youtube"></i>
            </a>
        </div>
    </section> --}}

    <!-- Full Width Video Banner Section -->
    <section class="video-banner-section w-100 position-relative overflow-hidden" style="min-height: 600px; background: #000;">
        <video
            autoplay
            loop
            muted
            playsinline
            class="w-100 h-100 position-absolute top-0 start-0"
            style="object-fit: cover; object-position: center;">
            <source src="{{ asset('images/jll-webm.webm') }}" type="video/webm"/>
            <source src="{{ asset('images/jll-mp4.mp4') }}" type="video/mp4"/>
            Your browser does not support the video tag.
        </video>

        <!-- Dark Overlay for Better Text Visibility -->
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.40); z-index: 1;"></div>

        <!-- Video Banner Content Overlay -->
        <div class="position-absolute top-50 start-50 translate-middle text-center text-white w-100 px-3" style="z-index: 2;">
            <div class="container">
                <h2 class="fw-bold display-5 mb-3">Find Your Perfect Property in Chennai</h2>
                <p class="lead mb-4 opacity-90">Your trusted partner for finding dream properties</p>
                <a href="{{ route('front.properties') }}" class="btn btn-danger btn-lg rounded-pill px-5 py-3 fw-bold shadow-lg">
                    <i class="bi bi-search me-2"></i>Explore Properties
                </a>
            </div>
        </div>

        <div class="social-sidebar-vertical d-none d-lg-flex flex-column gap-3 py-4 px-3 align-items-center rounded-start position-absolute top-50 end-0 translate-middle-y z-3 shadow">
            <a href="#" class="text-white fs-5 text-decoration-none hover-scale" aria-label="Twitter">
                <i class="bi bi-twitter"></i>
            </a>
            <a href="#" class="text-white fs-5 text-decoration-none hover-scale" aria-label="Facebook">
                <i class="bi bi-facebook"></i>
            </a>
            <a href="#" class="text-white fs-5 text-decoration-none hover-scale" aria-label="Instagram">
                <i class="bi bi-instagram"></i>
            </a>
            <a href="#" class="text-white fs-5 text-decoration-none hover-scale" aria-label="YouTube">
                <i class="bi bi-youtube"></i>
            </a>
        </div>
    </section>

    {{-- Separate property sections on Home page --}}
    @if(($plotProperties ?? collect())->count() > 0)
        <section class="py-5 bg-light" id="plots">
            <div class="container">
                <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-2">
                    <div>
                        <h2 class="fw-bold mb-1">Plots</h2>
                        <p class="text-secondary mb-0">Verified residential plots</p>
                    </div>
                    <a href="{{ route('front.properties', ['type' => 'plot']) }}" class="btn btn-outline-danger rounded-pill fw-bold">
                        View All Plots <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>

                <div class="row g-4">
                    @foreach($plotProperties as $property)
                        <div class="col-lg-4 col-md-6">
                            <div class="card h-100 glass-card border-0 hover-lift transition-all" style="cursor: pointer;" onclick="window.location='{{ route('property.show', $property->slug) }}'">
                                <div class="position-relative">
                                    <img src="{{ $property->feature_image_url }}"
                                         class="card-img-top"
                                         alt="{{ $property->title }}"
                                         style="height: 250px; object-fit: cover;"
                                         onerror="this.src='https://images.unsplash.com/photo-1560518883-ce09059eeffa?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'">
                                    <div class="position-absolute top-0 start-0 m-3">
                                        <span class="badge bg-white text-dark shadow-sm px-3 py-2 rounded-pill fw-bold text-capitalize">plot</span>
                                    </div>
                                    <div class="position-absolute top-0 end-0 m-3">
                                        <span class="badge bg-gradient-primary shadow-sm px-3 py-2 rounded-pill fw-bold text-capitalize">{{ $property->listing_type }}</span>
                                    </div>
                                </div>
                                <div class="card-body p-4">
                                    <h5 class="card-title fw-bold mb-1 text-truncate">{{ $property->title }}</h5>
                                    <p class="text-secondary small mb-3 text-truncate">
                                        <i class="bi bi-geo-alt-fill me-1 text-danger"></i> {{ $property->city }}, {{ $property->city_area }}
                                    </p>
                                    <h4 class="text-danger fw-bold mb-3">₹{{ number_format($property->price / 100000, 2) }} Lakhs</h4>
                                    <a href="{{ route('property.show', $property->slug) }}" class="btn btn-outline-danger w-100 fw-bold">View Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if(($flatProperties ?? collect())->count() > 0)
        <section class="py-5 bg-light" id="flats">
            <div class="container">
                <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-2">
                    <div>
                        <h2 class="fw-bold mb-1">Flats</h2>
                        <p class="text-secondary mb-0">Verified flats and apartments</p>
                    </div>
                    <a href="{{ route('front.properties', ['type' => 'flat']) }}" class="btn btn-outline-danger rounded-pill fw-bold">
                        View All Flats <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>

                <div class="row g-4">
                    @foreach($flatProperties as $property)
                        <div class="col-lg-4 col-md-6">
                            <div class="card h-100 glass-card border-0 hover-lift transition-all" style="cursor: pointer;" onclick="window.location='{{ route('property.show', $property->slug) }}'">
                                <div class="position-relative">
                                    <img src="{{ $property->feature_image_url }}"
                                         class="card-img-top"
                                         alt="{{ $property->title }}"
                                         style="height: 250px; object-fit: cover;"
                                         onerror="this.src='https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'">
                                    <div class="position-absolute top-0 start-0 m-3">
                                        <span class="badge bg-white text-dark shadow-sm px-3 py-2 rounded-pill fw-bold text-capitalize">flat</span>
                                    </div>
                                    <div class="position-absolute top-0 end-0 m-3">
                                        <span class="badge bg-gradient-primary shadow-sm px-3 py-2 rounded-pill fw-bold text-capitalize">{{ $property->listing_type }}</span>
                                    </div>
                                </div>
                                <div class="card-body p-4">
                                    <h5 class="card-title fw-bold mb-1 text-truncate">{{ $property->title }}</h5>
                                    <p class="text-secondary small mb-3 text-truncate">
                                        <i class="bi bi-geo-alt-fill me-1 text-danger"></i> {{ $property->city }}, {{ $property->city_area }}
                                    </p>
                                    <h4 class="text-danger fw-bold mb-3">₹{{ number_format($property->price / 100000, 2) }} Lakhs</h4>
                                    <a href="{{ route('property.show', $property->slug) }}" class="btn btn-outline-danger w-100 fw-bold">View Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if(($agricultureProperties ?? collect())->count() > 0)
        <section class="py-5 bg-light" id="agriculture">
            <div class="container">
                <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-2">
                    <div>
                        <h2 class="fw-bold mb-1">Agricultural Land</h2>
                        <p class="text-secondary mb-0">Verified agricultural land listings</p>
                    </div>
                    <a href="{{ route('front.properties', ['type' => 'agriculture']) }}" class="btn btn-outline-danger rounded-pill fw-bold">
                        View All <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>

                <div class="row g-4">
                    @foreach($agricultureProperties as $property)
                        <div class="col-lg-4 col-md-6">
                            <div class="card h-100 glass-card border-0 hover-lift transition-all" style="cursor: pointer;" onclick="window.location='{{ route('property.show', $property->slug) }}'">
                                <div class="position-relative">
                                    <img src="{{ $property->feature_image_url }}"
                                         class="card-img-top"
                                         alt="{{ $property->title }}"
                                         style="height: 250px; object-fit: cover;"
                                         onerror="this.src='https://images.unsplash.com/photo-1500382017468-9049fed747ef?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'">
                                    <div class="position-absolute top-0 start-0 m-3">
                                        <span class="badge bg-white text-dark shadow-sm px-3 py-2 rounded-pill fw-bold text-capitalize">agriculture</span>
                                    </div>
                                    <div class="position-absolute top-0 end-0 m-3">
                                        <span class="badge bg-gradient-primary shadow-sm px-3 py-2 rounded-pill fw-bold text-capitalize">{{ $property->listing_type }}</span>
                                    </div>
                                </div>
                                <div class="card-body p-4">
                                    <h5 class="card-title fw-bold mb-1 text-truncate">{{ $property->title }}</h5>
                                    <p class="text-secondary small mb-3 text-truncate">
                                        <i class="bi bi-geo-alt-fill me-1 text-danger"></i> {{ $property->city }}, {{ $property->city_area }}
                                    </p>
                                    <h4 class="text-danger fw-bold mb-3">₹{{ number_format($property->price / 100000, 2) }} Lakhs</h4>
                                    <a href="{{ route('property.show', $property->slug) }}" class="btn btn-outline-danger w-100 fw-bold">View Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Property Types Section -->
    {{-- <section class="py-5 bg-light" id="property-categories">
        <div class="container">
            <div class="text-center mb-4">
                <h2 class="fw-bold mb-2 text-danger">Featured Properties</h2>
                <p class="text-secondary mb-4">{{ \App\Models\SiteSetting::get('site_tagline', 'Choose your plot from our verified listings') }}</p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card glass-card border-0 h-100 property-card hover-lift transition-all" style="cursor: pointer;" onclick="window.location='{{ route('front.properties', ['type' => 'plot']) }}'">
                        <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=400&h=300&fit=crop"
                             class="card-img-top" alt="Plots">
                        <div class="card-body text-center p-4">
                            <h4 class="fw-bold mb-2">Residential Plots</h4>
                            <p class="text-secondary small">Build your dream home on premium plots</p>
                            <a href="{{ route('front.properties', ['type' => 'plot']) }}" class="btn btn-gradient-primary mt-2">Explore Plots</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card glass-card border-0 h-100 property-card hover-lift transition-all" style="cursor: pointer;" onclick="window.location='{{ route('front.properties', ['type' => 'flat']) }}'">
                        <img src="https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=400&h=300&fit=crop"
                             class="card-img-top" alt="Flats">
                        <div class="card-body text-center p-4">
                            <h4 class="fw-bold mb-2">Luxury Flats</h4>
                            <p class="text-secondary small">Modern apartments with world-class amenities</p>
                            <a href="{{ route('front.properties', ['type' => 'flat']) }}" class="btn btn-gradient-primary mt-2">Explore Flats</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card glass-card border-0 h-100 property-card hover-lift transition-all" style="cursor: pointer;" onclick="window.location='{{ route('front.properties', ['type' => 'agriculture']) }}'">
                        <img src="https://images.unsplash.com/photo-1500382017468-9049fed747ef?w=400&h=300&fit=crop"
                             class="card-img-top" alt="Agriculture">
                        <div class="card-body text-center p-4">
                            <h4 class="fw-bold mb-2">Agricultural Land</h4>
                            <p class="text-secondary small">Fertile land for farming and agriculture</p>
                            <a href="{{ route('front.properties', ['type' => 'agriculture']) }}" class="btn btn-gradient-primary mt-2">Explore Farmlands</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

        <!-- Featured Properties Section -->
@if($featuredProperties->count() > 0)
<section class="py-5 bg-light">
    <div class="container">
        <!-- Header with Location Filters -->
        <div class="text-center mb-4">
            <h2 class="fw-bold mb-2 text-danger">Your Home. Your Dream. Your Choice</h2>
            <p class="text-secondary mb-4">Choose your plot from India's Largest Plotted Real Ecity_area Developer</p>
            <!-- Location Tabs -->
            <div class="d-flex gap-3 flex-wrap location-tabs mb-4">
                <a href="{{ route('front.properties', ['city' => 'Chennai']) }}">Chennai</a>
                <span>|</span>
                <a href="{{ route('front.properties', ['city' => 'Coimbatore']) }}">Coimbatore</a>
                <span>|</span>
                <a href="{{ route('front.properties', ['city' => 'Trichy']) }}">Trichy</a>
                <span>|</span>
                <a href="{{ route('front.properties') }}">Other Locations</a>
            </div>

        </div>

        <div class="row g-4">
            @foreach($featuredProperties as $property)
            <div class="col-lg-4 col-md-6">
                <div class="property-card card h-100 border-0 shadow-sm overflow-hidden" onclick="window.location='{{ route('property.show', $property->slug) }}'" style="cursor: pointer;">
                    <div class="position-relative property-image-wrapper">
                        @php
                            $imgSrc = $property->feature_image_url;
                        @endphp

                        <img src="{{ $imgSrc }}"
                             class="card-img-top property-image"
                             alt="{{ $property->title }}"
                             onerror="this.src='https://images.unsplash.com/photo-1560518883-ce09059eeffa?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'">

                          <div class="position-absolute top-0 end-0">
                            <div class="status-badge bg-danger text-white px-3 py-2 fw-bold">
                                {{ strtoupper($property->listing_type) }}
                                </div>
                        </div>

                         <div class="position-absolute bottom-0 start-0 m-3">
                            <div class="bg-danger text-white px-3 py-2 rounded-3 fw-bold d-flex align-items-center gap-2">
                                <i class="bi bi-geo-alt-fill"></i>
                                <span>{{ $property->city }}</span>
                            </div>
                        </div>
                    </div>

                      <div class="card-body p-3">
                        <h5 class="card-title fw-bold mb-2 text-truncate" style="font-size: 1.1rem;">
                            {{ $property->title }}
                        </h5>

                        <div class="row g-2 mb-3">
                           <div class="col-6">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-arrows-angle-expand text-secondary"></i>
                                    <div>
                                        <small class="text-secondary d-block" style="font-size: 0.75rem;">Area</small>
                                        <span class="fw-bold" style="font-size: 0.85rem;">{{ $property->area }} {{ $property->area_unit }}</span>
                                    </div>
                                </div>
                            </div>

                            @if($property->property_type == 'flat')
                               <div class="col-6">
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="bi bi-door-closed text-secondary"></i>
                                        <div>
                                            <small class="text-secondary d-block" style="font-size: 0.75rem;">Beds/Baths</small>
                                            <span class="fw-bold" style="font-size: 0.85rem;">{{ $property->bedrooms ?? 0 }} & {{ $property->bathrooms ?? 0 }}</span>
                                        </div>
                                    </div>
                                </div>
                            @else
                                 <div class="col-6">
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="bi bi-building text-secondary"></i>
                                        <div>
                                            <small class="text-secondary d-block" style="font-size: 0.75rem;">Type</small>
                                            <span class="fw-bold text-capitalize" style="font-size: 0.85rem;">{{ $property->property_type }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif

                             <div class="col-6">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-currency-rupee text-secondary"></i>
                                    <div>
                                        <small class="text-secondary d-block" style="font-size: 0.75rem;">Price</small>
                                        <span class="fw-bold text-danger" style="font-size: 0.85rem;">₹ {{ number_format($property->price / 100000, 2) }} L</span>
                                    </div>
                                </div>
                            </div>

                              <div class="col-6">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-check-circle text-secondary"></i>
                                    <div>
                                        <small class="text-secondary d-block" style="font-size: 0.75rem;">Status</small>
                                        <span class="fw-bold text-success" style="font-size: 0.85rem;">{{ $property->status ?? 'Available' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                         <div class="row g-2">
                            <div class="col-6">
                                <button class="btn btn-outline-danger w-100 btn-sm fw-bold rounded-pill">
                                    {{ ucfirst($property->property_type) }}
                                </button>
                            </div>
                            <div class="col-6">
                                <a href="{{ route('property.show', $property->slug) }}" class="btn btn-danger w-100 btn-sm fw-bold rounded-pill">
                                    Explore Property
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

          <div class="text-center mt-5">
            <a href="{{ route('front.properties') }}" class="btn btn-lg btn-danger px-5 rounded-pill fw-bold">
                View All Properties
                <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>
@endif


    <!-- Features Section -->
<section class="py-5" >
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3">Why Choose 2020Homes?</h2>
            <p class="text-white-50">We provide the best real ecity_area solutions for your needs</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-lg feature-box text-center p-4">
                    <div class="feature-icon mx-auto mb-3">
                        <i class="bi bi-building"></i>
                    </div>
                    <h4 class="mb-3">Wide Range of Properties</h4>
                    <p class="text-secondary">From luxury plots to agriculture land, find exactly what you need</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-lg feature-box text-center p-4">
                    <div class="feature-icon mx-auto mb-3" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h4 class="mb-3">Verified Listings</h4>
                    <p class="text-secondary">All properties are verified for authenticity and legal compliance</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-lg feature-box text-center p-4">
                    <div class="feature-icon mx-auto mb-3" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                        <i class="bi bi-headset"></i>
                    </div>
                    <h4 class=" mb-3">24/7 Support</h4>
                    <p class="text-secondary">Our team is always available to assist you with your queries</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-lg feature-box text-center p-4">
                    <div class="feature-icon mx-auto mb-3" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                        <i class="bi bi-currency-rupee"></i>
                    </div>
                    <h4 class="mb-3">Best Prices</h4>
                    <p class="text-secondary">Competitive pricing with transparent transaction processes</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-lg feature-box text-center p-4">
                    <div class="feature-icon mx-auto mb-3" style="background: linear-gradient(135deg, #ff0844 0%, #ffb199 100%);">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>
                    <h4 class=" mb-3">Investment Advice</h4>
                    <p class="text-secondary">Expert guidance for making smart real ecity_area investments</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-lg feature-box text-center p-4">
                    <div class="feature-icon mx-auto mb-3" style="background: linear-gradient(135deg, #a18cd1 0%, #fbc2eb 100%);">
                        <i class="bi bi-geo-alt"></i>
                    </div>
                    <h4 class=" mb-3">Prime Locations</h4>
                    <p class="text-secondary">Properties in the best locations across NCR region</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Property video Section -->
<section class="py-5 bg-light" id="plot-offer">
    <div class="container px-0">
        <div class="row g-0">
            <div class="col-12">
                <div class="card border-0 text-white property-card overflow-hidden">

                    <!-- Responsive YouTube Embed -->
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/lETjlaT-UeA?rel=0&modestbranding=1"
                                title="Residential Plots - 2020Homes"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>


<!-- Top Real Ecity_area Partner and Agent -->
<section class="py-5 bg-white" id="partners">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3 text-danger">Top Real Ecity_area Agents in Chennai</h2>
        </div>

        <div class="row g-4 justify-content-center justify-content-center">
            <div class="col-12 text-center">
                    <img src="{{ asset('images/partners.jpg') }}" alt="Top Real Ecity_area Agents in Chennai" class="img-fluid rounded-4 shadow-lg">
               </div>
        </div>

        {{-- <div class="row g-4 align-items-center justify-content-center">
              <div class="col-6 col-md-4 col-lg-2 text-center">
                <div class="partner-logo p-3">
                    <img src="{{ asset('images/partners/dlf.jpg') }}" alt="DLF Building India" class="img-fluid" style="max-height: 80px;">
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 text-center">
                <div class="partner-logo p-3">
                    <img src="{{ asset('images/partners/arun-excello.png') }}" alt="Arun Excello" class="img-fluid" style="max-height: 80px;">
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 text-center">
                <div class="partner-logo p-3">
                    <img src="{{ asset('images/partners/prestige.png') }}" alt="Prestige Group" class="img-fluid" style="max-height: 80px;">
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 text-center">
                <div class="partner-logo p-3">
                    <img src="{{ asset('images/partners/hiranandani.png') }}" alt="Hiranandani" class="img-fluid" style="max-height: 80px;">
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 text-center">
                <div class="partner-logo p-3">
                    <img src="{{ asset('images/partners/urbann.png') }}" alt="Brigade" class="img-fluid" style="max-height: 80px;">
                </div>
            </div>
        </div>

        <div class="row g-4 align-items-center justify-content-center mt-2">
             <div class="col-6 col-md-4 col-lg-2 text-center">
                <div class="partner-logo p-3">
                    <img src="{{ asset('images/partners/ansals.jpg') }}" alt="Ansals API" class="img-fluid" style="max-height: 80px;">
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 text-center">
                <div class="partner-logo p-3">
                    <img src="{{ asset('images/partners/sobha.png') }}" alt="Sobha" class="img-fluid" style="max-height: 80px;">
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 text-center">
                <div class="partner-logo p-3">
                    <img src="{{ asset('images/partners/raheja.png') }}" alt="K Raheja Corp" class="img-fluid" style="max-height: 80px;">
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 text-center">
                <div class="partner-logo p-3">
                    <img src="{{ asset('images/partners/casagrand.png') }}" alt="Casagrand" class="img-fluid" style="max-height: 80px;">
                </div>
            </div>
        </div> --}}
    </div>
</section>


{{-- Testimonial Section --}}
<section class="py-5 bg-light" id="testimonials">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3 text-danger">Happy Client Google Review</h2>
        </div>

        <!-- Google Reviews Banner -->
        <div class="google-reviews-banner position-relative rounded-4 overflow-hidden mb-4" style="background: linear-gradient(135deg, #2d7a4f 0%, #4caf50 100%); min-height: 300px;">

            <!-- Background Icons -->
            <div class="position-absolute top-0 start-0 w-100 h-100 opacity-25">
                <i class="fab fa-google position-absolute" style="font-size: 80px; top: 20px; left: 30px;"></i>
                <i class="fas fa-map-marker-alt position-absolute" style="font-size: 60px; top: 30px; right: 40px;"></i>
                <i class="fas fa-home position-absolute" style="font-size: 70px; bottom: 40px; left: 50px;"></i>
                <i class="fab fa-linkedin position-absolute" style="font-size: 65px; top: 50%; left: 15%;"></i>
                <i class="fas fa-building position-absolute" style="font-size: 75px; bottom: 30px; right: 60px;"></i>
            </div>

            <!-- Main Content -->
            <div class="position-relative z-1 p-4">
                <div class="row align-items-center">
                    <!-- Left Side - Title -->
                    <div class="col-md-3">
                        <h2 class="text-white fw-bold display-5 mb-0">Google Reviews</h2>
                        <p class="text-white opacity-75 mb-0">for Real Ecity_area Agents</p>
                    </div>

                    <!-- Right Side - Review Cards -->
                    <div class="col-md-9">
                        <div class="row g-3">
                            <!-- Review Card 1 -->
                            <div class="col-md-6 col-lg-3">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body p-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="https://ui-avatars.com/api/?name=Anjali+Saxena&background=random"
                                                 alt="Anjali Saxena" class="rounded-circle me-2" width="40" height="40">
                                            <div>
                                                <h6 class="mb-0 fw-bold small">Anjali Saxena</h6>
                                                <div class="text-warning small">
                                                    ★★★★★
                                                </div>
                                            </div>
                                        </div>
                                        <p class="small text-muted mb-2" style="font-size: 0.75rem; line-height: 1.3;">
                                            Reliable partner! From property search to documentation, everything was smooth and transparent.
                                        </p>
                                        <img src="https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_92x30dp.png"
                                             alt="Google" height="15">
                                    </div>
                                </div>
                            </div>

                            <!-- Review Card 2 - Featured with Rating -->
                            <div class="col-md-6 col-lg-3">
                                <div class="card border-0 shadow-sm h-100 position-relative">
                                    <div class="position-absolute top-0 end-0 m-2">
                                        <div class="bg-white rounded px-2 py-1 d-flex align-items-center shadow-sm">
                                            <span class="fw-bold me-1">5.0</span>
                                            <span class="text-warning">★★★★★</span>
                                        </div>
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="https://ui-avatars.com/api/?name=Ravi+Kumar&background=random"
                                                 alt="Ravi Kumar" class="rounded-circle me-2" width="40" height="40">
                                            <div>
                                                <h6 class="mb-0 fw-bold small">Ravi Kumar</h6>
                                                <div class="text-warning small">
                                                    ★★★★★
                                                </div>
                                            </div>
                                        </div>
                                        <p class="small text-muted mb-2" style="font-size: 0.75rem; line-height: 1.3;">
                                            Outstanding service! They helped me find my dream home in Chennai. Professional, knowledgeable, and always helpful.
                                        </p>
                                        <img src="https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_92x30dp.png"
                                             alt="Google" height="15">
                                    </div>
                                </div>
                            </div>

                            <!-- Review Card 3 -->
                            <div class="col-md-6 col-lg-3">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body p-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="https://ui-avatars.com/api/?name=Ashwin+Khanna&background=random"
                                                 alt="Ashwin Khanna" class="rounded-circle me-2" width="40" height="40">
                                            <div>
                                                <h6 class="mb-0 fw-bold small">Ashwin Khanna</h6>
                                                <div class="text-warning small">
                                                    ★★★★★
                                                </div>
                                            </div>
                                        </div>
                                        <p class="small text-muted mb-2" style="font-size: 0.75rem; line-height: 1.3;">
                                            Selling my house was stress-free with this team. Great market knowledge and excellent negotiation skills!
                                        </p>
                                        <img src="https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_92x30dp.png"
                                             alt="Google" height="15">
                                    </div>
                                </div>
                            </div>

                            <!-- Review Card 4 -->
                            <div class="col-md-6 col-lg-3">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body p-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="https://ui-avatars.com/api/?name=Priya+Sharma&background=random"
                                                 alt="Priya Sharma" class="rounded-circle me-2" width="40" height="40">
                                            <div>
                                                <h6 class="mb-0 fw-bold small">Priya Sharma</h6>
                                                <div class="text-warning small">
                                                    ★★★★★
                                                </div>
                                            </div>
                                        </div>
                                        <p class="small text-muted mb-2" style="font-size: 0.75rem; line-height: 1.3;">
                                            Best real ecity_area agents in Chennai! Quick responses and handled everything professionally.
                                        </p>
                                        <img src="https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_92x30dp.png"
                                             alt="Google" height="15">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Bottom Row Reviews -->
                        <div class="row g-3 mt-1">
                            <!-- Review Card 5 -->
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="https://ui-avatars.com/api/?name=Deepak+Mehta&background=random"
                                                 alt="Deepak Mehta" class="rounded-circle me-2" width="40" height="40">
                                            <div>
                                                <h6 class="mb-0 fw-bold small">Deepak Mehta</h6>
                                                <div class="text-warning small">★★★★★</div>
                                            </div>
                                        </div>
                                        <p class="small text-muted mb-2" style="font-size: 0.75rem;">
                                            Very impressed with their service. Made my first property purchase smooth and hassle-free!
                                        </p>
                                        <img src="https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_92x30dp.png"
                                             alt="Google" height="15">
                                    </div>
                                </div>
                            </div>

                            <!-- Review Card 6 -->
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="https://ui-avatars.com/api/?name=Sneha+Reddy&background=random"
                                                 alt="Sneha Reddy" class="rounded-circle me-2" width="40" height="40">
                                            <div>
                                                <h6 class="mb-0 fw-bold small">Sneha Reddy</h6>
                                                <div class="text-warning small">★★★★★</div>
                                            </div>
                                        </div>
                                        <p class="small text-muted mb-2" style="font-size: 0.75rem;">
                                            Highly recommend! They understood exactly what I needed and delivered beyond expectations.
                                        </p>
                                        <img src="https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_92x30dp.png"
                                             alt="Google" height="15">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Appointment Section -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="row g-4 align-items-stretch">
            <!-- Left Side - Form -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-lg p-2 p-md-3 h-100">
                    <div class="mb-4">
                        <h2 class="fw-bold mb-3">Appointment for Booking</h2>
                        <p class="text-secondary mb-0">Get expert advice on buying or selling your property</p>
                    </div>

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
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

                    <form action="{{ route('appointment.store') }}" method="POST">
                        @csrf
                        <div class="row">
                        <div class="col-md-6 mb-2">
                            <label for="name" class="form-label">Your Name</label>
                            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter your full name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter your email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Enter your phone number" value="{{ old('phone') }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="preferred_date" class="form-label">Preferred Consultation Date</label>
                            <input type="date" id="preferred_date" name="preferred_date" class="form-control @error('preferred_date') is-invalid @enderror" value="{{ old('preferred_date') }}" required>
                            @error('preferred_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="message" class="form-label">Message (Optional)</label>
                            <textarea id="message" name="message" class="form-control" placeholder="Tell us more about your requirement" rows="3">{{ old('message') }}</textarea>
                        </div>
                        <div class=" d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg py-2 fw-bold">
                                <i class="bi bi-calendar-check me-2"></i>
                                Schedule Now
                            </button>
                        </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right Side - Map & Address -->
            <div class="col-lg-6">
                <div class="h-100 d-flex flex-column gap-4">
                    <!-- Map with Address Overlay -->
                    <div class="position-relative" style="height: 450px; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                        <!-- Map -->
                        <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3886.0044524827524!2d80.2707!3d13.0627!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a526f73a5a5a5a5%3A0x5a5a5a5a5a5a5a5a!2sChennai%2C%20Tamil%20Nadu!5e0!3m2!1sen!2sin!4v1234567890"
                                width="100%"
                                height="100%"
                                style="border:0; position: absolute; top: 0; left: 0;"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                        </iframe>

                        <!-- Address Overlay at Bottom Left -->
                        <div class="position-absolute bottom-0 start-0" style="z-index: 10; max-width: 380px;">
                            <div class="card border-0 shadow-lg p-3 bg-white">
                                <!-- Address 1 -->
                                <div class="mb-3 pb-3 border-bottom">
                                    <div class="d-flex gap-2 align-items-start">
                                         <div class="flex-grow-1" style="min-width: 0;">
                                            <h6 class="fw-bold mb-1 small">2020HOMES</h6>
                                            <p class="text-secondary mb-2" style="font-size: 1rem; line-height: 1.3;">
                                               No 72/32,28th Cross Street, <br>
                                               Indira Nagar,Adyar,Chennai : 600020
                                            </p>

                                            <a href="tel:+919445002020" class="text-decoration-none text-primary fw-bold" style="font-size: 1rem;">
                                                <i class="bi bi-telephone"></i> +91 944 500 2020
                                            </a> <br>
                                            <a href="mailto:info@2020homes.com" class="text-decoration-none text-primary fw-bold" style="font-size: 1rem;">
                                                <i class="bi bi-envelope"></i> info@2020homes.com
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


  <!-- CTA Section -->
{{-- <section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-lg text-center p-5">
                    <h2 class="fw-bold mb-4 cta-heading-main">
                        Ready to Find Your Perfect Property?
                    </h2>

                    <p class="text-secondary mb-5 cta-subtitle-main">
                        Join thousands of satisfied customers who found their dream properties with us
                    </p>

                    @auth
                        <a href="{{ route('front.contact') }}"
                           class="btn btn-primary btn-lg px-5 py-3">
                            <i class="bi bi-arrow-right-circle me-2"></i>
                            Contact Us Today
                        </a>
                    @else
                        <a href="{{ route('register') }}"
                           class="btn btn-primary btn-lg px-5 py-3">
                            <i class="bi bi-arrow-right-circle me-2"></i>
                            Start Your Journey Today
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</section> --}}


@endsection

