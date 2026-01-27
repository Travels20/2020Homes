@extends('layouts.dashboard')

@section('title', 'System Logs')
@section('page-title', 'System Logs')

@section('sidebar-menu')
    <li class="sidebar-nav-item">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-nav-link">
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
        <a href="{{ route('admin.settings.index') }}" class="sidebar-nav-link">
            <i class="bi bi-gear sidebar-nav-icon"></i>
            <span>Site Settings</span>
        </a>
    </li>
    <li class="sidebar-nav-item">
        <a href="{{ route('admin.logs.index') }}" class="sidebar-nav-link active">
            <i class="bi bi-journal-text sidebar-nav-icon"></i>
            <span>Logs</span>
        </a>
    </li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card glass-card border-0">
            <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center py-3">
                <h5 class="fw-bold mb-0">Laravel Logs</h5>
                <form action="{{ route('admin.logs.index') }}" method="GET" class="d-flex gap-2">
                    <input type="date" name="date" class="form-control" value="{{ $date }}" onchange="this.form.submit()">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>
            </div>
            <div class="card-body">
                @if(count($logs) > 0)
                    <div class="bg-dark text-light p-3 rounded" style="max-height: 600px; overflow-y: auto; font-family: monospace; font-size: 0.85rem;">
                        @foreach($logs as $log)
                            <div class="mb-2 border-bottom border-secondary pb-2">
                                {{ $log }}
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5 text-secondary">
                        <i class="bi bi-info-circle fs-1 mb-3 d-block"></i>
                        <p>No log entries found for {{ $date }}.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
