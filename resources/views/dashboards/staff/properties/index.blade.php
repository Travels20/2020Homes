@extends('layouts.dashboard')

@section('title', 'My Properties')
@section('page-title', 'My Properties')

@section('sidebar-menu')
    <li class="sidebar-nav-item">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-nav-link">
            <i class="bi bi-speedometer2 sidebar-nav-icon"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="sidebar-nav-item">
        <a href="{{ route('admin.my-properties') }}" class="sidebar-nav-link active">
            <i class="bi bi-building sidebar-nav-icon"></i>
            <span>My Properties</span>
        </a>
    </li>
    <li class="sidebar-nav-item">
        <a href="{{ route('admin.properties.create') }}" class="sidebar-nav-link">
            <i class="bi bi-plus-circle sidebar-nav-icon"></i>
            <span>Add Property</span>
        </a>
    </li>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">My Properties</h2>
            <p class="text-secondary mb-0">Manage the properties you created</p>
        </div>
        <a href="{{ route('admin.properties.create') }}" class="btn btn-gradient-primary">
            <i class="bi bi-plus-circle me-2"></i>Add New Property
        </a>
    </div>

    <div class="card glass-card border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4" style="width: 35%;">Property Info</th>
                            <th>Status</th>
                            <th>Price</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($properties as $property)
                            <tr>
                                <td class="ps-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded overflow-hidden me-3" style="width: 80px; height: 60px;">
                                            <img src="{{ $property->feature_image_url }}" class="w-100 h-100 object-fit-cover" alt="{{ $property->title }}">
                                        </div>
                                        <div>
                                            <h6 class="mb-1 fw-bold text-dark text-truncate" style="max-width: 240px;">{{ $property->title }}</h6>
                                            <small class="text-secondary d-flex align-items-center">
                                                <i class="bi bi-geo-alt-fill me-1 text-primary" style="font-size: 0.8rem;"></i>
                                                {{ $property->city }}, {{ $property->state }}
                                            </small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($property->status === 'draft')
                                        <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle">Draft</span>
                                    @elseif($property->status === 'available')
                                        <span class="badge bg-success-subtle text-success border border-success-subtle">Published</span>
                                    @elseif($property->status === 'sold')
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle">Sold</span>
                                    @else
                                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle">Reserved</span>
                                    @endif

                                    @if(!$property->is_verified)
                                        <div class="mt-1">
                                            <span class="badge bg-warning-subtle text-warning border border-warning-subtle">Pending approval</span>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <h6 class="fw-bold text-primary mb-0">₹{{ number_format($property->price / 100000, 2) }} L</h6>
                                </td>
                                <td class="text-end pe-4">
                                    <div class="btn-group">
                                        <a href="{{ route('property.show', $property->slug) }}" class="btn btn-sm btn-light text-primary border" title="View Property" target="_blank">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <a href="{{ route('admin.properties.edit', $property->id) }}" class="btn btn-sm btn-light text-secondary border" title="Edit Property">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <div class="text-secondary mb-3"><i class="bi bi-house-slash" style="font-size: 48px;"></i></div>
                                    <h4>No Properties Yet</h4>
                                    <p class="text-secondary">Create your first property listing.</p>
                                    <a href="{{ route('admin.properties.create') }}" class="btn btn-gradient-primary">Add Property</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

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
</style>
@endpush
