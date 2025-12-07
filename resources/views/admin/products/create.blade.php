@extends('layouts.admin')

@section('title', 'Add New Product - BUNNYPOPS')

@section('admin-content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-2xl md:text-3xl font-bold text-[#4D4C7D]">Add New Product</h1>
        <p class="text-[#8E7AB5]">Fill in the details to add a new product to your catalog</p>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" id="product-form">
        @csrf
        
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
            <!-- Basic Information -->
            <h2 class="text-xl font-bold text-[#4D4C7D] mb-6 flex items-center">
                <i class="fas fa-info-circle mr-3 text-[#8E7AB5]"></i>
                Basic Information
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Product Name -->
                <div>
                    <label class="block text-[#4D4C7D] font-medium mb-2">
                        Product Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="name" 
                           required
                           class="w-full px-4 py-3 rounded-lg border-2 border-[#F9DCC4] focus:border-[#FF6F61] focus:ring-2 focus:ring-[#FF6F61]/30 outline-none transition-all"
                           placeholder="Enter product name">
                    @error('name')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
                
                <!-- Price -->
                <div>
                    <label class="block text-[#4D4C7D] font-medium mb-2">
                        Price (Rp) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#8E7AB5]">Rp</span>
                        <input type="number" 
                               name="price" 
                               required
                               min="0"
                               step="1000"
                               class="w-full pl-10 pr-4 py-3 rounded-lg border-2 border-[#F9DCC4] focus:border-[#FF6F61] focus:ring-2 focus:ring-[#FF6F61]/30 outline-none transition-all"
                               placeholder="0">
                    </div>
                    @error('price')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
                
                <!-- Stock -->
                <div>
                    <label class="block text-[#4D4C7D] font-medium mb-2">
                        Stock <span class="text-red-500">*</span>
                    </label>
                    <input type="number" 
                           name="stock" 
                           required
                           min="0"
                           class="w-full px-4 py-3 rounded-lg border-2 border-[#F9DCC4] focus:border-[#FF6F61] focus:ring-2 focus:ring-[#FF6F61]/30 outline-none transition-all"
                           placeholder="Enter stock quantity">
                    @error('stock')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
                
                <!-- Category -->
                <div>
                    <label class="block text-[#4D4C7D] font-medium mb-2">Category</label>
                    <select name="category" 
                            class="w-full px-4 py-3 rounded-lg border-2 border-[#F9DCC4] focus:border-[#FF6F61] focus:ring-2 focus:ring-[#FF6F61]/30 outline-none transition-all appearance-none">
                        <option value="">Select Category</option>
                        <option value="apparel">Apparel</option>
                        <option value="home_decor">Home Decor</option>
                        <option value="gifts">Gifts</option>
                        <option value="bunny_items">Bunny Items</option>
                    </select>
                </div>
            </div>
            
            <!-- Description -->
            <div class="mb-6">
                <label class="block text-[#4D4C7D] font-medium mb-2">Description</label>
                <textarea name="description" 
                          rows="4"
                          class="w-full px-4 py-3 rounded-lg border-2 border-[#F9DCC4] focus:border-[#FF6F61] focus:ring-2 focus:ring-[#FF6F61]/30 outline-none transition-all resize-none"
                          placeholder="Describe your product..."></textarea>
                <div class="text-right text-sm text-[#8E7AB5] mt-1">
                    <span id="char-count">0</span>/1000 characters
                </div>
                @error('description')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Product Image -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
            <h2 class="text-xl font-bold text-[#4D4C7D] mb-6 flex items-center">
                <i class="fas fa-image mr-3 text-[#8E7AB5]"></i>
                Product Image
            </h2>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Image Upload -->
                <div>
                    <label class="block text-[#4D4C7D] font-medium mb-2">
                        Upload Image <span class="text-red-500">*</span>
                    </label>
                    <div class="border-2 border-dashed border-[#F9DCC4] rounded-xl p-6 text-center hover:border-[#8E7AB5] transition-colors cursor-pointer"
                         onclick="document.getElementById('photo').click()">
                        <input type="file" 
                               id="photo" 
                               name="photo" 
                               accept="image/*"
                               class="hidden"
                               onchange="previewImage(this)"
                               required>
                        
                        <div id="image-preview" class="hidden mb-4">
                            <img id="preview-image" class="max-w-full max-h-64 mx-auto rounded-lg">
                            <button type="button" 
                                    onclick="removeImage()"
                                    class="mt-2 text-[#FF6F61] hover:text-red-700">
                                <i class="fas fa-trash mr-1"></i> Remove image
                            </button>
                        </div>
                        
                        <div id="upload-prompt">
                            <i class="fas fa-cloud-upload-alt text-4xl text-[#8E7AB5] mb-3"></i>
                            <p class="text-[#4D4C7D] mb-2">Click to upload product image</p>
                            <p class="text-sm text-[#8E7AB5] mb-4">Supported: JPG, PNG, WebP (Max: 2MB)</p>
                            <div class="inline-block bg-[#FCEFEA] text-[#4D4C7D] px-6 py-2 rounded-lg font-bold">
                                <i class="fas fa-image mr-2"></i> Choose File
                            </div>
                        </div>
                    </div>
                    @error('photo')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
                
                <!-- Image Guidelines -->
                <div>
                    <h3 class="font-bold text-[#4D4C7D] mb-4">Image Guidelines</h3>
                    <ul class="space-y-3 text-sm text-[#4D4C7D]">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                            <span>Use high-quality images with good lighting</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                            <span>Recommended size: 800x800 pixels or square ratio</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                            <span>Show the product from multiple angles if possible</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                            <span>Use white or neutral background for best results</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-exclamation-triangle text-yellow-500 mr-2 mt-1"></i>
                            <span>Maximum file size: 2MB</span>
                        </li>
                    </ul>
                    
                    <!-- Preview Card -->
                    <div class="mt-6 p-4 bg-[#FCEFEA] rounded-lg">
                        <h4 class="font-bold text-[#4D4C7D] mb-2">Preview</h4>
                        <p class="text-sm text-[#8E7AB5]">
                            Your product will appear like this in the shop
                        </p>
                        <div id="preview-card" class="mt-4 bg-white rounded-lg shadow-sm p-4">
                            <div class="w-full h-40 bg-gradient-to-br from-[#F9DCC4] to-[#8E7AB5] rounded-lg flex items-center justify-center mb-3">
                                <i class="fas fa-box text-white text-3xl"></i>
                            </div>
                            <div class="font-bold text-[#4D4C7D] text-sm mb-1">Product Name</div>
                            <div class="text-[#FF6F61] font-bold">Rp 0</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Information -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
            <h2 class="text-xl font-bold text-[#4D4C7D] mb-6 flex items-center">
                <i class="fas fa-cog mr-3 text-[#8E7AB5]"></i>
                Additional Information
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Weight -->
                <div>
                    <label class="block text-[#4D4C7D] font-medium mb-2">Weight (kg)</label>
                    <input type="number" 
                           name="weight" 
                           step="0.1"
                           min="0"
                           class="w-full px-4 py-3 rounded-lg border-2 border-[#F9DCC4] focus:border-[#FF6F61] focus:ring-2 focus:ring-[#FF6F61]/30 outline-none transition-all"
                           placeholder="0.5">
                </div>
                
                <!-- Dimensions -->
                <div>
                    <label class="block text-[#4D4C7D] font-medium mb-2">Dimensions (cm)</label>
                    <div class="flex gap-2">
                        <input type="text" 
                               name="dimensions_length" 
                               placeholder="Length"
                               class="flex-1 px-4 py-3 rounded-lg border-2 border-[#F9DCC4] focus:border-[#FF6F61] focus:ring-2 focus:ring-[#FF6F61]/30 outline-none transition-all">
                        <input type="text" 
                               name="dimensions_width" 
                               placeholder="Width"
                               class="flex-1 px-4 py-3 rounded-lg border-2 border-[#F9DCC4] focus:border-[#FF6F61] focus:ring-2 focus:ring-[#FF6F61]/30 outline-none transition-all">
                        <input type="text" 
                               name="dimensions_height" 
                               placeholder="Height"
                               class="flex-1 px-4 py-3 rounded-lg border-2 border-[#F9DCC4] focus:border-[#FF6F61] focus:ring-2 focus:ring-[#FF6F61]/30 outline-none transition-all">
                    </div>
                </div>
                
                <!-- Material -->
                <div>
                    <label class="block text-[#4D4C7D] font-medium mb-2">Material</label>
                    <input type="text" 
                           name="material"
                           class="w-full px-4 py-3 rounded-lg border-2 border-[#F9DCC4] focus:border-[#FF6F61] focus:ring-2 focus:ring-[#FF6F61]/30 outline-none transition-all"
                           placeholder="e.g., Cotton, Polyester, etc.">
                </div>
                
                <!-- Color -->
                <div>
                    <label class="block text-[#4D4C7D] font-medium mb-2">Color</label>
                    <input type="text" 
                           name="color"
                           class="w-full px-4 py-3 rounded-lg border-2 border-[#F9DCC4] focus:border-[#FF6F61] focus:ring-2 focus:ring-[#FF6F61]/30 outline-none transition-all"
                           placeholder="e.g., Red, Blue, Pink, etc.">
                </div>
            </div>
            
            <!-- Features -->
            <div class="mt-6">
                <label class="block text-[#4D4C7D] font-medium mb-2">Features (Optional)</label>
                <div id="features-container">
                    <!-- Features will be added here -->
                </div>
                <button type="button" 
                        onclick="addFeatureField()"
                        class="mt-2 text-[#8E7AB5] hover:text-[#FF6F61] flex items-center">
                    <i class="fas fa-plus mr-2"></i>
                    Add Feature
                </button>
            </div>
        </div>

        <!-- SEO Settings -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
            <h2 class="text-xl font-bold text-[#4D4C7D] mb-6 flex items-center">
                <i class="fas fa-search mr-3 text-[#8E7AB5]"></i>
                SEO Settings
            </h2>
            
            <div class="space-y-6">
                <!-- Meta Title -->
                <div>
                    <label class="block text-[#4D4C7D] font-medium mb-2">Meta Title</label>
                    <input type="text" 
                           name="meta_title"
                           class="w-full px-4 py-3 rounded-lg border-2 border-[#F9DCC4] focus:border-[#FF6F61] focus:ring-2 focus:ring-[#FF6F61]/30 outline-none transition-all"
                           placeholder="Optimized title for search engines">
                    <div class="text-sm text-[#8E7AB5] mt-1">
                        Recommended: 50-60 characters
                    </div>
                </div>
                
                <!-- Meta Description -->
                <div>
                    <label class="block text-[#4D4C7D] font-medium mb-2">Meta Description</label>
                    <textarea name="meta_description" 
                              rows="3"
                              class="w-full px-4 py-3 rounded-lg border-2 border-[#F9DCC4] focus:border-[#FF6F61] focus:ring-2 focus:ring-[#FF6F61]/30 outline-none transition-all resize-none"
                              placeholder="Brief description for search engine results"></textarea>
                    <div class="text-sm text-[#8E7AB5] mt-1">
                        Recommended: 150-160 characters
                    </div>
                </div>
                
                <!-- Keywords -->
                <div>
                    <label class="block text-[#4D4C7D] font-medium mb-2">Keywords</label>
                    <input type="text" 
                           name="keywords"
                           class="w-full px-4 py-3 rounded-lg border-2 border-[#F9DCC4] focus:border-[#FF6F61] focus:ring-2 focus:ring-[#FF6F61]/30 outline-none transition-all"
                           placeholder="cute, bunny, plush, gift, etc.">
                    <div class="text-sm text-[#8E7AB5] mt-1">
                        Separate keywords with commas
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <div class="flex flex-col md:flex-row gap-4">
                <button type="submit" 
                        class="flex-1 bg-gradient-to-r from-[#FF6F61] to-[#8E7AB5] text-white py-4 rounded-lg font-bold hover:opacity-90 transition-all shadow-lg hover:shadow-xl flex items-center justify-center">
                    <i class="fas fa-save mr-2"></i>
                    Save Product
                </button>
                
                <button type="button" 
                        onclick="saveAsDraft()"
                        class="flex-1 bg-[#FCEFEA] text-[#4D4C7D] py-4 rounded-lg font-bold hover:bg-[#F9DCC4] transition-colors shadow-lg hover:shadow-xl flex items-center justify-center">
                    <i class="fas fa-file-alt mr-2"></i>
                    Save as Draft
                </button>
                
                <a href="{{ route('admin.products.index') }}" 
                   class="flex-1 bg-white border-2 border-[#F9DCC4] text-[#4D4C7D] py-4 rounded-lg font-bold hover:bg-[#FCEFEA] transition-colors shadow-lg hover:shadow-xl flex items-center justify-center">
                    <i class="fas fa-times mr-2"></i>
                    Cancel
                </a>
            </div>
            
            <!-- Save Options -->
            <div class="mt-6 pt-6 border-t border-[#F9DCC4]">
                <label class="flex items-center">
                    <input type="checkbox" 
                           name="publish" 
                           checked
                           class="w-4 h-4 text-[#FF6F61] border-[#F9DCC4] rounded focus:ring-[#FF6F61]">
                    <span class="ml-2 text-[#4D4C7D]">Publish immediately</span>
                </label>
                
                <label class="flex items-center mt-3">
                    <input type="checkbox" 
                           name="featured"
                           class="w-4 h-4 text-[#FF6F61] border-[#F9DCC4] rounded focus:ring-[#FF6F61]">
                    <span class="ml-2 text-[#4D4C7D]">Mark as featured product</span>
                </label>
            </div>
        </div>
    </form>
</div>

<script>
    // Character counter for description
    const descriptionTextarea = document.querySelector('textarea[name="description"]');
    const charCount = document.getElementById('char-count');
    
    if (descriptionTextarea && charCount) {
        descriptionTextarea.addEventListener('input', function() {
            charCount.textContent = this.value.length;
            
            // Update preview card
            const previewName = document.querySelector('#preview-card .font-bold');
            if (previewName && !previewName.textContent.includes('Product Name')) {
                previewName.textContent = this.value.substring(0, 50) + (this.value.length > 50 ? '...' : '');
            }
        });
    }
    
    // Update preview card with form data
    document.querySelectorAll('input[name="name"], input[name="price"]').forEach(input => {
        input.addEventListener('input', updatePreviewCard);
    });
    
    function updatePreviewCard() {
        const nameInput = document.querySelector('input[name="name"]');
        const priceInput = document.querySelector('input[name="price"]');
        const previewCard = document.getElementById('preview-card');
        
        if (previewCard && nameInput && priceInput) {
            const nameElement = previewCard.querySelector('.font-bold.text-sm');
            const priceElement = previewCard.querySelector('.text-\[#FF6F61\]');
            
            if (nameElement && nameInput.value) {
                nameElement.textContent = nameInput.value.substring(0, 50) + (nameInput.value.length > 50 ? '...' : '');
            }
            
            if (priceElement && priceInput.value) {
                const formattedPrice = new Intl.NumberFormat('id-ID').format(priceInput.value);
                priceElement.textContent = 'Rp ' + formattedPrice;
            }
        }
    }
    
    // Image preview
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            const maxSize = 2 * 1024 * 1024; // 2MB
            
            if (input.files[0].size > maxSize) {
                alert('File size must be less than 2MB');
                input.value = '';
                return;
            }
            
            reader.onload = function(e) {
                document.getElementById('preview-image').src = e.target.result;
                document.getElementById('image-preview').style.display = 'block';
                document.getElementById('upload-prompt').style.display = 'none';
                
                // Update preview card image
                const previewCardImage = document.querySelector('#preview-card div:first-child');
                if (previewCardImage) {
                    previewCardImage.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover rounded-lg">`;
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    function removeImage() {
        document.getElementById('photo').value = '';
        document.getElementById('image-preview').style.display = 'none';
        document.getElementById('upload-prompt').style.display = 'block';
        
        // Reset preview card image
        const previewCardImage = document.querySelector('#preview-card div:first-child');
        if (previewCardImage) {
            previewCardImage.innerHTML = '<i class="fas fa-box text-white text-3xl"></i>';
        }
    }
    
    // Features management
    let featureCount = 0;
    
    function addFeatureField(value = '') {
        featureCount++;
        const container = document.getElementById('features-container');
        
        const featureDiv = document.createElement('div');
        featureDiv.className = 'flex gap-2 mb-2';
        featureDiv.innerHTML = `
            <input type="text" 
                   name="features[]" 
                   value="${value}"
                   class="flex-grow px-4 py-2 rounded-lg border-2 border-[#F9DCC4] focus:border-[#FF6F61] focus:ring-2 focus:ring-[#FF6F61]/30 outline-none transition-all"
                   placeholder="Enter feature (e.g., Machine washable, Non-toxic)">
            <button type="button" 
                    onclick="this.parentElement.remove()"
                    class="w-10 h-10 bg-red-50 text-red-600 rounded-lg flex items-center justify-center hover:bg-red-100 transition-colors">
                <i class="fas fa-times"></i>
            </button>
        `;
        
        container.appendChild(featureDiv);
    }
    
    // Form validation
    document.getElementById('product-form').addEventListener('submit', function(e) {
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        
        // Validate required fields
        const requiredFields = this.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                field.classList.add('border-red-500');
                field.classList.remove('border-[#F9DCC4]');
            } else {
                field.classList.remove('border-red-500');
                field.classList.add('border-[#F9DCC4]');
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            alert('Please fill in all required fields');
            return;
        }
        
        // Validate image
        const imageInput = document.getElementById('photo');
        if (imageInput && imageInput.files.length > 0) {
            const file = imageInput.files[0];
            const validTypes = ['image/jpeg', 'image/png', 'image/webp'];
            const maxSize = 2 * 1024 * 1024; // 2MB
            
            if (!validTypes.includes(file.type)) {
                e.preventDefault();
                alert('Only JPG, PNG, and WebP images are allowed');
                return;
            }
            
            if (file.size > maxSize) {
                e.preventDefault();
                alert('Image size must be less than 2MB');
                return;
            }
        }
        
        // Show loading
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Saving...';
        submitBtn.disabled = true;
    });
    
    function saveAsDraft() {
        const form = document.getElementById('product-form');
        const draftInput = document.createElement('input');
        draftInput.type = 'hidden';
        draftInput.name = 'draft';
        draftInput.value = '1';
        form.appendChild(draftInput);
        form.submit();
    }
    
    // Auto-save draft
    let autoSaveTimeout;
    document.querySelectorAll('#product-form input, #product-form textarea, #product-form select').forEach(element => {
        element.addEventListener('input', function() {
            clearTimeout(autoSaveTimeout);
            autoSaveTimeout = setTimeout(saveDraft, 3000);
        });
    });
    
    function saveDraft() {
        console.log('Auto-saving draft...');
        // Implement auto-save functionality here
    }
    
    // Load saved draft on page load
    window.addEventListener('load', function() {
        const savedDraft = localStorage.getItem('product_draft');
        if (savedDraft) {
            const draft = JSON.parse(savedDraft);
            Object.keys(draft).forEach(key => {
                const field = document.querySelector(`[name="${key}"]`);
                if (field) {
                    if (field.type === 'checkbox') {
                        field.checked = draft[key];
                    } else {
                        field.value = draft[key];
                    }
                }
            });
            
            if (confirm('Found a saved draft. Would you like to restore it?')) {
                updatePreviewCard();
            }
        }
    });
    
    // Save draft before leaving page
    window.addEventListener('beforeunload', function(e) {
        const formData = new FormData(document.getElementById('product-form'));
        const data = {};
        formData.forEach((value, key) => {
            data[key] = value;
        });
        localStorage.setItem('product_draft', JSON.stringify(data));
    });
</script>

<style>
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>
@endsection