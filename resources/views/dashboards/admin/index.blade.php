@extends('layouts.dashboard')

@section('title', 'Admin Dashboard')
@section('page-title', 'Overview')

@section('sidebar-menu')
    <li class="sidebar-nav-item">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-nav-link active">
            <i class="bi bi-speedometer2 sidebar-nav-icon"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="sidebar-nav-item">
        <a href="{{ route('admin.properties.index') }}" class="sidebar-nav-link">
            <i class="bi bi-building sidebar-nav-icon"></i>
            <span>Properties</span>
        </a>
    </li>
    <li class="sidebar-nav-item">
        <a href="{{ route('admin.properties.create') }}" class="sidebar-nav-link">
            <i class="bi bi-plus-circle sidebar-nav-icon"></i>
            <span>Add Property</span>
        </a>
    </li>
    <li class="sidebar-nav-item">
        <a href="{{ route('admin.settings.index') }}" class="sidebar-nav-link {{ request()->is('admin/settings*') ? 'active' : '' }}">
            <i class="bi bi-gear sidebar-nav-icon"></i>
            <span>Site Settings</span>
        </a>
    </li>
@endsection

@section('content')
    <!-- Statistics Cards -->
    <div class="row g-4 mb-4">
        <!-- Total Properties -->
        <div class="col-md-3">
            <div class="card bg-animated-gradient-1 border-0 h-100 shadow-sm">
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
                                <div class="avatar bg-gradient-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
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

    <!-- Quick Stats/Graph Placeholder -->
    <div class="row g-4 mt-1">
        <div class="col-md-12">
             <div class="card glass-card border-0 p-4">
                <h5 class="fw-bold mb-3">System Status</h5>
                <div class="progress" style="height: 10px;">
                  <div class="progress-bar bg-gradient-primary" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="text-secondary mt-2 small">Server load normal. Database connection stable.</p>
             </div>
        </div>
    </div>
@endsection


