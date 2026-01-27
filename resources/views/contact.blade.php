@extends('layouts.header')

@section('title', 'Contact Us')

@section('content')
<!-- Hero Section -->
<div class="position-relative py-5 bg-gradient-primary text-white text-center">
    <div class="container py-5">
        <h1 class="display-4 fw-bold mb-3">Contact Us</h1>
        <p class="lead mb-0 opacity-75">We'd love to hear from you. Get in touch today!</p>
    </div>
    <div class="position-absolute bottom-0 start-0 w-100 overflow-hidden" style="line-height: 0;">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none" style="position: relative; display: block; width: calc(100% + 1.3px); height: 60px;">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" fill="#ffffff"></path>
        </svg>
    </div>
</div>

<div class="container py-5">
    <div class="row g-5">
        <div class="col-lg-5">
            <div class="card border-0 shadow-lg h-100">
                <div class="card-body p-4 p-md-5">
                    <h3 class="fw-bold mb-4">Get in Touch</h3>

                    <div class="d-flex mb-4">
                        <div class="flex-shrink-0 btn-gradient-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="bi bi-geo-alt-fill text-white fs-5"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="fw-bold mb-1">Our Location</h5>
                            <p class="text-secondary mb-0">123 Real Estate Avenue,<br>Jubilee Hills, Hyderabad, 500033</p>
                        </div>
                    </div>

                    <div class="d-flex mb-4">
                        <div class="flex-shrink-0 btn-gradient-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="bi bi-telephone-fill text-white fs-5"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="fw-bold mb-1">Phone Number</h5>
                            <p class="text-secondary mb-0">+91 98765 43210<br>+91 40 1234 5678</p>
                        </div>
                    </div>

                    <div class="d-flex mb-4">
                        <div class="flex-shrink-0 btn-gradient-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="bi bi-envelope-fill text-white fs-5"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="fw-bold mb-1">Email Address</h5>
                            <p class="text-secondary mb-0">info@2020homes.com<br>support@2020homes.com</p>
                        </div>
                    </div>

                    <hr class="my-4">

                    <h5 class="fw-bold mb-3">Follow Us</h5>
                    <div class="d-flex gap-2">
                        <a href="#" class="btn btn-outline-primary rounded-circle"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="btn btn-outline-primary rounded-circle"><i class="bi bi-twitter-x"></i></a>
                        <a href="#" class="btn btn-outline-primary rounded-circle"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="btn btn-outline-primary rounded-circle"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <h2 class="fw-bold mb-3">Send us a Message</h2>
            <p class="text-secondary mb-4">Have a question or want to list your property? Fill out the form below.</p>

            <form>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="name" placeholder="Your Name">
                            <label for="name">Your Name</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="email" class="form-control" id="email" placeholder="Your Email">
                            <label for="email">Your Email</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="subject" placeholder="Subject">
                            <label for="subject">Subject</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a message here" id="message" style="height: 150px"></textarea>
                            <label for="message">Message</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-gradient-primary btn-lg px-5">Send Message</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
