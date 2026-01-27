@extends('layouts.header')

@section('title', $property->title)

@section('content')
@php
    $bgImage = $property->banner_image_url;
@endphp

<!-- Hero Banner -->
<div class="position-relative" style="height: 60vh; min-height: 400px; background-color: #1a1a1a;">
    <div class="position-absolute w-100 h-100" style="background-image: url('{{ $bgImage }}'); background-size: cover; background-position: center; opacity: 0.7;"></div>
    <div class="position-absolute w-100 h-100" style="background: linear-gradient(to bottom, transparent 0%, rgba(0,0,0,0.8) 100%);"></div>

    <div class="container h-100 position-relative">
        <div class="d-flex flex-column justify-content-end h-100 pb-5">
            <div class="row">
                <div class="col-lg-8">
                    <span class="badge bg-primary mb-2 text-uppercase">{{ $property->property_type }}</span>
                    <span class="badge bg-white text-dark mb-2 text-uppercase">{{ $property->listing_type }}</span>
                    <h1 class="display-4 fw-bold text-white mb-2">{{ $property->title }}</h1>
                    <div class="d-flex text-white-50 align-items-center mb-3">
                        <i class="bi bi-geo-alt-fill me-2 text-primary"></i>
                        <span class="fs-5">{{ $property->city }}, {{ $property->state }}</span>
                    </div>
                    <h2 class="text-white fw-bold mb-0">₹{{ number_format($property->price / 100000, 2) }} Lakhs</h2>
                </div>
                <div class="col-lg-4 d-flex align-items-end justify-content-lg-end mt-4 mt-lg-0">
                    <a href="#contact-agent" class="btn btn-gradient-primary btn-lg px-5 fw-bold shadow-lg">
                        <i class="bi bi-telephone-fill me-2"></i>Contact Agent
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row g-5">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Key Features Grid -->
            <div class="card glass-card border-0 mb-5">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-4">Property Overview</h4>
                    <div class="row g-4 text-center">
                        <div class="col-6 col-md-3">
                            <div class="p-3 bg-light rounded-3 h-100">
                                <i class="bi bi-bounding-box-circles fs-3 text-primary mb-2 d-block"></i>
                                <div class="small text-secondary text-uppercase">Area</div>
                                <div class="fw-bold">{{ $property->area }} {{ $property->area_unit }}</div>
                            </div>
                        </div>
                        @if($property->property_type == 'flat')
                        <div class="col-6 col-md-3">
                            <div class="p-3 bg-light rounded-3 h-100">
                                <i class="bi bi-door-open fs-3 text-primary mb-2 d-block"></i>
                                <div class="small text-secondary text-uppercase">Bedrooms</div>
                                <div class="fw-bold">{{ $property->bedrooms ?? '-' }} BHK</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="p-3 bg-light rounded-3 h-100">
                                <i class="bi bi-droplet fs-3 text-primary mb-2 d-block"></i>
                                <div class="small text-secondary text-uppercase">Bathrooms</div>
                                <div class="fw-bold">{{ $property->bathrooms ?? '-' }}</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="p-3 bg-light rounded-3 h-100">
                                <i class="bi bi-lamp fs-3 text-primary mb-2 d-block"></i>
                                <div class="small text-secondary text-uppercase">Furnishing</div>
                                <div class="fw-bold">{{ $property->furnished == '1' ? 'Yes' : 'No' }}</div>
                            </div>
                        </div>
                        @else
                         <div class="col-6 col-md-3">
                            <div class="p-3 bg-light rounded-3 h-100">
                                <i class="bi bi-tag fs-3 text-primary mb-2 d-block"></i>
                                <div class="small text-secondary text-uppercase">Type</div>
                                <div class="fw-bold text-capitalize">{{ $property->property_type }}</div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="mb-5">
                <h4 class="fw-bold mb-3">About this Property</h4>
                <p class="text-secondary lead fs-6" style="line-height: 1.8;">
                    {{ $property->description }}
                </p>
            </div>

            <!-- Gallery -->
            @if($property->images->count() > 0)
            <div class="mb-5">
                <h4 class="fw-bold mb-3">Gallery</h4>
                <div class="row g-3">
                    @foreach($property->images as $image)
                    <div class="col-md-4 col-sm-6">
                        <div class="rounded overflow-hidden shadow-sm hover-lift transition-all" style="height: 200px; cursor: pointer;">
                            <img src="{{ $image->image_url }}"
                                 class="w-100 h-100 object-fit-cover"
                                 alt="Gallery Image"
                                 onclick="window.open(this.src, '_blank')">
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

             <!-- Address/Location -->
            @if($property->address)
            <div class="mb-5">
                <h4 class="fw-bold mb-3">Location</h4>
                <div class="card border-0 bg-light">
                    <div class="card-body p-4">
                         <div class="d-flex align-items-start">
                            <i class="bi bi-geo-alt-fill text-primary fs-4 me-3 mt-1"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Address</h6>
                                <p class="mb-0 text-secondary">{{ $property->address }}, {{ $property->city }}, {{ $property->state }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="sticky-top" style="top: 100px; z-index: 10;">
                <!-- Price Card -->
                <div class="card glass-card border-0 mb-4">
                    <div class="card-body p-4">
                        <div class="text-secondary small mb-1">Price</div>
                        <h2 class="fw-bold text-primary mb-3">₹{{ number_format($property->price) }}</h2>
                        <div class="d-grid">
                            <button class="btn btn-gradient-primary fw-bold py-3 mb-2">Request Call Back</button>
                            <button class="btn btn-outline-secondary fw-bold py-2">
                                <i class="bi bi-whatsapp me-2"></i>Chat on WhatsApp
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Agent Contact -->
                <div class="card glass-card border-0" id="contact-agent">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">Contact Agent</h5>
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                                <i class="bi bi-person-fill fs-3 text-secondary"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0">{{ $property->user->name ?? 'Property Agent' }}</h6>
                                <div class="text-secondary small">Verified Agent</div>
                            </div>
                        </div>

                        <form action="#" method="POST">
                            @csrf
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Your Name" required>
                            </div>
                            <div class="mb-3">
                                <input type="email" class="form-control" placeholder="Your Email" required>
                            </div>
                            <div class="mb-3">
                                <input type="tel" class="form-control" placeholder="Your Phone" required>
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" rows="3" placeholder="I am interested in {{ $property->title }}..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-dark w-100 fw-bold">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
