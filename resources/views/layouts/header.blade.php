<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', \App\Models\SiteSetting::get('site_name', '2020Homes')) - {{ \App\Models\SiteSetting::get('site_tagline', 'Premium Real Estate') }}</title>

    <!-- Dynamic Favicon -->
    @php $faviconUrl = \App\Models\SiteSetting::url('favicon'); @endphp
    @if($faviconUrl)
        <link rel="icon" type="image/x-icon" href="{{ $faviconUrl }}">
    @else
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @endif

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>
<body class="font-sans antialiased bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top glass-navbar" style="background: white!important; padding: 10px 0 !important;">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ url('/') }}">
                @php $logoUrl = \App\Models\SiteSetting::url('logo'); @endphp
                @if($logoUrl)
                    <img src="{{ $logoUrl }}" alt="Logo" class="img-fluid" style="max-height: 55px;">
                @else
                    <img src="{{ asset('images/logo.png') }}" alt="2020Homes Logo" class="img-fluid" style="max-height: 55px;">
                @endif
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="ms-auto d-flex align-items-center">
                    <ul class="navbar-nav red-pill-nav-container me-3">
                        {{-- <li class="nav-item">
                            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('plots') ? 'active' : '' }}" href="{{ route('front.properties', ['type' => 'plots']) }}">Plots</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('flats') ? 'active' : '' }}" href="{{ route('front.properties', ['type' => 'flats']) }}">Flats</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('agriculture') ? 'active' : '' }}" href="{{ route('front.properties', ['type' => 'agriculture']) }}"> Agri Land</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link {{ request()->is('about*') ? 'active' : '' }}" href="{{ route('front.about') }}">About Us</a>
                        </li> --}}
                        <!-- <li class="nav-item">
                            <a class="nav-link {{ request()->is('properties*') ? 'active' : '' }}" href="{{ route('front.properties') }}">Property List</a>
                        </li> -->
                        {{-- <li class="nav-item dropdown">
                            <a
                                class="nav-link dropdown-toggle {{ request()->is('properties*') ? 'active fw-bold text-primary' : '' }}"
                                href="{{ route('front.properties') }}"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                            >
                                Properties
                            </a>

                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('front.properties', ['type' => 'plots']) }}">
                                        Plots
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('front.properties', ['type' => 'flats']) }}">
                                        Flats
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('front.properties', ['type' => 'agriculture']) }}">
                                        Agricultural Land
                                    </a>
                                </li>
                            </ul>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('contact*') ? 'active' : '' }}" href="{{ route('front.contact') }}">NRI Property</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('contact*') ? 'active' : '' }}" href="{{ route('front.contact') }}">944 500 2020</a>
                        </li>
                    </ul>

                    {{-- @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-signup-green px-4 py-2 rounded-pill fw-bold">Dashboard</a>
                    @else
                        <a href="{{ route('vendor.register.page') }}" class="btn btn-signup-green px-4 py-2 rounded-pill fw-bold">Post Property <small>(Free)</small></a>
                    @endauth --}}
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('layouts.partials.footer')


</body>
</html>
