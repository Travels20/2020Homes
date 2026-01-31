@extends('layouts.dashboard')

@section('title', 'Admin Dashboard')
{{-- @section('page-title', 'Overviews') --}}

@section('sidebar-menu')
    <x-admin-sidebar-menu />
@endsection

@section('content')
    <div class="admin-dashboard-header mb-4">
        <div>
            <h2 class="admin-dashboard-title mb-1">Admin overview</h2>
            <p class="admin-dashboard-subtitle mb-0">Monitor properties, approvals and new users in real time.</p>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-4">
        <!-- Total Properties -->
        <div class="col-md-3">
            <div class="card bg-animated-gradient-1 success-gradient border-0 h-100 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="mb-0 opacity-75">Total Properties</p>
                            <h3 class="fw-bold mb-0 text-white">{{ $totalProperties }}</h3>
                        </div>
                        <div class="glass-icon">
                            <i class="bi bi-building"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Active Listings -->
        <div class="col-md-3">
            <div class="card bg-animated-gradient-2 border-0 h-100 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="mb-0 opacity-75">Active Listings</p>
                            <h3 class="fw-bold mb-0 text-white">{{ $activeProperties }}</h3>
                        </div>
                        <div class="glass-icon">
                            <i class="bi bi-shop-window"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Approval -->
        <div class="col-md-3">
            <div class="card bg-animated-gradient-3 border-0 h-100 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="mb-0 opacity-75">Pending Approval</p>
                            <h3 class="fw-bold mb-0 text-white">{{ $pendingProperties }}</h3>
                        </div>
                        <div class="glass-icon">
                            <i class="bi bi-hourglass-split"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Users -->
        <div class="col-md-3">
            <div class="card bg-animated-gradient-4 border-0 h-100 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="mb-0 opacity-75">Total Users</p>
                            <h3 class="fw-bold mb-0 text-white">{{ $totalUsers }}</h3>
                        </div>
                        <div class="glass-icon">
                            <i class="bi bi-people"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Recent Properties -->
        <div class="col-lg-8">
            <div class="card glass-card border-0 h-100">
                <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center py-3">
                    <h5 class="fw-bold mb-0 text-dark">Recent Properties</h5>
                    <a href="{{ route('admin.properties.index') }}" class="btn btn-sm btn-light text-primary fw-bold">View All</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4">Property</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentProperties as $property)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="rounded bg-light p-2 me-3">
                                                <i class="bi bi-house text-primary"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 fw-bold">{{ $property->title }}</h6>
                                                <small class="text-secondary">{{ $property->city }}, {{ $property->state }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="fw-bold">₹{{ number_format($property->price / 100000, 2) }} L</td>
                                    <td>
                                        @if($property->status == 'available')
                                            <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">Available</span>
                                        @elseif($property->status == 'sold')
                                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill">Sold</span>
                                        @else
                                            <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill">Reserved</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.properties.edit', $property->id) }}" class="btn btn-sm btn-icon btn-light text-secondary rounded-circle">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-secondary">No properties found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Users -->
        <div class="col-lg-4">
            <div class="card glass-card border-0 h-100">
                <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center py-3">
                    <h5 class="fw-bold mb-0 text-dark">New Users</h5>
                    <button class="btn btn-sm btn-light text-primary fw-bold">Detail</button>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @forelse($users as $user)
                        <div class="list-group-item border-0 d-flex align-items-center px-4 py-3">
                            <div class="flex-shrink-0">
                                <div class="avatar avatar-sm bg-gradient-primary text-white">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-0 fw-bold">{{ $user->name }}</h6>
                                <small class="text-secondary">{{ $user->email }}</small>
                            </div>
                            <span class="badge bg-light text-secondary rounded-pill border">{{ $user->role }}</span>
                        </div>
                        @empty
                        <div class="text-center py-4 text-secondary">No users found</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enquiries and Users Section -->
    <div class="row g-4 mt-2">
        <!-- Recent Enquiries -->
        <div class="col-lg-6">
            <div class="card glass-card border-0 h-100">
                <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center py-3">
                    <h5 class="fw-bold mb-0 text-dark">
                        <i class="bi bi-chat-dots text-info me-2"></i>Recent Enquiries
                    </h5>
                    <a href="#" class="btn btn-sm btn-light text-info fw-bold">View All</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4">Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($enquiries ?? [] as $enquiry)
                                <tr>
                                    <td class="ps-4">
                                        <h6 class="mb-0 fw-bold">{{ $enquiry->name }}</h6>
                                    </td>
                                    <td>
                                        <a href="mailto:{{ $enquiry->email }}" class="text-decoration-none small">{{ $enquiry->email }}</a>
                                    </td>
                                    <td>
                                        <a href="tel:{{ $enquiry->phone }}" class="text-decoration-none fw-bold">{{ $enquiry->phone }}</a>
                                    </td>
                                    <td>
                                        <small class="text-secondary">{{ $enquiry->created_at->format('d M Y') }}</small>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-secondary">No enquiries found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- All Users List -->
        <div class="col-lg-6">
            <div class="card glass-card border-0 h-100">
                <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center py-3">
                    <h5 class="fw-bold mb-0 text-dark">
                        <i class="bi bi-people text-success me-2"></i>All Users
                    </h5>
                    <span class="badge bg-info text-white">{{ count($users) }}</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4">Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm bg-gradient-primary text-white me-2">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                            <h6 class="mb-0 fw-bold">{{ $user->name }}</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <small class="text-secondary">{{ $user->email }}</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-secondary rounded-pill border text-capitalize">{{ $user->role }}</span>
                                    </td>
                                    <td>
                                        @if($user->status == 'active')
                                            <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">Active</span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-secondary">No users found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


