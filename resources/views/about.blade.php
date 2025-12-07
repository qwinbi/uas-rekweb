@extends('layouts.app')

@section('title', 'About Us')

@section('content')
<!-- Hero Section -->
<section class="hero-about mb-5">
    <div class="row align-items-center">
        <div class="col-lg-6">
            <h1 class="display-4 fw-bold mb-3">
                About <span class="text-primary">{{ config('app.name') }}</span>
            </h1>
            <p class="lead mb-4">
                We are committed to providing the best online shopping experience with 
                quality products, excellent customer service, and fast delivery.
            </p>
            <div class="d-flex gap-3">
                <a href="{{ route('shop') }}" class="btn btn-primary btn-lg px-4">
                    <i class="fas fa-shopping-bag me-2"></i>Shop Now
                </a>
                <a href="#contact" class="btn btn-outline-primary btn-lg px-4">
                    <i class="fas fa-envelope me-2"></i>Contact Us
                </a>
            </div>
        </div>
        <div class="col-lg-6">
            <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                 alt="About Us" class="img-fluid rounded-3 shadow">
        </div>
    </div>
</section>

<!-- Our Story -->
<section class="mb-5">
    <div class="row">
        <div class="col-lg-8 mx-auto text-center">
            <h2 class="fw-bold mb-4">Our Story</h2>
            <p class="lead text-muted mb-5">
                Founded in 2020, {{ config('app.name') }} started as a small online store 
                with a big vision: to make quality products accessible to everyone. 
                Today, we serve thousands of customers nationwide with a curated 
                selection of products you'll love.
            </p>
        </div>
    </div>
    
    <div class="row g-4">
        @foreach([
            ['icon' => 'fas fa-bullseye', 'title' => 'Our Mission', 'desc' => 'To provide exceptional value through quality products and outstanding customer service.'],
            ['icon' => 'fas fa-eye', 'title' => 'Our Vision', 'desc' => 'To be the most trusted online shopping destination in Indonesia.'],
            ['icon' => 'fas fa-handshake', 'title' => 'Our Values', 'desc' => 'Integrity, quality, customer satisfaction, and innovation drive everything we do.']
        ] as $item)
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4 text-center">
                    <div class="icon-wrapper mb-4">
                        <i class="{{ $item['icon'] }} fa-3x text-primary"></i>
                    </div>
                    <h4 class="fw-bold mb-3">{{ $item['title'] }}</h4>
                    <p class="text-muted">{{ $item['desc'] }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- Why Choose Us -->
<section class="mb-5">
    <h2 class="fw-bold text-center mb-5">Why Choose Us?</h2>
    
    <div class="row g-4">
        @foreach([
            ['icon' => 'fas fa-shipping-fast', 'title' => 'Fast Delivery', 'desc' => 'Free shipping for orders above Rp 300,000'],
            ['icon' => 'fas fa-shield-alt', 'title' => 'Secure Payment', 'desc' => '100% secure payment with encryption'],
            ['icon' => 'fas fa-undo', 'title' => 'Easy Returns', 'desc' => '30-day return policy'],
            ['icon' => 'fas fa-headset', 'title' => '24/7 Support', 'desc' => 'Dedicated customer support team'],
            ['icon' => 'fas fa-award', 'title' => 'Quality Products', 'desc' => 'Curated selection of premium products'],
            ['icon' => 'fas fa-tags', 'title' => 'Best Price', 'desc' => 'Competitive pricing with regular discounts']
        ] as $item)
        <div class="col-lg-4 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex">
                        <div class="icon-wrapper-sm me-3">
                            <i class="{{ $item['icon'] }} fa-2x text-primary"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-2">{{ $item['title'] }}</h5>
                            <p class="text-muted mb-0">{{ $item['desc'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- Team Section -->
<section class="mb-5">
    <h2 class="fw-bold text-center mb-5">Meet Our Team</h2>
    
    <div class="row g-4">
        @for($i = 1; $i <= 4; $i++)
        <div class="col-lg-3 col-md-6">
            <div class="card team-card border-0 shadow-sm">
                <div class="card-body text-center p-4">
                    <img src="https://i.pravatar.cc/150?img={{ $i + 10 }}" 
                         alt="Team Member" class="rounded-circle mb-3" width="120">
                    <h5 class="fw-bold mb-1">Team Member {{ $i }}</h5>
                    <p class="text-muted mb-3">Position Title</p>
                    <div class="social-links">
                        <a href="#" class="text-primary me-2">
                            <i class="fab fa-linkedin"></i>
                        </a>
                        <a href="#" class="text-primary me-2">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-primary">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endfor
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="mb-5">
    <div class="card border-0 shadow-sm">
        <div class="card-body p-5">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="fw-bold mb-4">Get In Touch</h2>
                    <div class="contact-info mb-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-wrapper-sm me-3">
                                <i class="fas fa-map-marker-alt text-primary"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0">Address</h6>
                                <p class="text-muted mb-0">Jl. Sudirman No. 123, Jakarta Pusat, Indonesia</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-wrapper-sm me-3">
                                <i class="fas fa-phone text-primary"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0">Phone</h6>
                                <p class="text-muted mb-0">+62 812 3456 7890</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="icon-wrapper-sm me-3">
                                <i class="fas fa-envelope text-primary"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0">Email</h6>
                                <p class="text-muted mb-0">info@tokoonline.com</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="map-container mb-4">
                        <div class="ratio ratio-16x9">
                            <div class="bg-light rounded d-flex align-items-center justify-content-center">
                                <i class="fas fa-map-marked-alt fa-3x text-muted"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <form class="contact-form">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Subject</label>
                                <input type="text" class="form-control" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Message</label>
                                <textarea class="form-control" rows="4" required></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-paper-plane me-2"></i>Send Message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQs -->
<section class="mb-5">
    <h2 class="fw-bold text-center mb-5">Frequently Asked Questions</h2>
    
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="accordion" id="faqAccordion">
                @foreach([
                    ['q' => 'How long does shipping take?', 'a' => 'Standard shipping takes 5-7 business days. Express shipping takes 2-3 business days.'],
                    ['q' => 'What is your return policy?', 'a' => 'We offer a 30-day return policy for unused items in original packaging.'],
                    ['q' => 'Do you ship internationally?', 'a' => 'Currently, we only ship within Indonesia.'],
                    ['q' => 'What payment methods do you accept?', 'a' => 'We accept credit cards, bank transfers, QRIS, and e-wallets.'],
                    ['q' => 'How can I track my order?', 'a' => 'You will receive a tracking number via email once your order ships.']
                ] as $index => $faq)
                <div class="accordion-item border-0 mb-3">
                    <h6 class="accordion-header">
                        <button class="accordion-button collapsed shadow-sm" type="button" 
                                data-bs-toggle="collapse" data-bs-target="#faq{{ $index }}">
                            {{ $faq['q'] }}
                        </button>
                    </h6>
                    <div id="faq{{ $index }}" class="accordion-collapse collapse" 
                         data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            {{ $faq['a'] }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<style>
    .hero-about {
        padding: 4rem 0;
    }
    
    .icon-wrapper {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, rgba(67, 97, 238, 0.1), rgba(58, 12, 163, 0.1));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
    }
    
    .icon-wrapper-sm {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, rgba(67, 97, 238, 0.1), rgba(58, 12, 163, 0.1));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .team-card {
        transition: transform 0.3s ease;
    }
    
    .team-card:hover {
        transform: translateY(-10px);
    }
    
    .social-links a {
        transition: all 0.3s ease;
    }
    
    .social-links a:hover {
        transform: translateY(-2px);
    }
    
    .contact-form .form-control {
        border-radius: 8px;
        padding: 0.75rem;
    }
    
    .contact-form .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25);
    }
    
    .accordion-button {
        border-radius: 8px !important;
        font-weight: 600;
        padding: 1rem 1.5rem;
    }
    
    .accordion-button:not(.collapsed) {
        background-color: rgba(67, 97, 238, 0.1);
        color: var(--primary-color);
    }
    
    .accordion-button:focus {
        box-shadow: none;
        border-color: var(--primary-color);
    }
</style>

<script>
    // Contact form submission
    document.querySelector('.contact-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        Swal.fire({
            title: 'Message Sent!',
            text: 'Thank you for contacting us. We will get back to you soon.',
            icon: 'success',
            confirmButtonText: 'OK'
        });
        
        this.reset();
    });
</script>
@endsection