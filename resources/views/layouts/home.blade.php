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
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}">
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

    <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
      integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4jGQ0Y7xX+9W2y6a2F8Xw=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body class="font-sans antialiased bg-light">

        <!-- Header -->
    @include('layouts.partials.header')

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Floating Action Buttons Container -->
    <div class="floating-buttons-container">
        <!-- Scroll to Top Button (Bottom Left) -->
        <button id="scrollTopBtn" class="floating-btn scroll-top" type="button" title="Scroll to Top">
            <i class="bi bi-arrow-up"></i>
        </button>

        <!-- WhatsApp Chat Button (Bottom Right) -->
        <a href="https://wa.me/919445002020"
           target="_blank"
           rel="noopener noreferrer"
           class="floating-btn whatsapp-btn"
           title="Chat with us on WhatsApp">
           <i class="bi bi-whatsapp"></i>
        </a>
    </div>


    <!-- Footer -->
    @include('layouts.partials.footer')

<script>
document.addEventListener("DOMContentLoaded", function () {
    const scrollBtn = document.getElementById("scrollTopBtn");

    // Show / hide button
    window.addEventListener("scroll", function () {
        if (window.scrollY > 200) {
            scrollBtn.style.display = "flex";
        } else {
            scrollBtn.style.display = "none";
        }
    });

    // Scroll to top on click
    scrollBtn.addEventListener("click", function () {
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    });
});
</script>



</body>
</html>
