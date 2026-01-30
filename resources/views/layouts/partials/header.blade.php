<!-- Enhanced Modern Navbar -->
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

<style>
    /* Modern Navbar Styles */
    .modern-navbar {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
        padding: 0.75rem 0;
        transition: all 0.3s ease;
    }

    .modern-navbar.scrolled {
        background: rgba(255, 255, 255, 0.98);
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.12);
        padding: 0.5rem 0;
    }

    .navbar-brand {
        transition: transform 0.3s ease;
        margin-right: 3.5rem !important;
    }

    .navbar-brand:hover {
        transform: scale(1.05);
    }

    .navbar-brand img {
        max-height: 55px;
        transition: max-height 0.3s ease;
    }

    .modern-navbar.scrolled .navbar-brand img {
        max-height: 45px;
    }

    /* Navigation Links */
    .modern-nav-link {
        position: relative;
        color: #2c3e50 !important;
        font-weight: 500;
        padding: 0.5rem 1rem !important;
        margin: 0 0.25rem;
        transition: all 0.3s ease;
        font-size: 0.95rem;
        letter-spacing: 0.3px;
    }

    .modern-nav-link::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        width: 0;
        height: 2px;
        background: linear-gradient(90deg, #10b981, #059669);
        transform: translateX(-50%);
        transition: width 0.3s ease;
    }

    .modern-nav-link:hover {
        color: #10b981 !important;
    }

    .modern-nav-link:hover::before {
        width: 80%;
    }

    .modern-nav-link.active {
        color: #10b981 !important;
        font-weight: 600;
    }

    .modern-nav-link.active::before {
        width: 80%;
    }

    /* WhatsApp Button */
    .whatsapp-head {
        background: linear-gradient(135deg, #25d366 0%, #128c7e 100%);
        color: white !important;
        padding: 0.6rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        border: none;
        box-shadow: 0 4px 15px rgba(37, 211, 102, 0.3);
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9rem;
    }

    .whatsapp-head:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(37, 211, 102, 0.4);
        background: linear-gradient(135deg, #128c7e 0%, #25d366 100%);
    }

    .whatsapp-head i {
        font-size: 1.1rem;
    }

    /* Mobile Toggle */
    .navbar-toggler {
        border: none;
        padding: 0.5rem;
    }

    .navbar-toggler:focus {
        box-shadow: none;
    }

    .navbar-toggler-icon {
        width: 25px;
        height: 2px;
        background-color: #2c3e50;
        display: block;
        position: relative;
        transition: all 0.3s ease;
    }

    .navbar-toggler-icon::before,
    .navbar-toggler-icon::after {
        content: '';
        width: 25px;
        height: 2px;
        background-color: #2c3e50;
        position: absolute;
        left: 0;
        transition: all 0.3s ease;
    }

    .navbar-toggler-icon::before {
        top: -8px;
    }

    .navbar-toggler-icon::after {
        top: 8px;
    }

    /* Responsive Design */
    @media (max-width: 991.98px) {
        .modern-navbar {
            padding: 0.5rem 0;
        }

        .navbar-collapse {
            background: white;
            margin-top: 1rem;
            padding: 1rem;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .modern-nav-link {
            padding: 0.75rem 1rem !important;
            border-radius: 8px;
            margin: 0.25rem 0;
        }

        .modern-nav-link:hover {
            background-color: #f0fdf4;
        }

        .modern-nav-link::before {
            display: none;
        }

        .modern-nav-link.active {
            background-color: #d1fae5;
        }

        .whatsapp-head {
            margin-top: 1rem;
            width: 100%;
            justify-content: center;
        }

        .navbar-nav {
            margin-bottom: 0 !important;
        }
    }

    @media (min-width: 992px) {
        .navbar-nav {
            align-items: center;
        }
    }

    /* Animation */
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .navbar-collapse.show,
    .navbar-collapse.collapsing {
        animation: fadeInDown 0.3s ease;
    }
</style>

<nav class="navbar navbar-expand-lg fixed-top modern-navbar">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ url('/') }}">
            @php $logoUrl = \App\Models\SiteSetting::url('logo'); @endphp
            @if($logoUrl)
                <img src="{{ $logoUrl }}" alt="Logo" class="img-fluid">
            @else
                <img src="{{ asset('images/logo.png') }}" alt="2020Homes Logo" class="img-fluid">
            @endif
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="ms-auto d-flex align-items-center">
                <ul class="navbar-nav me-lg-3 mb-0">
                    <li class="nav-item">
                        <a class="nav-link modern-nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link modern-nav-link {{ $onPropertyList && $activeType === 'plot' ? 'active' : '' }}" href="{{ route('front.properties', ['type' => 'plot']) }}">
                            Plots
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link modern-nav-link {{ $onPropertyList && $activeType === 'flat' ? 'active' : '' }}" href="{{ route('front.properties', ['type' => 'flat']) }}">
                            Flats
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link modern-nav-link {{ $onPropertyList && $activeType === 'agriculture' ? 'active' : '' }}" href="{{ route('front.properties', ['type' => 'agriculture']) }}">
                            Agri Land
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link modern-nav-link {{ request()->is('contact*') ? 'active' : '' }}" href="{{ route('front.contact') }}">
                            NRI Property
                        </a>
                    </li>
                </ul>

                <a class="btn whatsapp-head " href="https://wa.me/919445002020" target="_blank" title="Chat with us on WhatsApp">
                    <i class="bi bi-whatsapp"></i>
                    <span>944 500 2020</span>
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- Add Scroll Effect Script -->
{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        const navbar = document.querySelector('.modern-navbar');

        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    });
</script> --}}
