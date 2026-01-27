@extends('layouts.dashboard')

@section('title', 'Vendor Dashboard')
@section('page-title', 'Vendor Dashboard')

@section('sidebar-menu')
    <li class="sidebar-nav-item">
        <a href="{{ route('vendor.dashboard') }}" class="sidebar-nav-link active">
            <i class="bi bi-speedometer2 sidebar-nav-icon"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="sidebar-nav-item">
        <a href="{{ route('vendor.properties.index') }}" class="sidebar-nav-link">
            <i class="bi bi-building sidebar-nav-icon"></i>
            <span>My Properties</span>
        </a>
    </li>
    <li class="sidebar-nav-item">
        <a href="{{ route('vendor.properties.create') }}" class="sidebar-nav-link">
            <i class="bi bi-plus-circle sidebar-nav-icon"></i>
            <span>Submit Property</span>
        </a>
    </li>
    <li class="sidebar-nav-item">
        <a href="{{ route('vendor.sales.index') }}" class="sidebar-nav-link">
            <i class="bi bi-graph-up sidebar-nav-icon"></i>
            <span>Sales Tracking</span>
        </a>
    </li>
    <li class="sidebar-nav-item">
        <a href="{{ route('vendor.earnings.index') }}" class="sidebar-nav-link">
            <i class="bi bi-wallet2 sidebar-nav-icon"></i>
            <span>Earnings</span>
        </a>
    </li>
@endsection

@section('content')
    <!-- Statistics Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card bg-animated-gradient-1 border-0 h-100 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="mb-0 opacity-75 text-white">My Properties</p>
                            <h3 class="fw-bold mb-0 text-white">{{ $myProperties ?? 12 }}</h3>
                        </div>
                        <div class="glass-icon">
                            <i class="bi bi-building"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card bg-animated-gradient-2 border-0 h-100 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="mb-0 opacity-75 text-white">Sold Properties</p>
                            <h3 class="fw-bold mb-0 text-white">{{ $soldProperties ?? 7 }}</h3>
                        </div>
                        <div class="glass-icon">
                            <i class="bi bi-check-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card bg-animated-gradient-3 border-0 h-100 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="mb-0 opacity-75 text-white">Total Views</p>
                            <h3 class="fw-bold mb-0 text-white">{{ $totalViews ?? 342 }}</h3>
                        </div>
                        <div class="glass-icon">
                            <i class="bi bi-eye"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card bg-animated-gradient-4 border-0 h-100 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="mb-0 opacity-75 text-white">Total Earnings</p>
                            <h3 class="fw-bold mb-0 text-white">₹{{ number_format($totalEarnings ?? 1250000, 0) }}</h3>
                        </div>
                        <div class="glass-icon">
                            <i class="bi bi-currency-rupee"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="row g-4 mb-4">
        <div class="col-md-12">
            <div class="glass-card p-4">
                <h5 class="mb-3"><i class="bi bi-lightning-fill me-2 text-danger"></i>Quick Actions</h5>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ route('vendor.properties.create') }}" class="btn btn-gradient-primary">
                        <i class="bi bi-plus-circle me-2"></i>Submit New Property
                    </a>
                    <button class="btn btn-outline-light">
                        <i class="bi bi-graph-up me-2"></i>View Analytics
                    </button>
                    <button class="btn btn-outline-light">
                        <i class="bi bi-wallet2 me-2"></i>Withdraw Earnings
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Recent Properties & Performance -->
    <div class="row g-4">
        <!-- My Properties -->
        <div class="col-lg-8">
            <div class="glass-card p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0"><i class="bi bi-building me-2 text-danger"></i>My Recent Properties</h5>
                    <a href="{{ route('vendor.properties.index') }}" class="text-danger text-decoration-none">
                        View All <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="property-card">
                            <div class="position-relative">
                                <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=400&h=200&fit=crop" 
                                     class="property-image" alt="Property">
                                <span class="badge-status badge-available position-absolute top-0 end-0 m-2">Available</span>
                            </div>
                            <div class="property-body">
                                <h6 class="property-title">Luxury Villa Plot</h6>
                                <p class="property-location mb-2">
                                    <i class="bi bi-geo-alt-fill text-danger"></i>
                                    Gurgaon, Haryana
                                </p>
                                <div class="property-price mb-2">₹85,00,000</div>
                                <div class="d-flex justify-content-between text-muted small">
                                    <span><i class="bi bi-eye me-1"></i>45 views</span>
                                    <span><i class="bi bi-heart me-1"></i>12 saves</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="property-card">
                            <div class="position-relative">
                                <img src="https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=400&h=200&fit=crop" 
                                     class="property-image" alt="Property">
                                <span class="badge-status badge-sold position-absolute top-0 end-0 m-2">Sold</span>
                            </div>
                            <div class="property-body">
                                <h6 class="property-title">3BHK Apartment</h6>
                                <p class="property-location mb-2">
                                    <i class="bi bi-geo-alt-fill text-danger"></i>
                                    Noida, UP
                                </p>
                                <div class="property-price mb-2">₹65,00,000</div>
                                <div class="d-flex justify-content-between text-muted small">
                                    <span><i class="bi bi-eye me-1"></i>78 views</span>
                                    <span><i class="bi bi-check-circle me-1 text-success"></i>Sold</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Performance Stats -->
        <div class="col-lg-4">
            <div class="glass-card p-4 mb-4">
                <h5 class="text-white mb-3"><i class="bi bi-trophy me-2"></i>Performance</h5>
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-white-50">Profile Completion</span>
                        <span class="text-white fw-bold">85%</span>
                    </div>
                    <div class="progress" style="height: 8px; background: rgba(255,255,255,0.1);">
                        <div class="progress-bar" style="width: 85%; background: linear-gradient(90deg, #43e97b 0%, #38f9d7 100%);"></div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-secondary">Response Rate</span>
                        <span class="fw-bold">92%</span>
                    </div>
                    <div class="progress" style="height: 8px; background: rgba(255,255,255,0.1);">
                        <div class="progress-bar" style="width: 92%; background: linear-gradient(90deg, #4facfe 0%, #00f2fe 100%);"></div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-white-50">Customer Rating</span>
                        <span class="text-white fw-bold">4.8/5</span>
                    </div>
                    <div class="d-flex gap-1">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-half text-warning"></i>
                    </div>
                </div>
            </div>
            
            <!-- Monthly Earnings -->
            <div class="glass-card p-4">
                <h5 class="text-white mb-3"><i class="bi bi-calendar-month me-2"></i>This Month</h5>
                <div class="text-center mb-3">
                    <div style="font-size: 36px; font-weight: 700; color: white;">₹1,85,000</div>
                    <div class="text-success">
                        <i class="bi bi-arrow-up"></i> 23% from last month
                    </div>
                </div>
                <div class="d-flex justify-content-between text-white-50 small">
                    <span>Properties Sold: 2</span>
                    <span>Commission: ₹35,000</span>
                </div>
            </div>
        </div>
    </div>
@endsection
