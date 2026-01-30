@extends('layouts.home')

@section('title', 'Properties')

@section('content')
@php
    $titleMap = [
        'plot' => 'Available Plots',
        'flat' => 'Available Flats',
        'agriculture' => 'Available Agricultural Land',
    ];
    $pageTitle = $titleMap[$filterType ?? ''] ?? 'Available Properties';
    $pageSubtitle = !empty($filterCity)
        ? "Verified listings in {$filterCity}"
        : 'Find your dream home from our verified listings';
@endphp

<!-- Hero Section -->
<div class="position-relative py-5 bg-gradient-primary text-white text-center">
    <div class="container py-5">
        <h1 class="display-4 fw-bold mb-3">{{ $pageTitle }}</h1>
        <p class="lead mb-0 opacity-75">{{ $pageSubtitle }}</p>
    </div>
    <div class="position-absolute bottom-0 start-0 w-100 overflow-hidden" style="line-height: 0;">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none" style="position: relative; display: block; width: calc(100% + 1.3px); height: 60px;">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" fill="#ffffff"></path>
        </svg>
    </div>
</div>

<div class="container py-5">
    <!-- Filters (Simplified for frontend) -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm p-3">
                <form class="row g-3">
                    <div class="col-md-4">
                        <select class="form-select">
                            <option selected>All Types</option>
                            <option value="1">Plot</option>
                            <option value="2">Flat</option>
                            <option value="3">Agriculture</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select class="form-select">
                            <option selected>Price Range</option>
                            <option value="1">Under 50L</option>
                            <option value="2">50L - 1Cr</option>
                            <option value="3">Above 1Cr</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-gradient-primary w-100 fw-bold">Search Properties</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Properties Grid -->
    <div class="row g-4">
        @forelse($properties as $property)
        <div class="col-lg-4 col-md-6">
            <div class="card h-100 glass-card border-0 hover-lift transition-all" style="cursor: pointer;" onclick="window.location='{{ route('property.show', $property->slug) }}'">
                <div class="position-relative">
                    @php
                        $imgSrc = $property->feature_image_url;
                    @endphp
                    <img src="{{ $imgSrc }}"
                         class="card-img-top" alt="{{ $property->title }}" style="height: 250px; object-fit: cover;" onerror="this.src='https://images.unsplash.com/photo-1560518883-ce09059eeffa?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'">
                    <div class="position-absolute top-0 start-0 m-3">
                        <span class="badge bg-white text-dark shadow-sm px-3 py-2 rounded-pill fw-bold text-capitalize">
                            {{ $property->property_type }}
                        </span>
                    </div>
                    <div class="position-absolute top-0 end-0 m-3">
                        <span class="badge bg-gradient-primary shadow-sm px-3 py-2 rounded-pill fw-bold text-capitalize">
                            {{ $property->listing_type }}
                        </span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold mb-1 text-truncate">{{ $property->title }}</h5>
                    <p class="text-secondary small mb-3 text-truncate">
                        <i class="bi bi-geo-alt-fill me-1 text-primary"></i> {{ $property->city }}, {{ $property->state }}
                    </p>

                    <h4 class="text-primary fw-bold mb-3">₹{{ number_format($property->price / 100000, 2) }} Lakhs</h4>

                    <div class="d-flex justify-content-between border-top border-bottom py-2 mb-3">
                        <div class="text-center">
                            <small class="text-secondary d-block">Area</small>
                            <span class="fw-bold">{{ $property->area }} <small>{{ $property->area_unit }}</small></span>
                        </div>
                        @if($property->property_type == 'flat')
                            <div class="text-center">
                                <small class="text-secondary d-block">Beds</small>
                                <span class="fw-bold">{{ $property->bedrooms ?? '-' }}</span>
                            </div>
                            <div class="text-center">
                                <small class="text-secondary d-block">Baths</small>
                                <span class="fw-bold">{{ $property->bathrooms ?? '-' }}</span>
                            </div>
                        @else
                            <div class="text-center">
                                <small class="text-secondary d-block">Type</small>
                                <span class="fw-bold text-capitalize">{{ $property->listing_type }}</span>
                            </div>
                        @endif
                    </div>

                    <a href="{{ route('property.show', $property->slug) }}" class="btn btn-outline-primary w-100 fw-bold">View Details</a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <div class="text-secondary mb-3"><i class="bi bi-search" style="font-size: 48px;"></i></div>
            <h4>No Properties Found</h4>
            <p>Check back later for new listings.</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-5">
        {{ $properties->links('pagination::bootstrap-5') }}
    </div>
</div>

<style>
    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;
    }
</style>
@endsection
