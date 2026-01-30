@extends('layouts.dashboard')

@section('title', 'My Properties')
@section('page-title', 'My Properties')

@section('sidebar-menu')
    <li class="sidebar-nav-item">
        <a href="{{ route('vendor.dashboard') }}" class="sidebar-nav-link">
            <i class="bi bi-speedometer2 sidebar-nav-icon"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="sidebar-nav-item">
        <a href="{{ route('vendor.properties.index') }}" class="sidebar-nav-link active">
            <i class="bi bi-building sidebar-nav-icon"></i>
            <span>My Properties</span>
        </a>
    </li>
    <li class="sidebar-nav-item">
        <a href="{{ route('vendor.properties.create') }}" class="sidebar-nav-link">
            <i class="bi bi-plus-circle sidebar-nav-icon"></i>
            <span>Add Property</span>
        </a>
    </li>
    {{-- <li class="sidebar-nav-item">
        <a href="#" class="sidebar-nav-link">
            <i class="bi bi-envelope sidebar-nav-icon"></i>
            <span>Enquiry</span>
        </a>
    </li> --}}
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="fw-bold mb-1">My Properties</h2>
                    <p class="text-secondary mb-0">Manage and view all your property listings</p>
                </div>
                <a href="{{ route('vendor.properties.create') }}" class="btn btn-gradient-primary">
                    <i class="bi bi-plus-circle me-2"></i>Add New Property
                </a>
            </div>
        </div>
    </div>

    <!-- Filters and Search -->
    <div class="row g-4 mb-4">
        <div class="col-md-12">
            <div class="glass-card p-4">
                <div class="row align-items-end g-3">
                    <div class="col-md-4">
                        <label class="form-label">Search Properties</label>
                        <input type="text" class="form-control" placeholder="Search by title or location...">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Type</label>
                        <select class="form-select form-control">
                            <option>All Types</option>
                            <option>Plot</option>
                            <option>Flat</option>
                            <option>Agriculture</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Status</label>
                        <select class="form-select form-control">
                            <option>All Status</option>
                            <option>Draft</option>
                            <option>Available</option>
                            <option>Sold</option>
                            <option>Reserved</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Price Range</label>
                        <select class="form-select form-control">
                            <option>All Prices</option>
                            <option>Under 50L</option>
                            <option>50L - 1Cr</option>
                            <option>Above 1Cr</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('vendor.properties.create') }}" class="btn btn-gradient-primary w-100">
                            <i class="bi bi-plus-circle me-2"></i>Add
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Properties Table -->
    <div class="card glass-card border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4" style="width: 30%;">Property Info</th>
                            <th>Type & Status</th>
                            <th>Features</th>
                            <th>Price</th>
                            <th>Date Added</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($properties as $property)
                        <tr>
                            <td class="ps-4 py-3">
                                <div class="d-flex align-items-center">
                                    @php
                                        $imgSrc = $property->feature_image_url;
                                    @endphp
                                    <div class="rounded overflow-hidden me-3" style="width: 80px; height: 60px;">
                                        <img src="{{ $imgSrc }}" class="w-100 h-100 object-fit-cover" alt="{{ $property->title }}">
                                    </div>
                                    <div>
                                        <h6 class="mb-1 fw-bold text-dark text-truncate" style="max-width: 200px;">{{ $property->title }}</h6>
                                        <small class="text-secondary d-flex align-items-center">
                                            <i class="bi bi-geo-alt-fill me-1 text-primary" style="font-size: 0.8rem;"></i>
                                            {{ $property->city }}, {{ $property->state }}
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column gap-1">
                                    <span class="badge bg-light text-dark border text-uppercase">{{ $property->property_type }}</span>
                                    @if($property->status == 'draft')
                                        <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle">Draft (Hidden)</span>
                                    @elseif($property->status == 'available')
                                        <span class="badge bg-success-subtle text-success border border-success-subtle">Published</span>
                                    @elseif($property->status == 'sold')
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle">Sold</span>
                                    @else
                                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle">Reserved</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <ul class="list-unstyled mb-0 small text-secondary">
                                    <li class="mb-1"><i class="bi bi-arrows-fullscreen me-2"></i>{{ $property->area }} {{ $property->area_unit }}</li>
                                    @if($property->property_type == 'flat')
                                        <li><i class="bi bi-door-open me-2"></i>{{ $property->bedrooms ?? '-' }} Beds, {{ $property->bathrooms ?? '-' }} Baths</li>
                                    @endif
                                </ul>
                            </td>
                            <td>
                                <h6 class="fw-bold text-primary mb-0">₹{{ number_format($property->price / 100000, 2) }} L</h6>
                            </td>
                            <td>
                                <small class="text-secondary">{{ $property->created_at->format('M d, Y') }}</small>
                            </td>
                            <td class="text-end pe-4">
                                <div class="btn-group">
                                    <a href="{{ route('property.show', $property->slug) }}" class="btn btn-sm btn-light text-primary border" title="View Property" target="_blank">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                    <a href="{{ route('vendor.properties.edit', $property->id) }}" class="btn btn-sm btn-light text-secondary border" title="Edit Property">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="text-secondary mb-3"><i class="bi bi-house-slash" style="font-size: 48px;"></i></div>
                                <h4>No Properties Yet</h4>
                                <p class="text-secondary">Start by adding your first property listing.</p>
                                <a href="{{ route('vendor.properties.create') }}" class="btn btn-gradient-primary">Add Your First Property</a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $properties->links('pagination::bootstrap-5') }}
    </div>
@endsection

@push('styles')
<style>
    .pagination .page-link {
        border: 1px solid rgba(0,0,0,0.1);
        margin: 0 5px;
        border-radius: 10px;
        color: #b32d2e;
    }
    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #b32d2e 0%, #d32f2f 100%);
        border-color: transparent;
        color: white;
    }
    .pagination .page-item:not(.active) .page-link:hover {
        background-color: rgba(179, 45, 46, 0.1);
        color: #b32d2e;
    }
</style>
@endpush
