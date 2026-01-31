@extends('layouts.dashboard')

@section('title', 'Users')
@section('page-title', 'Users')

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
        <li class="breadcrumb-item active" aria-current="page">Users</li>
    </ol>
</nav>

<div class="admin-dashboard-header mb-4">
    <div>
        <h2 class="admin-dashboard-title mb-1">Users</h2>
        <p class="admin-dashboard-subtitle mb-0">View and manage all system users and their roles.</p>
    </div>
</div>

<div class="card glass-card border-0">
    <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center py-3">
        <h5 class="fw-bold mb-0 text-dark">All Users</h5>
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
                        <th>Created Date</th>
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
                        <td><small class="text-secondary">{{ $user->email }}</small></td>
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
                        <td><small class="text-secondary">{{ $user->created_at->format('d M Y') }}</small></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-secondary">No users found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-footer bg-transparent border-top">
        {{ $users->links() }}
    </div>
</div>
@endsection
