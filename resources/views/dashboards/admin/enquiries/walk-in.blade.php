@extends('layouts.dashboard')

@section('title', 'Walk-in Enquiry')
@section('page-title', 'Walk-in Enquiry')

@section('sidebar-menu')
    <x-admin-sidebar-menu />
@endsection

@section('content')
<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb bg-light ps-3 py-2 rounded">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('admin.enquiries.index') }}" class="text-decoration-none">Enquiries</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Walk-in Enquiry</li>
    </ol>
</nav>

<div class="admin-dashboard-header mb-4">
    <div>
        <h2 class="admin-dashboard-title mb-1">Record Walk-in Enquiry</h2>
        <p class="admin-dashboard-subtitle mb-0">Register a new customer walk-in enquiry</p>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card glass-card border-0">
            <div class="card-header bg-transparent border-0 py-3">
                <h5 class="fw-bold mb-0 text-dark">New Walk-in Enquiry Form</h5>
            </div>

            <div class="card-body">
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

                <form action="{{ route('admin.enquiries.store-walk-in') }}" method="POST">
                    @csrf

                    <div class="row">
                        <!-- Name -->
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label fw-bold">Full Name <span class="text-danger">*</span></label>
                            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter customer name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label fw-bold">Phone Number <span class="text-danger">*</span></label>
                            <input type="tel" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Enter phone number" value="{{ old('phone') }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email (Optional) -->
                        <div class="col-md-12 mb-3">
                            <label for="email" class="form-label fw-bold">Email Address <span class="text-muted">(Optional)</span></label>
                            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter email address" value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Preferred Date (Optional) -->
                        <div class="col-md-6 mb-3">
                            <label for="preferred_date" class="form-label fw-bold">Preferred Consultation Date <span class="text-muted">(Optional)</span></label>
                            <input type="date" id="preferred_date" name="preferred_date" class="form-control @error('preferred_date') is-invalid @enderror" value="{{ old('preferred_date') }}">
                            @error('preferred_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Message (Optional) -->
                        <div class="col-md-12 mb-3">
                            <label for="message" class="form-label fw-bold">Notes / Message <span class="text-muted">(Optional)</span></label>
                            <textarea id="message" name="message" class="form-control @error('message') is-invalid @enderror" placeholder="Add any additional notes about the enquiry" rows="4">{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Buttons -->
                        <div class="col-md-12 d-flex gap-2">
                            <button type="submit" class="btn btn-primary btn-lg fw-bold">
                                <i class="bi bi-check-circle me-2"></i>Record Enquiry
                            </button>
                            <a href="{{ route('admin.enquiries.index') }}" class="btn btn-secondary btn-lg fw-bold">
                                <i class="bi bi-x-circle me-2"></i>Cancel
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Info Sidebar -->
    <div class="col-lg-4">
        <div class="card glass-card border-0 mb-3">
            <div class="card-body">
                <h6 class="fw-bold text-dark mb-3">
                    <i class="bi bi-info-circle text-info me-2"></i>Walk-in Enquiry Info
                </h6>
                <p class="small text-secondary mb-2">
                    <strong>Source:</strong> Walk-in
                </p>
                <p class="small text-secondary mb-2">
                    <strong>Status:</strong> <span class="badge bg-success">Active</span>
                </p>
                <p class="small text-secondary">
                    <strong>Email:</strong> An email notification will be sent to the admin team.
                </p>
            </div>
        </div>

        <div class="card glass-card border-0">
            <div class="card-body">
                <h6 class="fw-bold text-dark mb-3">
                    <i class="bi bi-lightning-fill text-warning me-2"></i>Quick Tips
                </h6>
                <ul class="small text-secondary ps-3">
                    <li class="mb-2">Name and Phone are required fields</li>
                    <li class="mb-2">Email is optional but recommended</li>
                    <li class="mb-2">Add notes for any special requests</li>
                    <li>The enquiry will be logged and an email sent immediately</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection
