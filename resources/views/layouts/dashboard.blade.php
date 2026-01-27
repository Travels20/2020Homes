<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', '2020Homes') }} - @yield('title', 'Dashboard')</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    
    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <a href="{{ route('dashboard') }}" class="sidebar-logo">
            @php $logoUrl = \App\Models\SiteSetting::url('logo'); @endphp
            @if($logoUrl)
                <img src="{{ $logoUrl }}" alt="Logo" style="max-height: 40px;" class="me-2">
            @else
                <i class="bi bi-house-heart-fill"></i>
            @endif
            <span>{{ \App\Models\SiteSetting::get('site_name', '2020Homes') }}</span>
        </a>
        
        <nav>
            <ul class="sidebar-nav">
                @yield('sidebar-menu')
            </ul>
        </nav>
        
        <div class="mt-auto pt-4">
            <div class="sidebar-footer">
                <a href="{{ route('logout') }}" 
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   class="sidebar-nav-link text-danger">
                    <i class="bi bi-box-arrow-right sidebar-nav-icon"></i>
                    <span>Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </aside>
    
    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Navbar -->
        <div class="top-navbar">
            <div class="d-flex align-items-center">
                <button class="navbar-icon-btn d-lg-none me-3" id="sidebarToggle">
                    <i class="bi bi-list"></i>
                </button>
                <h1 class="navbar-title">@yield('page-title', 'Dashboard')</h1>
            </div>
            
            <div class="navbar-actions">
                <button class="navbar-icon-btn" id="darkModeToggle" data-bs-toggle="tooltip" title="Toggle Dark Mode">
                    <i class="bi bi-moon-fill"></i>
                </button>
                
                <button class="navbar-icon-btn" data-bs-toggle="tooltip" title="Notifications">
                    <i class="bi bi-bell-fill"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 10px;">
                        3
                    </span>
                </button>
                
                <div class="dropdown">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'User') }}&background=667eea&color=fff" 
                         alt="User Avatar" 
                         class="user-avatar" 
                         data-bs-toggle="dropdown" 
                         aria-expanded="false">
                    
                    <ul class="dropdown-menu dropdown-menu-end glass-card">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Settings</a></li>
                        <li><hr class="dropdown-divider" style="border-color: rgba(0,0,0,0.1)"></li>
                        <li>
                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right me-2"></i>Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Alerts -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show glass-card" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show glass-card" role="alert">
                <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show glass-card" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        <!-- Page Content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
    </main>
    
    @stack('scripts')
</body>
</html>
