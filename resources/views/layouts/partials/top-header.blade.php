<!-- Top Header Bar -->
<div class="top-header bg-dark text-white py-2">
    <div class="container">
        <div class="row align-items-center">
            <!-- Left: Social Media -->
            <div class="col-md-6 col-12 text-center text-md-start">
                <div class="d-flex align-items-center justify-content-center justify-content-md-start gap-3">
                    {{-- <span class="small d-none d-md-inline">Follow Us:</span> --}}
                    <a href="https://facebook.com" class="text-white" target="_blank"><i class="bi bi-facebook fs-5"></i></a>
                    <a href="https://twitter.com" class="text-white" target="_blank"><i class="bi bi-twitter fs-5"></i></a>
                    <a href="https://instagram.com" class="text-white" target="_blank"><i class="bi bi-instagram fs-5"></i></a>
                    <a href="https://linkedin.com" class="text-white" target="_blank"><i class="bi bi-linkedin fs-5"></i></a>
                    <a href="https://youtube.com" class="text-white" target="_blank"><i class="bi bi-youtube fs-5"></i></a>
                </div>
            </div>

            <!-- Right: Contact & Login -->
            <div class="col-md-6 col-12 text-center text-md-end mt-2 mt-md-0">
                <div class="d-flex align-items-center justify-content-center justify-content-md-end gap-3">
                    {{-- <a href="tel:+919445002020" class="text-white text-decoration-none small">
                        <i class="bi bi-telephone-fill me-1"></i>+91 944 500 2020
                    </a> --}}
                    <a class=" btn btn-signup-green rounded-pill " href="https://wa.me/919445002020" target="_blank" title="Chat with us on WhatsApp">
                        <i class="bi bi-whatsapp"></i>
                        <span>944 500 2020</span>
                    </a>
                    {{-- <a href="/contact" class="btn btn-sm btn-outline-light">Contact</a> --}}
                    {{-- @auth
                        <a href="/dashboard" class="btn btn-sm btn-primary">Dashboard</a>
                    @else --}}
                        <a href="{{ route('login') }}" class="btn btn-sm btn-primary">Login</a>
                    {{-- @endauth --}}

                </div>
            </div>
        </div>
    </div>
</div>

<style>
.top-header {
    font-size: 0.875rem;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1031; /* Higher than navbar */
}
.top-header a {
    transition: all 0.3s ease;
}
.top-header a:hover {
    opacity: 0.8;
    transform: translateY(-2px);
}
</style>
