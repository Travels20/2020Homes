@extends('layouts.dashboard')

@section('title', 'Enquiries')
@section('page-title', 'Enquiries')

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
        <li class="breadcrumb-item active" aria-current="page">Enquiries</li>
    </ol>
</nav>

<div class="admin-dashboard-header mb-4">
    <div>
        <h2 class="admin-dashboard-title mb-1">Enquiries</h2>
        <p class="admin-dashboard-subtitle mb-0">View and manage all customer enquiries and consultation requests.</p>
    </div>
</div>

<div class="card glass-card border-0">
    <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center py-3">
        <h5 class="fw-bold mb-0 text-dark">All Enquiries</h5>
        <a href="{{ route('admin.enquiries.walk-in') }}" class="btn btn-primary btn-sm fw-bold">
            <i class="bi bi-plus-circle me-2"></i>Add Walk-in
        </a>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th>Source</th>
                        <th class="ps-4">Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Preferred Date</th>

                        <th>Message</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($enquiries as $enquiry)
                    <tr>
                         <td><span class="badge bg-info text-white text-capitalize">{{ str_replace('_', ' ', $enquiry->source) }}</span></td>

                        <td class="ps-4 fw-bold">{{ $enquiry->name }}</td>
                        <td><a href="mailto:{{ $enquiry->email }}" class="text-decoration-none small">{{ $enquiry->email }}</a></td>
                        <td><a href="tel:{{ $enquiry->phone }}" class="text-decoration-none fw-bold">{{ $enquiry->phone }}</a></td>
                        <td>
                            @if($enquiry->preferred_date)
                                <span class="badge bg-light text-dark">{{ $enquiry->preferred_date->format('d M Y') }}</span>
                            @else
                                <span class="text-secondary">—</span>
                            @endif
                        </td>
                        <td><small class="text-secondary">{{ $enquiry->message ? Str::limit($enquiry->message, 30) : '—' }}</small></td>
                        <td><small class="text-secondary">{{ $enquiry->created_at->format('d M Y H:i') }}</small></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-secondary">No enquiries found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-footer bg-transparent border-top">
        {{ $enquiries->links() }}
    </div>
</div>
@endsection
