<!-- Top Header Bar - Add this right after <body> tag -->
<div class="top-header bg-dark text-white py-2">
    <div class="container">
        <div class="row align-items-center">
            <!-- Left: Social Media -->
            <div class="col-md-6 col-12 text-center text-md-start">
                <div class="d-flex align-items-center justify-content-center justify-content-md-start gap-3">
                    <span class="small d-none d-md-inline">Follow Us:</span>
                    <a href="https://facebook.com" class="text-white"><i class="bi bi-facebook"></i></a>
                    <a href="https://twitter.com" class="text-white"><i class="bi bi-twitter"></i></a>
                    <a href="https://instagram.com" class="text-white"><i class="bi bi-instagram"></i></a>
                    <a href="https://linkedin.com" class="text-white"><i class="bi bi-linkedin"></i></a>
                    <a href="https://youtube.com" class="text-white"><i class="bi bi-youtube"></i></a>
                </div>
            </div>

            <!-- Right: Contact & Login -->
            <div class="col-md-6 col-12 text-center text-md-end mt-2 mt-md-0">
                <div class="d-flex align-items-center justify-content-center justify-content-md-end gap-3">
                    <a href="tel:+919876543210" class="text-white text-decoration-none small">
                        <i class="bi bi-telephone-fill me-1"></i>+91 98765 43210
                    </a>
                    <a href="/contact" class="btn btn-sm btn-outline-light">Contact</a>
                    @auth
                        <a href="/dashboard" class="btn btn-sm btn-primary">Dashboard</a>
                    @else
                        <a href="/login" class="btn btn-sm btn-primary">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.top-header {
    font-size: 0.875rem;
}
.top-header a {
    transition: all 0.3s ease;
}
.top-header a:hover {
    opacity: 0.8;
    transform: translateY(-2px);
}
</style>
