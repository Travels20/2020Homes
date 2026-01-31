@extends('layouts.dashboard')

@section('title', 'Site Settings')

@section('sidebar-menu')
    <x-admin-sidebar-menu />
@endsection

@section('content')
<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb bg-light ps-3 py-2 rounded">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Site Settings</li>
    </ol>
</nav>

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
                            @if(isset($settings['banners']) && is_array($settings['banners']))
                                @foreach($settings['banners'] as $banner)
                                    <img src="{{ \Illuminate\Support\Facades\Storage::disk('s3')->url($banner) }}" class="img-thumbnail" style="height: 100px; width: 150px; object-fit: cover;">
                                @endforeach
                            @elseif(isset($settings['banners']) && is_string($settings['banners']))
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
                            <label class="form-label">Site Tagline</label>
                            <input type="text" name="site_tagline" class="form-control" value="{{ $settings['site_tagline'] ?? '' }}" placeholder="Short site tagline or slogan">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Contact Email</label>
                            <input type="email" name="contact_email" class="form-control" value="{{ $settings['contact_email'] ?? 'info@2020homes.com' }}">
                        </div>
                    </div>

                    <h5 class="fw-bold mb-3 mt-4">SEO Settings</h5>
                    <div class="row mb-4">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">SEO Title</label>
                            <input type="text" name="seo_title" class="form-control" value="{{ $settings['seo_title'] ?? '' }}" placeholder="Default title for homepage and social shares">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">SEO Description</label>
                            <textarea name="seo_content" class="form-control" rows="4" placeholder="Short description used for meta description and social shares">{{ $settings['seo_content'] ?? '' }}</textarea>
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
