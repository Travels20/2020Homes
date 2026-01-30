@extends('layouts.dashboard')
@section('title', 'Add Property')

@section('sidebar-menu')
    <li class="sidebar-nav-item">
        <a href="{{ route('vendor.dashboard') }}" class="sidebar-nav-link">
            <i class="bi bi-speedometer2 sidebar-nav-icon"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="sidebar-nav-item">
        <a href="{{ route('vendor.properties.index') }}" class="sidebar-nav-link">
            <i class="bi bi-building sidebar-nav-icon"></i>
            <span>My Properties</span>
        </a>
    </li>
    <li class="sidebar-nav-item">
        <a href="{{ route('vendor.properties.create') }}" class="sidebar-nav-link active">
            <i class="bi bi-plus-circle sidebar-nav-icon"></i>
            <span>Add Property</span>
        </a>
    </li>
@endsection

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold mb-1">Add New Property</h2>
                <p class="text-secondary mb-0">Create a new property listing</p>
            </div>
            <a href="{{ route('vendor.properties.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-2"></i>Back to List
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card glass-card border-0">
            <div class="card-body p-4">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('vendor.properties.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <h5 class="fw-bold text-primary mb-3">Basic Information</h5>
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Property Title</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required placeholder="e.g. Luxury Villa in Jubilee Hills">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Property Type</label>
                            <select name="property_type" class="form-select" required>
                                <option value="">Select Type</option>
                                <option value="plot" {{ old('property_type') == 'plot' ? 'selected' : '' }}>Plot / Land</option>
                                <option value="flat" {{ old('property_type') == 'flat' ? 'selected' : '' }}>Flat / Apartment</option>
                                <option value="agriculture" {{ old('property_type') == 'agriculture' ? 'selected' : '' }}>Agricultural Land</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Listing Type</label>
                            <select name="listing_type" class="form-select" required>
                                <option value="sale" {{ old('listing_type') == 'sale' ? 'selected' : '' }}>For Sale</option>
                                <option value="rent" {{ old('listing_type') == 'rent' ? 'selected' : '' }}>For Rent</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
                    </div>

                    <h5 class="fw-bold text-primary mb-3 mt-4">Location Details</h5>
                    <div class="row mb-3">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">City</label>
                            <input type="text" name="city" class="form-control" value="{{ old('city') }}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">District</label>
                            <input type="text" name="state" class="form-control" value="{{ old('state') }}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Address (Optional)</label>
                            <input type="text" name="address" class="form-control" value="{{ old('address') }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Latitude</label>
                            <input type="text" name="latitude" id="latitude" class="form-control" value="{{ old('latitude') }}" placeholder="e.g. 13.082680">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Longitude</label>
                            <input type="text" name="longitude" id="longitude" class="form-control" value="{{ old('longitude') }}" placeholder="e.g. 80.270718">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label d-flex justify-content-between align-items-center">
                                <span>Pick on Map</span>
                                <button type="button" id="btn-use-location" class="btn btn-sm btn-outline-primary">
                                    Use my location
                                </button>
                            </label>
                            <div id="map" style="height: 220px; border-radius: 0.75rem;"></div>
                        </div>
                    </div>

                    @php
                        $oldNearby = old('nearby_places');
                        $nearbyRows = is_array($oldNearby) && count($oldNearby) ? $oldNearby : [['label' => '', 'distance' => '']];
                    @endphp
                    <div class="mb-3">
                        <label class="form-label d-flex justify-content-between align-items-center">
                            <span>Nearby famous places (hospital, school, bus stand)</span>
                            <button type="button" class="btn btn-sm btn-outline-primary" id="btn-add-nearby">Add place</button>
                        </label>
                        <div id="nearby-places-wrapper" class="d-flex flex-column gap-2">
                            @foreach($nearbyRows as $index => $row)
                                <div class="row g-2 align-items-center nearby-place-row" data-index="{{ $index }}">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="nearby_places[{{ $index }}][label]"
                                               value="{{ $row['label'] ?? '' }}" placeholder="e.g. ABC Hospital">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" name="nearby_places[{{ $index }}][distance]"
                                               value="{{ $row['distance'] ?? '' }}" placeholder="e.g. 1.2 km">
                                    </div>
                                    <div class="col-md-2 d-flex justify-content-end">
                                        <button type="button" class="btn btn-outline-danger btn-sm btn-remove-nearby">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    @php
                        $oldFaqs = old('faqs');
                        $faqRows = is_array($oldFaqs) && count($oldFaqs) ? $oldFaqs : [['question' => '', 'answer' => '']];
                    @endphp
                    <div class="mb-3">
                        <label class="form-label d-flex justify-content-between align-items-center">
                            <span>Frequently Asked Questions (FAQ)</span>
                            <button type="button" class="btn btn-sm btn-outline-primary" id="btn-add-faq">Add FAQ</button>
                        </label>
                        <div id="faqs-wrapper" class="d-flex flex-column gap-2">
                            @foreach($faqRows as $index => $row)
                                <div class="row g-2 align-items-center faq-row" data-index="{{ $index }}">
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" name="faqs[{{ $index }}][question]"
                                               value="{{ $row['question'] ?? '' }}" placeholder="Question">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" name="faqs[{{ $index }}][answer]"
                                               value="{{ $row['answer'] ?? '' }}" placeholder="Answer">
                                    </div>
                                    <div class="col-md-2 d-flex justify-content-end">
                                        <button type="button" class="btn btn-outline-danger btn-sm btn-remove-faq">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <h5 class="fw-bold text-primary mb-3 mt-4">Pricing & Area</h5>
                    <div class="row mb-3">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Price (₹)</label>
                            <input type="number" name="price" id="price_input" class="form-control" value="{{ old('price') }}" required step="0.01" placeholder="Enter price in rupees">
                            <div id="price_display" class="mt-2 p-2" style="background-color: #f8f9fa; border-radius: 0.5rem; display: none;">
                                <div class="d-flex align-items-center gap-2">
                                    <div>
                                        <small class="text-secondary d-block">Crores</small>
                                        <span id="price_crore" class="fw-bold text-primary">₹0 Cr</span>
                                    </div>
                                    <div class="text-secondary">|</div>
                                    <div>
                                        <small class="text-secondary d-block">Lakhs</small>
                                        <span id="price_lakh" class="fw-bold text-primary">₹0 L</span>
                                    </div>
                                    <div class="ms-auto">
                                        <span id="price_indicator" class="badge bg-danger" style="font-size: 0.9rem;">
                                            <i class="bi bi-x-circle me-1"></i>Invalid
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Area Size</label>
                            <input type="number" name="area" class="form-control" value="{{ old('area') }}" required step="0.01">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Area Unit</label>
                            <select name="area_unit" class="form-select">
                                <option value="sq_ft">Sq. Ft.</option>
                                <option value="sq_yard">Sq. Yard</option>
                                <option value="acre">Acre</option>
                                <option value="guntha">Guntha</option>
                            </select>
                        </div>
                    </div>

                    <div id="flat-details" style="display: none;">
                        <h5 class="fw-bold text-primary mb-3 mt-4">Flat Details</h5>
                        <div class="row mb-3">
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Bedrooms</label>
                                <input type="number" name="bedrooms" class="form-control" value="{{ old('bedrooms') }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Bathrooms</label>
                                <input type="number" name="bathrooms" class="form-control" value="{{ old('bathrooms') }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Furnished</label>
                                <select name="furnished" class="form-select">
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <h5 class="fw-bold text-primary mb-3 mt-4">Property Images</h5>
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Feature Image</label>
                            <div class="mb-3">
                                <img id="feature_preview" src="#" alt="Preview" class="img-thumbnail d-none" style="height: 150px; width: 100%; object-fit: cover;">
                            </div>
                            <input type="file" name="feature_image" id="feature_input" class="form-control" accept="image/*">
                            <small class="text-secondary">Main image shown in cards.</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Banner Image</label>
                            <div class="mb-3">
                                <img id="banner_preview" src="#" alt="Preview" class="img-thumbnail d-none" style="height: 150px; width: 100%; object-fit: cover;">
                            </div>
                            <input type="file" name="banner_image" id="banner_input" class="form-control" accept="image/*">
                            <small class="text-secondary">Wide image shown at the top of property page.</small>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Gallery Images (Multiple)</label>
                            <div id="gallery_preview" class="d-flex flex-wrap gap-2 mb-3"></div>
                            <input type="file" name="images[]" id="gallery_input" class="form-control" multiple accept="image/*">
                            <small class="text-secondary">Additional photos of the property.</small>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" value="1">
                                <label class="form-check-label" for="is_featured">
                                    Mark as Featured Property
                                </label>
                            </div>

                            <h5 class="fw-bold text-primary mb-3">Status</h5>
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <select name="status" class="form-select">
                                        <option value="draft" {{ old('status', 'draft') == 'draft' ? 'selected' : '' }}>Draft (Not visible on website)</option>
                                        {{-- <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Published / Available (Visible on website)</option>
                                        <option value="sold" {{ old('status') == 'sold' ? 'selected' : '' }}>Sold</option>
                                        <option value="reserved" {{ old('status') == 'reserved' ? 'selected' : '' }}>Reserved</option> --}}
                                    </select>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-gradient-primary px-5 py-2 fw-bold">
                                <i class="bi bi-save me-2"></i>Create Property
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
</div>
</div>

@push('styles')
<link rel="stylesheet"
      href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
      integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
      crossorigin=""/>
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>
@endpush

<script>
document.addEventListener('DOMContentLoaded', function() {
    const typeSelect = document.querySelector('select[name="property_type"]');
    const flatDetails = document.getElementById('flat-details');

    function toggleDetails() {
        if (typeSelect.value === 'flat') {
            flatDetails.style.display = 'block';
        } else {
            flatDetails.style.display = 'none';
        }
    }

    typeSelect.addEventListener('change', toggleDetails);
    toggleDetails(); // Run on load

    // Image Preview Logic
    function setupImagePreview(inputId, previewId) {
        const input = document.getElementById(inputId);
        const preview = document.getElementById(previewId);

        input.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                }
                reader.readAsDataURL(file);
            }
        });
    }

    setupImagePreview('feature_input', 'feature_preview');
    setupImagePreview('banner_input', 'banner_preview');

    // Gallery Preview Logic
    const galleryInput = document.getElementById('gallery_input');
    const galleryPreview = document.getElementById('gallery_preview');

    galleryInput.addEventListener('change', function() {
        galleryPreview.innerHTML = '';
        const files = Array.from(this.files);

        files.forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'img-thumbnail';
                img.style.height = '80px';
                img.style.width = '80px';
                img.style.objectFit = 'cover';
                galleryPreview.appendChild(img);
            }
            reader.readAsDataURL(file);
        });
    });

    // Nearby places repeater
    const nearbyWrapper = document.getElementById('nearby-places-wrapper');
    const btnAddNearby = document.getElementById('btn-add-nearby');

    if (nearbyWrapper && btnAddNearby) {
        function refreshIndexes() {
            const rows = nearbyWrapper.querySelectorAll('.nearby-place-row');
            rows.forEach((row, index) => {
                row.dataset.index = index;
                const labelInput = row.querySelector('input[name*="[label]"]');
                const distanceInput = row.querySelector('input[name*="[distance]"]');
                if (labelInput) {
                    labelInput.name = `nearby_places[${index}][label]`;
                }
                if (distanceInput) {
                    distanceInput.name = `nearby_places[${index}][distance]`;
                }
            });
        }

        btnAddNearby.addEventListener('click', function () {
            const index = nearbyWrapper.querySelectorAll('.nearby-place-row').length;
            const row = document.createElement('div');
            row.className = 'row g-2 align-items-center nearby-place-row';
            row.innerHTML = `
                <div class="col-md-6">
                    <input type="text" class="form-control" name="nearby_places[${index}][label]" placeholder="e.g. ABC Hospital">
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="nearby_places[${index}][distance]" placeholder="e.g. 1.2 km">
                </div>
                <div class="col-md-2 d-flex justify-content-end">
                    <button type="button" class="btn btn-outline-danger btn-sm btn-remove-nearby">
                        <i class="bi bi-x"></i>
                    </button>
                </div>
            `;
            nearbyWrapper.appendChild(row);
            refreshIndexes();
        });

        nearbyWrapper.addEventListener('click', function (e) {
            if (e.target.closest('.btn-remove-nearby')) {
                const rows = nearbyWrapper.querySelectorAll('.nearby-place-row');
                if (rows.length === 1) {
                    // Just clear values on last row instead of removing
                    rows[0].querySelectorAll('input').forEach(input => input.value = '');
                } else {
                    e.target.closest('.nearby-place-row').remove();
                    refreshIndexes();
                }
            }
        });

        refreshIndexes();
    }

    // FAQ repeater
    const faqsWrapper = document.getElementById('faqs-wrapper');
    const btnAddFaq = document.getElementById('btn-add-faq');

    if (faqsWrapper && btnAddFaq) {
        function refreshFaqIndexes() {
            const rows = faqsWrapper.querySelectorAll('.faq-row');
            rows.forEach((row, index) => {
                row.dataset.index = index;
                const qInput = row.querySelector('input[name*="[question]"]');
                const aInput = row.querySelector('input[name*="[answer]"]');
                if (qInput) {
                    qInput.name = `faqs[${index}][question]`;
                }
                if (aInput) {
                    aInput.name = `faqs[${index}][answer]`;
                }
            });
        }

        btnAddFaq.addEventListener('click', function () {
            const index = faqsWrapper.querySelectorAll('.faq-row').length;
            const row = document.createElement('div');
            row.className = 'row g-2 align-items-center faq-row';
            row.innerHTML = `
                <div class="col-md-5">
                    <input type="text" class="form-control" name="faqs[${index}][question]" placeholder="Question">
                </div>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="faqs[${index}][answer]" placeholder="Answer">
                </div>
                <div class="col-md-2 d-flex justify-content-end">
                    <button type="button" class="btn btn-outline-danger btn-sm btn-remove-faq">
                        <i class="bi bi-x"></i>
                    </button>
                </div>
            `;
            faqsWrapper.appendChild(row);
            refreshFaqIndexes();
        });

        faqsWrapper.addEventListener('click', function (e) {
            if (e.target.closest('.btn-remove-faq')) {
                const rows = faqsWrapper.querySelectorAll('.faq-row');
                if (rows.length === 1) {
                    rows[0].querySelectorAll('input').forEach(input => input.value = '');
                } else {
                    e.target.closest('.faq-row').remove();
                    refreshFaqIndexes();
                }
            }
        });

        refreshFaqIndexes();
    }

    // Leaflet Map for picking latitude/longitude
    const latInput = document.getElementById('latitude');
    const lngInput = document.getElementById('longitude');
    const mapContainer = document.getElementById('map');

    if (mapContainer && typeof L !== 'undefined') {
        const defaultLat = latInput.value ? parseFloat(latInput.value) : 13.0827; // Chennai default
        const defaultLng = lngInput.value ? parseFloat(lngInput.value) : 80.2707;

        const map = L.map('map').setView([defaultLat, defaultLng], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        let marker = L.marker([defaultLat, defaultLng]).addTo(map);

        function updateMarker(lat, lng) {
            if (marker) {
                marker.setLatLng([lat, lng]);
            } else {
                marker = L.marker([lat, lng]).addTo(map);
            }
        }

        map.on('click', function (e) {
            const lat = e.latlng.lat;
            const lng = e.latlng.lng;
            if (latInput) latInput.value = lat.toFixed(6);
            if (lngInput) lngInput.value = lng.toFixed(6);
            updateMarker(lat, lng);
        });

        const btnUseLocation = document.getElementById('btn-use-location');
        if (btnUseLocation && navigator.geolocation) {
            btnUseLocation.addEventListener('click', function () {
                navigator.geolocation.getCurrentPosition(function (pos) {
                    const lat = pos.coords.latitude;
                    const lng = pos.coords.longitude;
                    if (latInput) latInput.value = lat.toFixed(6);
                    if (lngInput) lngInput.value = lng.toFixed(6);
                    map.setView([lat, lng], 15);
                    updateMarker(lat, lng);
                });
            });
        }
    }
});
</script>
@endsection
