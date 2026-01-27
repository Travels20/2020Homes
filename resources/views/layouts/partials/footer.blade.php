    <footer class="bg-dark text-white pt-5 pb-3 mt-auto">
        <div class="container">
            <div class="row g-4 mb-5">
                <div class="col-lg-4">
                    <a class="d-flex align-items-center text-white text-decoration-none mb-3" href="#">
                        <div class="bg-gradient-primary text-white rounded p-1 me-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                            <i class="bi bi-house-heart-fill"></i>
                        </div>
                        <span class="fw-bold fs-4">2020Homes</span>
                    </a>
                    <p class="text-secondary mb-4">Your trusted partner in finding the perfect property. We make real estate simple, transparent, and efficient.</p>
                    <div class="d-flex gap-3">
                        <a href="#" class="btn btn-sm btn-outline-light rounded-circle" style="width: 32px; height: 32px; padding: 0; display: flex; align-items: center; justify-content: center;"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="btn btn-sm btn-outline-light rounded-circle" style="width: 32px; height: 32px; padding: 0; display: flex; align-items: center; justify-content: center;"><i class="bi bi-twitter-x"></i></a>
                        <a href="#" class="btn btn-sm btn-outline-light rounded-circle" style="width: 32px; height: 32px; padding: 0; display: flex; align-items: center; justify-content: center;"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="btn btn-sm btn-outline-light rounded-circle" style="width: 32px; height: 32px; padding: 0; display: flex; align-items: center; justify-content: center;"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-6">
                    <h5 class="fw-bold mb-3">Quick Links</h5>
                    <ul class="list-unstyled text-secondary">
                        <li class="mb-2"><a href="{{ url('/') }}" class="text-decoration-none text-secondary hover-text-white">Home</a></li>
                        <li class="mb-2"><a href="{{ route('front.properties') }}" class="text-decoration-none text-secondary hover-text-white">Properties</a></li>
                        <li class="mb-2"><a href="{{ route('front.about') }}" class="text-decoration-none text-secondary hover-text-white">About Us</a></li>
                        <li class="mb-2"><a href="{{ route('front.contact') }}" class="text-decoration-none text-secondary hover-text-white">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-6">
                    <h5 class="fw-bold mb-3">Property Types</h5>
                    <ul class="list-unstyled text-secondary">
                        <li class="mb-2"><a href="#" class="text-decoration-none text-secondary hover-text-white">Residential Plots</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-secondary hover-text-white">Luxury Flats</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-secondary hover-text-white">Agricultural Land</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-secondary hover-text-white">Commercial</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h5 class="fw-bold mb-3">Contact Us</h5>
                    <ul class="list-unstyled text-secondary">
                        <li class="mb-2 d-flex"><i class="bi bi-geo-alt me-2 text-primary"></i>  alda one, 28th Cross St., near Corner building, Indira Nagar, Adyar, Chennai, Tamil Nadu 600020</li>
                        <li class="mb-2 d-flex"><i class="bi bi-telephone me-2 text-primary"></i> +91 94455 52020</li>
                        <li class="mb-2 d-flex"><i class="bi bi-envelope me-2 text-primary"></i> info@2020homes.com</li>
                    </ul>
                </div>
            </div>
            <div class="border-top border-secondary pt-3 text-center text-secondary small">
                &copy; {{ date('Y') }} 2020Homes. All rights reserved.
            </div>
        </div>
    </footer>
