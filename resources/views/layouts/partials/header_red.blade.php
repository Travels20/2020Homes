 <!-- Navbar -->
    @php
        $rawType = strtolower((string) request('type', ''));
        $typeMap = [
            'plot' => 'plot',
            'plots' => 'plot',
            'flat' => 'flat',
            'flats' => 'flat',
            'agriculture' => 'agriculture',
        ];
        $activeType = $typeMap[$rawType] ?? null;
        $onPropertyList = request()->routeIs('front.properties');
    @endphp

    <nav class="navbar navbar-expand-lg fixed-top glass-navbar">
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
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $onPropertyList && $activeType === 'plot' ? 'active' : '' }}" href="{{ route('front.properties', ['type' => 'plot']) }}">Plots</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $onPropertyList && $activeType === 'flat' ? 'active' : '' }}" href="{{ route('front.properties', ['type' => 'flat']) }}">Flats</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $onPropertyList && $activeType === 'agriculture' ? 'active' : '' }}" href="{{ route('front.properties', ['type' => 'agriculture']) }}">Agri Land</a>
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
                    </ul>

                    <a class="btn btn-signup-green px-4 py-2 rounded-pill fw-bold" href="https://wa.me/919445002020" target="_blank" title="Chat with us on WhatsApp">
                        <i class="bi bi-whatsapp"> 944 500 2020</i>
                    </a>

                    {{-- @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-signup-green px-4 py-2 rounded-pill fw-bold">Dashboard</a>
                    @else
                        <a href="{{ route('vendor.register.page') }}" class="btn btn-signup-green px-4 py-2 rounded-pill fw-bold">Post Property <small>(Free)</small></a>
                    @endauth --}}
                </div>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
