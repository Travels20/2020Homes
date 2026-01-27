@extends('layouts.dashboard')
@section('title', 'Add Property')

@section('sidebar-menu')
    <li class="sidebar-nav-item">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-nav-link">
            <i class="bi bi-speedometer2 sidebar-nav-icon"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="sidebar-nav-item">
        <a href="{{ route('admin.properties.index') }}" class="sidebar-nav-link">
            <i class="bi bi-building sidebar-nav-icon"></i>
            <span>Properties</span>
        </a>
    </li>
    <li class="sidebar-nav-item">
        <a href="{{ route('admin.properties.create') }}" class="sidebar-nav-link active">
            <i class="bi bi-plus-circle sidebar-nav-icon"></i>
            <span>Add Property</span>
        </a>
    </li>
    <li class="sidebar-nav-item">
        <a href="{{ route('admin.settings.index') }}" class="sidebar-nav-link">
            <i class="bi bi-gear sidebar-nav-icon"></i>
            <span>Site Settings</span>
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
            <a href="{{ route('admin.properties.index') }}" class="btn btn-outline-secondary">
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

                <form action="{{ route('admin.properties.store') }}" method="POST" enctype="multipart/form-data">
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
                            <label class="form-label">State</label>
                            <input type="text" name="state" class="form-control" value="{{ old('state') }}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Address (Optional)</label>
                            <input type="text" name="address" class="form-control" value="{{ old('address') }}">
                        </div>
                    </div>

                    <h5 class="fw-bold text-primary mb-3 mt-4">Pricing & Area</h5>
                    <div class="row mb-3">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Price (₹)</label>
                            <input type="number" name="price" class="form-control" value="{{ old('price') }}" required step="0.01">
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
});
</script>
@endsection
