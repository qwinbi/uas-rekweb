@extends('layouts.admin')

@section('title', 'Footer Settings')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h4 class="fw-bold mb-4" style="color: var(--burgundy);">
                    <i class="fas fa-window-maximize me-2"></i>Footer Settings
                </h4>
                
                <form action="#" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <!-- Footer Content -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3" style="color: var(--lapis-lazuli);">Footer Content</h6>
                        
                        <div class="mb-3">
                            <label class="form-label">Footer Description</label>
                            <textarea class="form-control" name="footer_description" rows="3" 
                                      placeholder="Brief description for footer section">Your favorite online shop for quality products. Experience shopping with style and comfort.</textarea>
                        </div>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Contact Email</label>
                                <input type="email" class="form-control" name="contact_email" 
                                       value="hello@bunnypops.com">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Contact Phone</label>
                                <input type="text" class="form-control" name="contact_phone" 
                                       value="+62 812 3456 7890">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Address</label>
                                <textarea class="form-control" name="address" rows="2">Jakarta, Indonesia</textarea>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Social Media Links -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3" style="color: var(--lapis-lazuli);">Social Media Links</h6>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="fab fa-facebook me-2" style="color: #1877F2;"></i>Facebook URL
                                </label>
                                <input type="url" class="form-control" name="facebook_url" 
                                       placeholder="https://facebook.com/yourpage">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="fab fa-instagram me-2" style="color: #E4405F;"></i>Instagram URL
                                </label>
                                <input type="url" class="form-control" name="instagram_url" 
                                       placeholder="https://instagram.com/yourprofile">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="fab fa-twitter me-2" style="color: #1DA1F2;"></i>Twitter URL
                                </label>
                                <input type="url" class="form-control" name="twitter_url" 
                                       placeholder="https://twitter.com/yourprofile">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="fab fa-youtube me-2" style="color: #FF0000;"></i>YouTube URL
                                </label>
                                <input type="url" class="form-control" name="youtube_url" 
                                       placeholder="https://youtube.com/yourchannel">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Quick Links -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3" style="color: var(--lapis-lazuli);">Quick Links</h6>
                        
                        <div id="quickLinksContainer">
                            @for($i = 1; $i <= 4; $i++)
                            <div class="row g-2 mb-2">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="quick_links[{{ $i }}][title]" 
                                           placeholder="Link Title" value="{{ ['Home', 'Shop', 'About', 'Contact'][$i-1] }}">
                                </div>
                                <div class="col-md-5">
                                    <input type="url" class="form-control" name="quick_links[{{ $i }}][url]" 
                                           placeholder="/url" value="{{ ['/', '/shop', '/about', '/contact'][$i-1] }}">
                                </div>
                                <div class="col-md-1">
                                    @if($i > 1)
                                    <button type="button" class="btn btn-danger w-100" onclick="removeLink(this)">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    @endif
                                </div>
                            </div>
                            @endfor
                        </div>
                        
                        <button type="button" class="btn btn-outline-primary btn-sm mt-2" onclick="addLink()">
                            <i class="fas fa-plus me-2"></i>Add Link
                        </button>
                    </div>
                    
                    <!-- Footer Colors -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3" style="color: var(--lapis-lazuli);">Footer Colors</h6>
                        
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Background Color</label>
                                <input type="color" class="form-control form-control-color" 
                                       name="footer_bg_color" value="#3D5D91" title="Choose background color">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Text Color</label>
                                <input type="color" class="form-control form-control-color" 
                                       name="footer_text_color" value="#FFFFFF" title="Choose text color">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Link Color</label>
                                <input type="color" class="form-control form-control-color" 
                                       name="footer_link_color" value="#F2AEBC" title="Choose link color">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Footer Settings -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3" style="color: var(--lapis-lazuli);">Display Settings</h6>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="show_social_icons" id="showSocialIcons" checked>
                                    <label class="form-check-label" for="showSocialIcons">
                                        Show Social Media Icons
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="show_newsletter" id="showNewsletter" checked>
                                    <label class="form-check-label" for="showNewsletter">
                                        Show Newsletter Subscription
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="show_quick_links" id="showQuickLinks" checked>
                                    <label class="form-check-label" for="showQuickLinks">
                                        Show Quick Links
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="show_copyright" id="showCopyright" checked>
                                    <label class="form-check-label" for="showCopyright">
                                        Show Copyright Text
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
                            <i class="fas fa-save me-2"></i>Save Footer Settings
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
                <h6 class="fw-bold mb-3" style="color: var(--burgundy);">Footer Preview</h6>
                
                <div class="footer-preview rounded-3 p-4" 
                     style="background: linear-gradient(135deg, var(--lapis-lazuli), var(--silver-lake)); color: white;">
                    
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <h5 class="mb-3">
                                <i class="fas fa-bunny me-2"></i>
                                BUNNYPOPS
                            </h5>
                            <p class="small mb-0" id="footerDescPreview">
                                Your favorite online shop for quality products. Experience shopping with style and comfort.
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6 class="mb-3">Quick Links</h6>
                            <ul class="list-unstyled" id="linksPreview">
                                <li><a href="#" class="text-white text-decoration-none">Home</a></li>
                                <li><a href="#" class="text-white text-decoration-none">Shop</a></li>
                                <li><a href="#" class="text-white text-decoration-none">About</a></li>
                                <li><a href="#" class="text-white text-decoration-none">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="border-top pt-4">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="social-icons mb-3">
                                    <a href="#" class="text-white me-3">
                                        <i class="fab fa-facebook"></i>
                                    </a>
                                    <a href="#" class="text-white me-3">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                    <a href="#" class="text-white me-3">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="#" class="text-white">
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                </div>
                                <p class="small mb-0" id="contactPreview">
                                    <i class="fas fa-envelope me-1"></i> hello@bunnypops.com<br>
                                    <i class="fas fa-phone me-1"></i> +62 812 3456 7890
                                </p>
                            </div>
                            <div class="col-md-4 text-end">
                                <p class="small mb-0">&copy; 2024 BUNNYPOPS. All rights reserved.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Footer Statistics -->
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="fw-bold mb-3" style="color: var(--burgundy);">Footer Statistics</h6>
                
                <div class="list-group list-group-flush">
                    <div class="list-group-item border-0 px-0 d-flex justify-content-between">
                        <span>Last Updated</span>
                        <span class="fw-semibold">Today</span>
                    </div>
                    <div class="list-group-item border-0 px-0 d-flex justify-content-between">
                        <span>Quick Links</span>
                        <span class="fw-semibold">4 Links</span>
                    </div>
                    <div class="list-group-item border-0 px-0 d-flex justify-content-between">
                        <span>Social Links</span>
                        <span class="fw-semibold">4 Active</span>
                    </div>
                    <div class="list-group-item border-0 px-0 d-flex justify-content-between">
                        <span>Newsletter Subscribers</span>
                        <span class="fw-semibold">1,248</span>
                    </div>
                </div>
                
                <div class="mt-4">
                    <button class="btn btn-outline-primary w-100" onclick="resetFooter()">
                        <i class="fas fa-undo me-2"></i>Reset to Default
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let linkCount = 5;
    
    function addLink() {
        const container = document.getElementById('quickLinksContainer');
        const div = document.createElement('div');
        div.className = 'row g-2 mb-2';
        div.innerHTML = `
            <div class="col-md-6">
                <input type="text" class="form-control" name="quick_links[${linkCount}][title]" 
                       placeholder="Link Title">
            </div>
            <div class="col-md-5">
                <input type="url" class="form-control" name="quick_links[${linkCount}][url]" 
                       placeholder="/url">
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-danger w-100" onclick="removeLink(this)">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        container.appendChild(div);
        linkCount++;
    }
    
    function removeLink(button) {
        button.closest('.row').remove();
    }
    
    function resetFooter() {
        Swal.fire({
            title: 'Reset Footer Settings?',
            text: "This will restore default footer settings. Are you sure?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'var(--burgundy)',
            cancelButtonColor: 'var(--silver-lake)',
            confirmButtonText: 'Yes, reset it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Reset form values
                document.querySelector('textarea[name="footer_description"]').value = 'Your favorite online shop for quality products. Experience shopping with style and comfort.';
                document.querySelector('input[name="contact_email"]').value = 'hello@bunnypops.com';
                document.querySelector('input[name="contact_phone"]').value = '+62 812 3456 7890';
                document.querySelector('textarea[name="address"]').value = 'Jakarta, Indonesia';
                
                // Reset colors
                document.querySelector('input[name="footer_bg_color"]').value = '#3D5D91';
                document.querySelector('input[name="footer_text_color"]').value = '#FFFFFF';
                document.querySelector('input[name="footer_link_color"]').value = '#F2AEBC';
                
                updatePreview();
                
                Swal.fire(
                    'Reset!',
                    'Footer settings have been reset to default.',
                    'success'
                );
            }
        });
    }
    
    function updatePreview() {
        // Update preview based on form values
        const desc = document.querySelector('textarea[name="footer_description"]').value;
        const email = document.querySelector('input[name="contact_email"]').value;
        const phone = document.querySelector('input[name="contact_phone"]').value;
        
        document.getElementById('footerDescPreview').textContent = desc;
        document.getElementById('contactPreview').innerHTML = `
            <i class="fas fa-envelope me-1"></i> ${email}<br>
            <i class="fas fa-phone me-1"></i> ${phone}
        `;
        
        // Update colors
        const bgColor = document.querySelector('input[name="footer_bg_color"]').value;
        const textColor = document.querySelector('input[name="footer_text_color"]').value;
        const linkColor = document.querySelector('input[name="footer_link_color"]').value;
        
        const preview = document.querySelector('.footer-preview');
        preview.style.background = `linear-gradient(135deg, ${bgColor}, ${bgColor}99)`;
        preview.style.color = textColor;
        
        // Update link colors
        preview.querySelectorAll('a').forEach(link => {
            link.style.color = linkColor;
        });
    }
    
    // Live updates
    document.querySelectorAll('input, textarea').forEach(input => {
        input.addEventListener('input', updatePreview);
    });
    
    document.querySelectorAll('input[type="color"]').forEach(input => {
        input.addEventListener('input', updatePreview);
    });
</script>

<style>
    .form-control-color {
        width: 100%;
        height: 45px;
        border-radius: 8px;
        cursor: pointer;
    }
    
    .form-switch .form-check-input {
        width: 3em;
        height: 1.5em;
    }
    
    .form-switch .form-check-input:checked {
        background-color: var(--burgundy);
        border-color: var(--burgundy);
    }
    
    .footer-preview {
        transition: all 0.3s ease;
    }
    
    .social-icons a {
        transition: all 0.3s ease;
        opacity: 0.8;
    }
    
    .social-icons a:hover {
        opacity: 1;
        transform: translateY(-2px);
    }
</style>
@endsection