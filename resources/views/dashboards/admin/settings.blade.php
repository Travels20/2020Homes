@extends('layouts.dashboard')

@section('title', 'Site Settings')

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
        <a href="{{ route('admin.properties.create') }}" class="sidebar-nav-link">
            <i class="bi bi-plus-circle sidebar-nav-icon"></i>
            <span>Add Property</span>
        </a>
    </li>
    <li class="sidebar-nav-item">
        <a href="{{ route('admin.settings.index') }}" class="sidebar-nav-link active">
            <i class="bi bi-gear sidebar-nav-icon"></i>
            <span>Site Settings</span>
        </a>
    </li>
@endsection

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h2 class="fw-bold">Site Settings</h2>
        <p class="text-secondary">Manage site branding and dynamic content stored locally</p>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card glass-card border-0">
            <div class="card-body p-4">
                <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <h5 class="fw-bold mb-3">Branding</h5>
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Site Logo</label>

                            <input type="file" name="logo" id="logo_input" class="form-control" accept="image/*">
                            <div class="mt-2">
                                <img id="logo_preview" src="{{ \App\Models\SiteSetting::url('logo', asset('images/logo.png')) }}" alt="Logo" class="img-thumbnail" style="max-height: 50px;">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Favicon</label>

                            <input type="file" name="favicon" id="favicon_input" class="form-control" accept="image/*">
                             <div class="mt-2">
                                <img id="favicon_preview" src="{{ \App\Models\SiteSetting::url('favicon', asset('favicon.ico')) }}" alt="Favicon" class="img-thumbnail" style="max-height: 32px;" onerror="this.style.display='none'">
                            </div>
                        </div>
                    </div>

                    <h5 class="fw-bold mb-3 mt-4">Homepage Banner Images</h5>
                    <div class="mb-4">
                        <label class="form-label">Upload Banners (Multiple)</label>
                        <input type="file" name="banners[]" id="banners_input" class="form-control" multiple accept="image/*">
                        <div id="banners_preview" class="mt-3 d-flex flex-wrap gap-2">
                            @if(isset($settings['banners']))
                                @foreach(json_decode($settings['banners']) as $banner)
                                    <img src="{{ \Illuminate\Support\Facades\Storage::disk('s3')->url($banner) }}" class="img-thumbnail" style="height: 100px; width: 150px; object-fit: cover;">
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <h5 class="fw-bold mb-3 mt-4">General Information</h5>
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Site Name</label>
                            <input type="text" name="site_name" class="form-control" value="{{ $settings['site_name'] ?? '2020Homes' }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Contact Email</label>
                            <input type="email" name="contact_email" class="form-control" value="{{ $settings['contact_email'] ?? 'info@2020homes.com' }}">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-gradient-primary px-5 fw-bold">Save All Settings</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function setupImagePreview(inputId, previewId) {
        const input = document.getElementById(inputId);
        const preview = document.getElementById(previewId);

        if (input && preview) {
            input.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                    }
                    reader.readAsDataURL(file);
                }
            });
        }
    }

    setupImagePreview('logo_input', 'logo_preview');
    setupImagePreview('favicon_input', 'favicon_preview');

    const bannersInput = document.getElementById('banners_input');
    const bannersPreview = document.getElementById('banners_preview');

    if (bannersInput && bannersPreview) {
        bannersInput.addEventListener('change', function() {
            bannersPreview.innerHTML = '';
            const files = Array.from(this.files);

            files.forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'img-thumbnail';
                    img.style.height = '100px';
                    img.style.width = '150px';
                    img.style.objectFit = 'cover';
                    bannersPreview.appendChild(img);
                }
                reader.readAsDataURL(file);
            });
        });
    }
});
</script>
@endsection
