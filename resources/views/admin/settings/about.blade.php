@extends('layouts.admin')

@section('title', 'About Page Settings')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h4 class="fw-bold mb-4" style="color: var(--burgundy);">
                    <i class="fas fa-info-circle me-2"></i>About Page Settings
                </h4>
                
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <!-- Hero Section -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3" style="color: var(--lapis-lazuli);">Hero Section</h6>
                        
                        <div class="mb-3">
                            <label class="form-label">Page Title</label>
                            <input type="text" class="form-control" name="page_title" 
                                   value="About BUNNYPOPS">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Hero Description</label>
                            <textarea class="form-control" name="hero_description" rows="3">We are committed to providing the best online shopping experience with quality products, excellent customer service, and fast delivery.</textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Hero Image</label>
                            <div class="border rounded p-4 text-center">
                                <div id="heroImagePreview" class="mb-3">
                                    <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                                         class="img-fluid rounded" style="max-height: 200px;">
                                </div>
                                <input type="file" class="form-control" name="hero_image" 
                                       accept="image/*" onchange="previewImage(this, 'heroImagePreview')">
                                <small class="text-muted d-block mt-2">Recommended: 1200x600px, JPG/PNG</small>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Our Story -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3" style="color: var(--lapis-lazuli);">Our Story</h6>
                        
                        <div class="mb-3">
                            <label class="form-label">Story Title</label>
                            <input type="text" class="form-control" name="story_title" 
                                   value="Our Story">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Story Content</label>
                            <textarea class="form-control" name="story_content" rows="5">Founded in 2020, BUNNYPOPS started as a small online store with a big vision: to make quality products accessible to everyone. Today, we serve thousands of customers nationwide with a curated selection of products you'll love.</textarea>
                        </div>
                    </div>
                    
                    <!-- Mission, Vision & Values -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3" style="color: var(--lapis-lazuli);">Mission, Vision & Values</h6>
                        
                        <div class="row g-3">
                            @foreach([
                                ['icon' => 'fas fa-bullseye', 'title' => 'Mission', 'content' => 'To provide exceptional value through quality products and outstanding customer service.'],
                                ['icon' => 'fas fa-eye', 'title' => 'Vision', 'content' => 'To be the most trusted online shopping destination in Indonesia.'],
                                ['icon' => 'fas fa-handshake', 'title' => 'Values', 'content' => 'Integrity, quality, customer satisfaction, and innovation drive everything we do.']
                            ] as $index => $item)
                            <div class="col-md-4">
                                <div class="border rounded p-3 h-100">
                                    <div class="mb-2">
                                        <i class="{{ $item['icon'] }} fa-2x" style="color: var(--silver-lake);"></i>
                                    </div>
                                    <input type="text" class="form-control mb-2" 
                                           name="values[{{ $index }}][title]" value="{{ $item['title'] }}">
                                    <textarea class="form-control" name="values[{{ $index }}][content]" 
                                              rows="3">{{ $item['content'] }}</textarea>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Why Choose Us -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3" style="color: var(--lapis-lazuli);">Why Choose Us</h6>
                        
                        <div id="featuresContainer">
                            @foreach([
                                ['icon' => 'fas fa-shipping-fast', 'title' => 'Fast Delivery', 'desc' => 'Free shipping for orders above Rp 300,000'],
                                ['icon' => 'fas fa-shield-alt', 'title' => 'Secure Payment', 'desc' => '100% secure payment with encryption'],
                                ['icon' => 'fas fa-undo', 'title' => 'Easy Returns', 'desc' => '30-day return policy'],
                                ['icon' => 'fas fa-headset', 'title' => '24/7 Support', 'desc' => 'Dedicated customer support team']
                            ] as $index => $feature)
                            <div class="row g-2 mb-2">
                                <div class="col-md-1">
                                    <input type="text" class="form-control" name="features[{{ $index }}][icon]" 
                                           value="{{ $feature['icon'] }}" placeholder="fas fa-icon">
                                </div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" name="features[{{ $index }}][title]" 
                                           value="{{ $feature['title'] }}" placeholder="Feature Title">
                                </div>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="features[{{ $index }}][description]" 
                                           value="{{ $feature['desc'] }}" placeholder="Feature Description">
                                </div>
                                <div class="col-md-1">
                                    @if($index > 0)
                                    <button type="button" class="btn btn-danger w-100" onclick="removeFeature(this)">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                        <button type="button" class="btn btn-outline-primary btn-sm mt-2" onclick="addFeature()">
                            <i class="fas fa-plus me-2"></i>Add Feature
                        </button>
                    </div>
                    
                    <!-- Team Section -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3" style="color: var(--lapis-lazuli);">Team Section</h6>
                        
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="show_team" id="showTeam" checked>
                                <label class="form-check-label" for="showTeam">
                                    Show Team Section
                                </label>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Team Section Title</label>
                            <input type="text" class="form-control" name="team_title" 
                                   value="Meet Our Team">
                        </div>
                    </div>
                    
                    <!-- Contact Information -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3" style="color: var(--lapis-lazuli);">Contact Information</h6>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Company Name</label>
                                <input type="text" class="form-control" name="company_name" 
                                       value="BUNNYPOPS">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Founded Year</label>
                                <input type="number" class="form-control" name="founded_year" 
                                       value="2020">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Full Address</label>
                                <textarea class="form-control" name="company_address" rows="2">Jl. Sudirman No. 123, Jakarta Pusat, Indonesia</textarea>
                            </div>
                        </div>
                    </div>
                    
                    <!-- SEO Settings -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3" style="color: var(--lapis-lazuli);">SEO Settings</h6>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Meta Title</label>
                                <input type="text" class="form-control" name="meta_title" 
                                       placeholder="About Us - BUNNYPOPS">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Meta Keywords</label>
                                <input type="text" class="form-control" name="meta_keywords" 
                                       placeholder="about, bunnypops, company, story">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Meta Description</label>
                                <textarea class="form-control" name="meta_description" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Submit -->
                    <div class="d-flex justify-content-end gap-3">
                        <button type="reset" class="btn btn-outline-secondary">
                            <i class="fas fa-redo me-2"></i>Reset
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Save About Settings
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
                <h6 class="fw-bold mb-3" style="color: var(--burgundy);">Page Preview</h6>
                
                <div class="about-preview rounded-3 p-4" style="background: var(--light-pink);">
                    
                    <!-- Hero Preview -->
                    <div class="hero-preview text-center mb-4">
                        <h3 class="fw-bold mb-3" style="color: var(--burgundy);" id="pageTitlePreview">
                            About BUNNYPOPS
                        </h3>
                        <p class="mb-3" style="color: var(--lapis-lazuli);" id="heroDescPreview">
                            We are committed to providing the best online shopping experience with quality products, excellent customer service, and fast delivery.
                        </p>
                        <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                             class="img-fluid rounded mb-3" id="heroImageLivePreview" style="max-height: 150px;">
                    </div>
                    
                    <!-- Features Preview -->
                    <div class="features-preview mb-4">
                        <h6 class="fw-bold mb-3" style="color: var(--lapis-lazuli);">Why Choose Us</h6>
                        <div class="row g-2" id="featuresPreview">
                            @foreach([
                                ['icon' => 'fas fa-shipping-fast', 'title' => 'Fast Delivery', 'desc' => 'Free shipping for orders above Rp 300,000'],
                                ['icon' => 'fas fa-shield-alt', 'title' => 'Secure Payment', 'desc' => '100% secure payment with encryption']
                            ] as $feature)
                            <div class="col-6">
                                <div class="border rounded p-2" style="background: white;">
                                    <i class="{{ $feature['icon'] }} me-1" style="color: var(--silver-lake);"></i>
                                    <small class="fw-semibold">{{ $feature['title'] }}</small>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Story Preview -->
                    <div class="story-preview">
                        <h6 class="fw-bold mb-2" style="color: var(--lapis-lazuli);">Our Story</h6>
                        <p class="small mb-0" style="color: var(--lapis-lazuli);" id="storyPreview">
                            Founded in 2020, BUNNYPOPS started as a small online store with a big vision...
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Statistics -->
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="fw-bold mb-3" style="color: var(--burgundy);">About Page Statistics</h6>
                
                <div class="list-group list-group-flush">
                    <div class="list-group-item border-0 px-0 d-flex justify-content-between">
                        <span>Last Updated</span>
                        <span class="fw-semibold">3 days ago</span>
                    </div>
                    <div class="list-group-item border-0 px-0 d-flex justify-content-between">
                        <span>Features Count</span>
                        <span class="fw-semibold">4 Features</span>
                    </div>
                    <div class="list-group-item border-0 px-0 d-flex justify-content-between">
                        <span>Team Members</span>
                        <span class="fw-semibold">4 Members</span>
                    </div>
                    <div class="list-group-item border-0 px-0 d-flex justify-content-between">
                        <span>Page Views</span>
                        <span class="fw-semibold">2,548 views</span>
                    </div>
                </div>
                
                <div class="mt-4">
                    <button class="btn btn-outline-primary w-100" onclick="resetAbout()">
                        <i class="fas fa-undo me-2"></i>Reset to Default
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let featureCount = 4;
    
    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);
        const file = input.files[0];
        
        if (file) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.innerHTML = `<img src="${e.target.result}" class="img-fluid rounded" style="max-height: 200px;">`;
                document.getElementById('heroImageLivePreview').src = e.target.result;
            }
            
            reader.readAsDataURL(file);
        }
    }
    
    function addFeature() {
        const container = document.getElementById('featuresContainer');
        const div = document.createElement('div');
        div.className = 'row g-2 mb-2';
        div.innerHTML = `
            <div class="col-md-1">
                <input type="text" class="form-control" name="features[${featureCount}][icon]" 
                       placeholder="fas fa-icon">
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" name="features[${featureCount}][title]" 
                       placeholder="Feature Title">
            </div>
            <div class="col-md-7">
                <input type="text" class="form-control" name="features[${featureCount}][description]" 
                       placeholder="Feature Description">
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-danger w-100" onclick="removeFeature(this)">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        container.appendChild(div);
        featureCount++;
    }
    
    function removeFeature(button) {
        button.closest('.row').remove();
    }
    
    function resetAbout() {
        Swal.fire({
            title: 'Reset About Settings?',
            text: "This will restore default about page settings. Are you sure?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'var(--burgundy)',
            cancelButtonColor: 'var(--silver-lake)',
            confirmButtonText: 'Yes, reset it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Reset form values
                document.querySelector('input[name="page_title"]').value = 'About BUNNYPOPS';
                document.querySelector('textarea[name="hero_description"]').value = 'We are committed to providing the best online shopping experience with quality products, excellent customer service, and fast delivery.';
                document.querySelector('textarea[name="story_content"]').value = 'Founded in 2020, BUNNYPOPS started as a small online store with a big vision: to make quality products accessible to everyone. Today, we serve thousands of customers nationwide with a curated selection of products you\'ll love.';
                
                updatePreview();
                
                Swal.fire(
                    'Reset!',
                    'About page settings have been reset to default.',
                    'success'
                );
            }
        });
    }
    
    function updatePreview() {
        // Update preview
        document.getElementById('pageTitlePreview').textContent = 
            document.querySelector('input[name="page_title"]').value;
        document.getElementById('heroDescPreview').textContent = 
            document.querySelector('textarea[name="hero_description"]').value;
        document.getElementById('storyPreview').textContent = 
            document.querySelector('textarea[name="story_content"]').value.substring(0, 100) + '...';
    }
    
    // Live updates
    document.querySelectorAll('input, textarea').forEach(input => {
        input.addEventListener('input', updatePreview);
    });
</script>

<style>
    .about-preview {
        max-height: 500px;
        overflow-y: auto;
    }
    
    .features-preview .col-6 {
        margin-bottom: 8px;
    }
    
    input[name*="[icon]"] {
        font-family: 'Font Awesome 6 Free', 'Font Awesome 6 Brands';
    }
    
    .form-switch .form-check-input {
        width: 3em;
        height: 1.5em;
    }
    
    .form-switch .form-check-input:checked {
        background-color: var(--burgundy);
        border-color: var(--burgundy);
    }
</style>
@endsection