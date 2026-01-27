@extends('layouts.header')

@section('title', '2020Homes')

@section('content')
    <!-- Hero Section with Carousel -->
    <section class="hero-section position-relative overflow-hidden">
        <!-- Background Carousel -->
        <div id="heroCarousel" class="carousel slide carousel-fade h-100 w-100 position-absolute top-0 start-0" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-inner h-100">
                @php
                    $banners = \App\Models\SiteSetting::get('banners');
                    $banners = $banners ? json_decode($banners) : [];
                @endphp

                @if(count($banners) > 0)
                    @foreach($banners as $index => $banner)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }} h-100">
                            <div class="hero-slide h-100" style="background-image: url('{{ \Illuminate\Support\Facades\Storage::disk('s3')->url($banner) }}'); background-size: cover; background-position: center; filter: brightness(0.7);"></div>
                        </div>
                    @endforeach
                @else
                    <div class="carousel-item active h-100">
                        <div class="hero-slide h-100" style="background-image: url('{{ asset('images/bannerimage.webp') }}'); background-size: cover; background-position: center; filter: brightness(0.7);"></div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Overlay Content -->
        <div class="container position-relative z-3 py-5">
            <div class="row min-vh-100 align-items-center">
                <div class="col-lg-10 col-xl-8">
                    <!-- Top Badges -->
                    {{-- <div class="d-flex gap-2 mb-4">
                        <span class="badge rounded-pill px-4 py-2 fw-bold" style="background-color: #b32d2e;">Buy</span>
                        <span class="badge rounded-pill px-4 py-2 fw-bold" style="background-color: #b32d2e; opacity: 0.8;">Rent</span>
                        <span class="badge rounded-pill px-4 py-2 fw-bold" style="background-color: #b32d2e; opacity: 0.8;">Commercial</span>
                    </div> --}}

                    <!-- Hero Title -->
                    <h1 class="fw-bold text-white mb-3 hero-title-modern">Build Your Future, One <br> Property at a Time.</h1>

                    <!-- Search Card Box -->
                    <div class="search-card-container position-relative mb-5 scale-in">
                        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                            <div class="card-body p-4">
                                <form action="{{ route('front.properties') }}" method="GET" class="row g-3 align-items-end">
                                    <div class="col-md-3">
                                        <label class="form-label fw-bold text-dark small mb-1">Looking for</label>
                                        <input type="text" name="type" class="form-control border-0 bg-light py-2 rounded-3" placeholder="Enter type">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label fw-bold text-dark small mb-1">Price</label>
                                        <select name="price" class="form-select border-0 bg-light py-2 rounded-3">
                                            <option value="">Price</option>
                                            <option value="1000000">Up to 10 Lakhs</option>
                                            <option value="5000000">Up to 50 Lakhs</option>
                                            <option value="10000000">Up to 1 Cr</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label fw-bold text-dark small mb-1">Locations</label>
                                        <select name="location" class="form-select border-0 bg-light py-2 rounded-3">
                                            <option value="">Location</option>
                                            <option value="delhi">Delhi</option>
                                            <option value="gurgaon">Gurgaon</option>
                                            <option value="noida">Noida</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-search-green w-100 py-2 rounded-pill fw-bold">Search Properties</button>
                                    </div>
                                </form>
                            </div>
                            <!-- Category Bar -->
                            <div class="category-bar py-2 px-3 d-flex flex-wrap gap-2 align-items-center" style="background-color: #b32d2e;">
                                <a href="?type=plot" class="text-white text-decoration-none px-3 border-end border-white-50 small fw-bold">Plot</a>
                                <a href="?type=house" class="text-white text-decoration-none px-3 border-end border-white-50 small fw-bold">House</a>
                                <a href="?type=farmhouse" class="text-white text-decoration-none px-3 border-end border-white-50 small fw-bold">Farm House/Land</a>
                                <a href="?type=flat" class="text-white text-decoration-none px-3 border-end border-white-50 small fw-bold">Flat/Apartment</a>
                                <a href="?type=villa" class="text-white text-decoration-none px-3 small fw-bold">Independent Villa</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Social Sidebar -->
        <div class="social-sidebar-vertical d-none d-md-flex flex-column gap-3 py-4 px-3 align-items-center rounded-start position-absolute top-50 end-0 translate-middle-y z-3" style="background-color: #b32d2e;">
            <a href="#" class="text-white fs-5"><i class="bi bi-twitter"></i></a>
            <a href="#" class="text-white fs-5"><i class="bi bi-facebook"></i></a>
            <a href="#" class="text-white fs-5"><i class="bi bi-instagram"></i></a>
            <a href="#" class="text-white fs-5"><i class="bi bi-youtube"></i></a>
        </div>
    </section>

    <!-- Featured Properties Section -->
@if($featuredProperties->count() > 0)
<section class="py-5 bg-light">
    <div class="container">
        <!-- Header with Location Filters -->
        <div class="text-center mb-4">
            <h2 class="fw-bold mb-2 text-danger">Your Home. Your Dream. Your Choice</h2>
            <p class="text-secondary mb-4">Choose your plot from India's Largest Plotted Real Estate Developer</p>
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
                <div class="property-card card h-100 border-0 shadow-sm overflow-hidden">
                    <!-- Property Image -->
                    <div class="position-relative property-image-wrapper">
                        @php
                            $imgSrc = $property->feature_image_url;
                        @endphp

                        <img src="{{ $imgSrc }}"
                             class="card-img-top property-image"
                             alt="{{ $property->title }}"
                             onerror="this.src='https://images.unsplash.com/photo-1560518883-ce09059eeffa?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'">

                        <!-- Status Badge - Top Right -->
                        <div class="position-absolute top-0 end-0">
                            <div class="status-badge bg-danger text-white px-3 py-2 fw-bold">
                                {{ strtoupper($property->listing_type) }}
                            </div>
                        </div>

                        <!-- Location Badge - Bottom Left -->
                        <div class="position-absolute bottom-0 start-0 m-3">
                            <div class="bg-danger text-white px-3 py-2 rounded-3 fw-bold d-flex align-items-center gap-2">
                                <i class="bi bi-geo-alt-fill"></i>
                                <span>{{ $property->city }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body p-3">
                        <!-- Title -->
                        <h5 class="card-title fw-bold mb-2 text-truncate" style="font-size: 1.1rem;">
                            {{ $property->title }}
                        </h5>

                        <!-- Property Details Grid -->
                        <div class="row g-2 mb-3">
                            <!-- Area -->
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
                                <!-- Bedrooms -->
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
                                <!-- Property Type -->
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

                            <!-- Price -->
                            <div class="col-6">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-currency-rupee text-secondary"></i>
                                    <div>
                                        <small class="text-secondary d-block" style="font-size: 0.75rem;">Price</small>
                                        <span class="fw-bold text-danger" style="font-size: 0.85rem;">₹ {{ number_format($property->price / 100000, 2) }} L</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Status/Availability -->
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

                        <!-- Action Buttons -->
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

        <!-- View All Button -->
        <div class="text-center mt-5">
            <a href="{{ route('front.properties') }}" class="btn btn-lg btn-danger px-5 rounded-pill fw-bold">
                View All Properties
                <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>
@endif

       <!-- Property Types Section -->
    <section class="py-5  bg-light" id="properties">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-3">Property Categories</h2>
                <p class="text-secondary">Explore our diverse range of real estate options</p>
            </div>

            <div class="row g-4">
                {{-- Dynamic Categories based on Property Types --}}
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
    </section>

    <!-- Features Section -->
<section class="py-5" >
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3">Why Choose 2020Homes?</h2>
            <p class="text-white-50">We provide the best real estate solutions for your needs</p>
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
                    <p class="text-secondary">Expert guidance for making smart real estate investments</p>
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

<!-- Property Offer Section -->
<section class="py-5 bg-light" id="properties">
    <div class="container px-0">
        <div class="row g-0">
            <div class="col-12">
                <div class="card border-0 text-white property-card"
                     style="cursor:pointer;"
                     onclick="window.location='{{ route('front.properties', ['type' => 'plot']) }}'">

                    <!-- Background Image -->
                    <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=1600&h=600&fit=crop"
                         class="card-img"
                         alt="Plots"
                         style="height: 450px; object-fit: cover;">

                    <!-- Text Overlay -->
                    <div class="card-img-overlay d-flex flex-column justify-content-center align-items-center text-center"
                         style="background: rgba(0,0,0,0.45);">
                        <h2 class="fw-bold">Residential Plots</h2>
                        <p class="small mb-0">Ready to Make Your Dream Property a Reality</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>


<!-- Top Real Estate Partner and Agent -->
<section class="py-5 bg-white" id="partners">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3 text-danger">Top Real Estate Agents in Chennai</h2>
        </div>

        <div class="row g-4 align-items-center justify-content-center">
            {{-- Row 1 --}}
            <div class="col-6 col-md-4 col-lg-2 text-center">
                <div class="partner-logo p-3">
                    <img src="{{ asset('images/partners/dlf.png') }}" alt="DLF Building India" class="img-fluid" style="max-height: 80px;">
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
                    <img src="{{ asset('images/partners/brigade.png') }}" alt="Brigade" class="img-fluid" style="max-height: 80px;">
                </div>
            </div>
        </div>

        <div class="row g-4 align-items-center justify-content-center mt-2">
            {{-- Row 2 --}}
            <div class="col-6 col-md-4 col-lg-2 text-center">
                <div class="partner-logo p-3">
                    <img src="{{ asset('images/partners/ansals.png') }}" alt="Ansals API" class="img-fluid" style="max-height: 80px;">
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
        </div>
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
                        <p class="text-white opacity-75 mb-0">for Real Estate Agents</p>
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
                                            Best real estate agents in Chennai! Quick responses and handled everything professionally.
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

  <!-- CTA Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-lg text-center p-5">
                    <h2 class="fw-bold mb-4" style="font-size: 48px;">
                        Ready to Find Your Perfect Property?
                    </h2>

                    <p class="text-secondary mb-5" style="font-size: 20px;">
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
</section>


@endsection


<style>
.partner-logo {
    transition: transform 0.3s ease;
}

.partner-logo:hover {
    transform: translateY(-5px);
}

.partner-logo img {
    filter: grayscale(100%);
    opacity: 0.7;
    transition: all 0.3s ease;
}

.partner-logo:hover img {
    filter: grayscale(0%);
    opacity: 1;
}
.google-reviews-banner {
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.z-1 {
    z-index: 1;
}

.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
}
.feature-box {
    transition: transform 0.3s ease, background 0.3s ease;
    border-radius: 15px;
    /* background: rgba(255, 255, 255, 0.05); */
    backdrop-filter: blur(10px);
    /* border: 1px solid rgba(255, 255, 255, 0.1); */
}

.feature-box:hover {
    transform: translateY(-10px);
    background: rgba(255, 255, 255, 0.1);
}

.feature-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.feature-icon i {
    font-size: 2rem;
    color: white;
}

.feature-box:hover .feature-icon {
    transform: scale(1.1) rotate(5deg);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
}

.property-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
    border-radius: 12px;
    overflow: hidden;
}

.property-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15) !important;
}

.property-image-wrapper {
    overflow: hidden;
    height: 240px;
}

.property-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.property-card:hover .property-image {
    transform: scale(1.1);
}

.status-badge {
    clip-path: polygon(0 0, 100% 0, 85% 100%, 0% 100%);
    padding-right: 2.5rem !important;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .property-image-wrapper {
        height: 200px;
    }

    .status-badge {
        font-size: 0.75rem;
        padding: 0.5rem 2rem 0.5rem 1rem !important;
    }
}

/* Icon styling */
.card-body i {
    font-size: 1rem;
}

/* Button hover effects */
.btn-outline-danger:hover {
    background-color: #dc3545;
    color: white;
    border-color: #dc3545;
}

.btn-danger:hover {
    background-color: #bb2d3b;
    border-color: #bb2d3b;
}
.location-tabs {
    font-size: 15px;
    color: #333;
}

.location-tabs a {
    color: #000;
    text-decoration: none;
    font-weight: 500;
}

.location-tabs a:hover {
    text-decoration: underline;
}

.location-tabs span {
    margin: 0 6px;
    color: #666;
}

</style>

