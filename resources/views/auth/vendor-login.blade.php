@extends('layouts.home')

@section('title', 'Post Property - 2020Homes')

@section('content')
<div class="vendor-login-hero min-vh-100 d-flex align-items-center py-5">
    <div class="container">
        <div class="row align-items-center">
            <!-- Left Side: Branding & Value Points -->
            <div class="col-lg-6 mb-5 mb-lg-0">
                <img src="{{ asset('images/logo.png') }}" alt="2020Homes Logo" class="img-fluid mb-4" style="max-height: 80px; ">
                <h1 class="display-4 fw-bold mb-4">Sell or rent your property <span class="text-underline">faster</span> with 2020Homes</h1>

                <div class="value-points mt-5">
                    <div class="d-flex align-items-center mb-4">
                        <div class="point-icon me-3">
                            <i class="bi bi-check-circle-fill text-success fs-4"></i>
                        </div>
                        <h5 class="mb-0">Post property for free</h5>
                    </div>
                    <div class="d-flex align-items-center mb-4">
                        <div class="point-icon me-3">
                            <i class="bi bi-check-circle-fill text-success fs-4"></i>
                        </div>
                        <h5 class="mb-0">Get verified buyers</h5>
                    </div>
                    <div class="d-flex align-items-center mb-4">
                        <div class="point-icon me-3">
                            <i class="bi bi-check-circle-fill text-success fs-4"></i>
                        </div>
                        <h5 class="mb-0">Get personalised assistance on selling faster</h5>
                    </div>
                </div>
            </div>

            <!-- Right Side: Login Card -->
            <div class="col-lg-5 offset-lg-1">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden" id="loginCard">
                    <!-- Tabs -->
                    <div class="d-flex bg-light">
                        <button class="flex-fill py-3 border-0 bg-white fw-bold text-primary border-bottom border-3 border-primary" id="ownerTab">Owner</button>
                        <button class="flex-fill py-3 border-0 bg-light text-secondary fw-bold" id="partnerTab">Partner/Builder</button>
                    </div>

                    <div class="card-body p-4 p-xl-5">
                        <p class="text-center text-secondary mb-4">New to 2020Homes? Let's get you started</p>

                        <!-- Property Type Selection -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Property Type</label>
                            <div class="row g-2">
                                <div class="col-4">
                                    <input type="radio" class="btn-check" name="property_type" id="type_plots" value="plots" checked>
                                    <label class="btn btn-outline-secondary w-100 py-2" for="type_plots">Plots</label>
                                </div>
                                <div class="col-4">
                                    <input type="radio" class="btn-check" name="property_type" id="type_flats" value="flats">
                                    <label class="btn btn-outline-secondary w-100 py-2" for="type_flats">Flats</label>
                                </div>
                                <div class="col-4">
                                    <input type="radio" class="btn-check" name="property_type" id="type_agri" value="agriculture">
                                    <label class="btn btn-outline-secondary w-100 py-2" for="type_agri">Agri Land</label>
                                </div>
                            </div>
                        </div>

                        <!-- Service Selection -->
                        {{-- <div class="mb-4">
                            <label class="form-label fw-semibold">Looking to</label>
                            <div class="row g-2">
                                <div class="col-4">
                                    <input type="radio" class="btn-check" name="service" id="service_sell" value="sell" checked>
                                    <label class="btn btn-outline-secondary w-100 py-2" for="service_sell">Sell</label>
                                </div>
                                <div class="col-4">
                                    <input type="radio" class="btn-check" name="service" id="service_rent" value="rent">
                                    <label class="btn btn-outline-secondary w-100 py-2" for="service_rent">Rent</label>
                                </div>
                            </div>
                        </div> --}}

                        <!-- Phone/Email Section -->
                        <div id="otpFormSection">
                            <div class="mb-4">
                                <div class="input-group input-group-lg border-bottom border-0">
                                    <span class="input-group-text bg-transparent border-0 ps-0 text-secondary">+91</span>
                                    <input type="text" id="contact_input" class="form-control bg-transparent border-0 shadow-none ps-1 fs-5" placeholder="Enter Phone Number or Email">
                                </div>
                            </div>

                            <button type="button" id="btnSendOTP" class="btn btn-signup-green w-100 py-3 rounded-pill fw-bold fs-5 shadow-sm text-dark">Proceed</button>
                        </div>

                        <!-- OTP Verification Section (Hidden) -->
                        <div id="verifyFormSection" style="display: none;">
                            <div class="mb-4 text-center">
                                <p class="mb-2">Enter OTP sent to <span id="display_contact" class="fw-bold"></span></p>
                                <input type="text" id="otp_input" class="form-control form-control-lg text-center fw-bold fs-2 border-0 border-bottom rounded-0 shadow-none mx-auto" style="max-width: 200px;" maxlength="6" placeholder="000000">
                            </div>
                            <button type="button" id="btnVerifyOTP" class="btn btn-signup-green w-100 py-3 rounded-pill fw-bold fs-5 shadow-sm text-dark">Verify & Login</button>
                            <div class="text-center mt-3">
                                <button type="button" id="btnResend" class="btn btn-link text-decoration-none text-primary p-0">Resend OTP</button>
                            </div>
                        </div>

                        <div class="text-center mt-5">
                            <small class="text-secondary">Existing user? <a href="{{ route('login') }}" class="text-primary text-decoration-none fw-bold">Login Here</a></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .vendor-login-hero {
        background: linear-gradient(135deg, #1e3a8a 0%, #172554 100%);
        padding-top: 120px !important;
    }
    .text-underline {
        text-decoration: underline;
        text-decoration-color: #a2d248;
        text-decoration-thickness: 3px;
        text-underline-offset: 8px;
    }
    .btn-outline-secondary {
        border-color: #e5e7eb;
        color: #4b5563;
        font-weight: 500;
    }
    .btn-check:checked + .btn-outline-secondary {
        background-color: #f3f4ff;
        border-color: #1e3a8a;
        color: #1e3a8a;
    }
    .point-icon {
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    #loginCard {
        margin-top: -20px;
    }
    @media (max-width: 991.98px) {
        .vendor-login-hero { padding-top: 100px !important; }
        #loginCard { margin-top: 0; }
    }
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function() {
        let currentContact = '';

        $('#btnSendOTP').click(function() {
            const contact = $('#contact_input').val();
            if(!contact) {
                alert('Please enter a phone number or email');
                return;
            }

            const isEmail = contact.includes('@');
            const data = isEmail ? { email: contact } : { phone: contact };
            data._token = '{{ csrf_token() }}';

            $(this).prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Sending...');

            $.post('{{ route("otp.send") }}', data)
                .done(function(response) {
                    if(response.success) {
                        currentContact = contact;
                        $('#display_contact').text(contact);
                        $('#otpFormSection').fadeOut(300, function() {
                            $('#verifyFormSection').fadeIn(300);
                        });
                    } else {
                        alert(response.message);
                        $('#btnSendOTP').prop('disabled', false).text('Proceed');
                    }
                })
                .fail(function(xhr) {
                    alert(xhr.responseJSON?.message || 'Failed to send OTP');
                    $('#btnSendOTP').prop('disabled', false).text('Proceed');
                });
        });

        $('#btnVerifyOTP').click(function() {
            const otp = $('#otp_input').val();
            if(!otp || otp.length < 6) {
                alert('Please enter 6-digit OTP');
                return;
            }

            $(this).prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Verifying...');

            $.post('{{ route("otp.verify") }}', {
                contact: currentContact,
                otp: otp,
                _token: '{{ csrf_token() }}'
            })
            .done(function(response) {
                if(response.success) {
                    window.location.href = response.redirect;
                } else {
                    alert(response.message);
                    $('#btnVerifyOTP').prop('disabled', false).text('Verify & Login');
                }
            })
            .fail(function(xhr) {
                alert(xhr.responseJSON?.message || 'Verification failed');
                $('#btnVerifyOTP').prop('disabled', false).text('Verify & Login');
            });
        });

        // Tab switching
        $('#ownerTab').click(function() {
            $(this).addClass('bg-white text-primary border-bottom border-3 border-primary').removeClass('bg-light text-secondary');
            $('#partnerTab').addClass('bg-light text-secondary').removeClass('bg-white text-primary border-bottom border-3 border-primary');
        });
        $('#partnerTab').click(function() {
            $(this).addClass('bg-white text-primary border-bottom border-3 border-primary').removeClass('bg-light text-secondary');
            $('#ownerTab').addClass('bg-light text-secondary').removeClass('bg-white text-primary border-bottom border-3 border-primary');
        });
    });
</script>
@endpush
@endsection
