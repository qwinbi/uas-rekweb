@extends('layouts.admin')

@section('title', 'Logo Settings')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <h4 class="fw-bold mb-4">
                    <i class="fas fa-image me-2"></i>Logo & Branding
                </h4>
                
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <!-- Main Logo -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3">Main Logo</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="border rounded p-4 text-center mb-3">
                                    <div id="mainLogoPreview" class="mb-3">
                                        <img src="https://via.placeholder.com/200x80/4361ee/ffffff?text=LOGO" 
                                             class="img-fluid" alt="Current Logo">
                                    </div>
                                    <input type="file" class="form-control" id="mainLogo" 
                                           name="main_logo" accept="image/*" onchange="previewImage(this, 'mainLogoPreview')">
                                    <small class="text-muted d-block mt-2">
                                        Recommended: 200x80px, PNG with transparent background
                                    </small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="border rounded p-3">
                                    <h6 class="fw-bold">Preview</h6>
                                    <div class="bg-light p-4 rounded text-center">
                                        <img src="https://via.placeholder.com/200x80/4361ee/ffffff?text=LOGO" 
                                             class="img-fluid mb-3" id="mainLogoLivePreview">
                                        <p class="mb-0 text-muted">Navbar Preview</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Favicon -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3">Favicon</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="border rounded p-4 text-center">
                                    <div id="faviconPreview" class="mb-3">
                                        <img src="https://via.placeholder.com/64x64/4361ee/ffffff?text=F" 
                                             class="rounded" width="64" alt="Current Favicon">
                                    </div>
                                    <input type="file" class="form-control" id="favicon" 
                                           name="favicon" accept="image/*" onchange="previewImage(this, 'faviconPreview')">
                                    <small class="text-muted d-block mt-2">
                                        Recommended: 64x64px or 32x32px, PNG/ICO
                                    </small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="border rounded p-3">
                                    <h6 class="fw-bold">Browser Preview</h6>
                                    <div class="bg-light p-4 rounded">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="https://via.placeholder.com/16x16/4361ee/ffffff?text=F" 
                                                 class="me-2" width="16">
                                            <span>Website Title</span>
                                        </div>
                                        <small class="text-muted">Appears in browser tabs</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Logo Variations -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3">Logo Variations</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Light Logo (For Dark Background)</label>
                                <div class="border rounded p-4 text-center">
                                    <div id="lightLogoPreview" class="mb-3">
                                        <img src="https://via.placeholder.com/200x80/ffffff/4361ee?text=LOGO+LIGHT" 
                                             class="img-fluid" alt="Light Logo">
                                    </div>
                                    <input type="file" class="form-control" id="lightLogo" 
                                           name="light_logo" accept="image/*" onchange="previewImage(this, 'lightLogoPreview')">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Mobile Logo (Optional)</label>
                                <div class="border rounded p-4 text-center">
                                    <div id="mobileLogoPreview" class="mb-3">
                                        <img src="https://via.placeholder.com/100x40/4361ee/ffffff?text=LOGO+M" 
                                             class="img-fluid" alt="Mobile Logo">
                                    </div>
                                    <input type="file" class="form-control" id="mobileLogo" 
                                           name="mobile_logo" accept="image/*" onchange="previewImage(this, 'mobileLogoPreview')">
                                    <small class="text-muted d-block mt-2">
                                        Smaller version for mobile devices
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Brand Colors -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3">Brand Colors</h6>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label">Primary Color</label>
                                <input type="color" class="form-control form-control-color" 
                                       name="primary_color" value="#4361ee" title="Choose primary color">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Secondary Color</label>
                                <input type="color" class="form-control form-control-color" 
                                       name="secondary_color" value="#3a0ca3" title="Choose secondary color">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Accent Color</label>
                                <input type="color" class="form-control form-control-color" 
                                       name="accent_color" value="#4cc9f0" title="Choose accent color">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Background Color</label>
                                <input type="color" class="form-control form-control-color" 
                                       name="background_color" value="#f8fafc" title="Choose background color">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Logo Settings -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3">Logo Settings</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Logo Width (px)</label>
                                <input type="number" class="form-control" name="logo_width" value="200">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Logo Height (px)</label>
                                <input type="number" class="form-control" name="logo_height" value="80">
                            </div>
                            <div class="col-12">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="show_logo_text" id="showLogoText" checked>
                                    <label class="form-check-label" for="showLogoText">
                                        Show text next to logo
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Submit -->
                    <div class="d-flex justify-content-end gap-3">
                        <button type="reset" class="btn btn-outline-secondary">
                            <i class="fas fa-redo me-2"></i>Reset
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Preview Sidebar -->
    <div class="col-lg-4">
        <!-- Live Preview -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <h6 class="fw-bold mb-3">Live Preview</h6>
                
                <!-- Navbar Preview -->
                <div class="border rounded p-3 mb-4">
                    <h6 class="fw-bold mb-2">Navbar</h6>
                    <div class="navbar-preview bg-white p-3 rounded border">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <img src="https://via.placeholder.com/150x60/4361ee/ffffff?text=LOGO" 
                                     class="me-2" height="30" id="navbarLogoPreview">
                                <span class="fw-bold" id="siteNamePreview">{{ config('app.name') }}</span>
                            </div>
                            <div class="d-flex gap-2">
                                <i class="fas fa-shopping-cart text-muted"></i>
                                <i class="fas fa-user text-muted"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Footer Preview -->
                <div class="border rounded p-3 mb-4">
                    <h6 class="fw-bold mb-2">Footer</h6>
                    <div class="footer-preview bg-dark text-white p-3 rounded">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <img src="https://via.placeholder.com/100x40/ffffff/4361ee?text=LOGO" 
                                 height="30" id="footerLogoPreview">
                            <div class="social-icons">
                                <i class="fab fa-facebook me-2"></i>
                                <i class="fab fa-instagram me-2"></i>
                                <i class="fab fa-twitter"></i>
                            </div>
                        </div>
                        <p class="small mb-0">&copy; 2024 {{ config('app.name') }}</p>
                    </div>
                </div>
                
                <!-- Mobile Preview -->
                <div class="border rounded p-3">
                    <h6 class="fw-bold mb-2">Mobile Preview</h6>
                    <div class="mobile-preview mx-auto" style="max-width: 300px;">
                        <div class="bg-white border rounded p-3">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <img src="https://via.placeholder.com/80x32/4361ee/ffffff?text=LOGO" 
                                     height="25" id="mobileLogoLivePreview">
                                <i class="fas fa-bars text-muted"></i>
                            </div>
                            <div class="text-center py-4">
                                <p class="small text-muted">Mobile navigation preview</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Statistics -->
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="fw-bold mb-3">Logo Statistics</h6>
                <div class="list-group list-group-flush">
                    <div class="list-group-item border-0 px-0 d-flex justify-content-between">
                        <span>Current Logo Size</span>
                        <span class="fw-semibold">15.2 KB</span>
                    </div>
                    <div class="list-group-item border-0 px-0 d-flex justify-content-between">
                        <span>Last Updated</span>
                        <span class="fw-semibold">2 days ago</span>
                    </div>
                    <div class="list-group-item border-0 px-0 d-flex justify-content-between">
                        <span>Logo Format</span>
                        <span class="fw-semibold">PNG</span>
                    </div>
                    <div class="list-group-item border-0 px-0 d-flex justify-content-between">
                        <span>Dimensions</span>
                        <span class="fw-semibold">200x80px</span>
                    </div>
                </div>
                
                <div class="mt-4">
                    <button class="btn btn-outline-danger w-100" onclick="resetLogo()">
                        <i class="fas fa-trash-alt me-2"></i>Reset to Default Logo
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);
        const file = input.files[0];
        
        if (file) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.innerHTML = `<img src="${e.target.result}" class="img-fluid" alt="Preview">`;
                
                // Update live previews
                if (previewId === 'mainLogoPreview') {
                    document.getElementById('navbarLogoPreview').src = e.target.result;
                    document.getElementById('mainLogoLivePreview').src = e.target.result;
                }
                if (previewId === 'faviconPreview') {
                    document.querySelector('.browser-preview img').src = e.target.result;
                }
                if (previewId === 'lightLogoPreview') {
                    document.getElementById('footerLogoPreview').src = e.target.result;
                }
                if (previewId === 'mobileLogoPreview') {
                    document.getElementById('mobileLogoLivePreview').src = e.target.result;
                }
            }
            
            reader.readAsDataURL(file);
        }
    }
    
    function resetLogo() {
        Swal.fire({
            title: 'Reset Logo?',
            text: "This will restore the default logo. Are you sure?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, reset it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Reset all logo previews to default
                const defaultLogo = 'https://via.placeholder.com/200x80/4361ee/ffffff?text=LOGO';
                const defaultLightLogo = 'https://via.placeholder.com/200x80/ffffff/4361ee?text=LOGO+LIGHT';
                
                document.getElementById('mainLogoPreview').innerHTML = `<img src="${defaultLogo}" class="img-fluid" alt="Default Logo">`;
                document.getElementById('navbarLogoPreview').src = defaultLogo;
                document.getElementById('mainLogoLivePreview').src = defaultLogo;
                document.getElementById('footerLogoPreview').src = defaultLightLogo;
                
                Swal.fire(
                    'Reset!',
                    'Logo has been reset to default.',
                    'success'
                );
            }
        });
    }
    
    // Update color previews
    document.querySelectorAll('input[type="color"]').forEach(input => {
        input.addEventListener('input', function() {
            if (this.name === 'primary_color') {
                document.documentElement.style.setProperty('--primary-color', this.value);
            }
        });
    });
    
    // Update site name preview
    document.querySelector('input[name="site_name"]')?.addEventListener('input', function() {
        document.getElementById('siteNamePreview').textContent = this.value || '{{ config('app.name') }}';
    });
</script>

<style>
    .form-control-color {
        width: 100%;
        height: 50px;
        border-radius: 8px;
        cursor: pointer;
    }
    
    .navbar-preview {
        min-height: 60px;
        display: flex;
        align-items: center;
    }
    
    .footer-preview {
        min-height: 100px;
    }
    
    .mobile-preview {
        border: 2px solid #dee2e6;
        border-radius: 20px;
        padding: 10px;
    }
    
    input[type="file"] {
        padding: 0.5rem;
        border: 2px dashed #dee2e6;
        border-radius: 8px;
        background: #f8f9fa;
    }
    
    input[type="file"]:hover {
        border-color: #4361ee;
        background: rgba(67, 97, 238, 0.05);
    }
    
    .social-icons i {
        font-size: 1.2rem;
        opacity: 0.8;
        transition: opacity 0.3s ease;
    }
    
    .social-icons i:hover {
        opacity: 1;
    }
</style>
@endsection