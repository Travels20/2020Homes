@extends('layouts.dashboard')

@section('title', 'Staff Dashboard')
@section('page-title', 'Staff Dashboard')

@section('sidebar-menu')
    <li class="sidebar-nav-item">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-nav-link active">
            <i class="bi bi-speedometer2 sidebar-nav-icon"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="sidebar-nav-item">
        <a href="{{ route('admin.my-properties') }}" class="sidebar-nav-link">
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
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card glass-card border-0 h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-2">My Properties</h5>
                    <p class="text-secondary mb-3">View and edit the properties you created.</p>
                    <a href="{{ route('admin.my-properties') }}" class="btn btn-gradient-primary">
                        <i class="bi bi-building me-2"></i>Open My Properties
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card glass-card border-0 h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-2">Add New Property</h5>
                    <p class="text-secondary mb-3">Create a new property listing for approval.</p>
                    <a href="{{ route('admin.properties.create') }}" class="btn btn-gradient-primary">
                        <i class="bi bi-plus-circle me-2"></i>Add Property
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
