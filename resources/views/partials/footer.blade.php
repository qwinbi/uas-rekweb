<footer class="bg-white border-t" style="border-color: var(--light);">
    <div class="container mx-auto px-4 py-12">
        <!-- Main Footer -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
            <!-- Brand -->
            <div>
                <a href="{{ route('home') }}" class="flex items-center space-x-3 mb-6">
                    <div class="w-12 h-12 gradient-primary rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-bunny text-white text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-display" style="color: var(--primary);">BUNNYPOPS</h3>
                        <p class="text-sm" style="color: var(--accent);">Spread happiness everywhere</p>
                    </div>
                </a>
                
                <p class="mb-6" style="color: var(--accent);">
                    Bringing you the cutest products to make every day special. 
                    Quality guaranteed with love in every item.
                </p>
                
                <div class="flex space-x-3">
                    <a href="#" class="social-icon">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-tiktok"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-pinterest"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="font-semibold mb-6 text-lg" style="color: var(--primary);">Quick Links</h4>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('shop') }}" class="footer-link">
                            <i class="fas fa-chevron-right text-xs mr-2"></i>
                            Shop All Products
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}" class="footer-link">
                            <i class="fas fa-chevron-right text-xs mr-2"></i>
                            Our Story
                        </a>
                    </li>
                    <li>
                        <a href="#" class="footer-link">
                            <i class="fas fa-chevron-right text-xs mr-2"></i>
                            New Arrivals
                        </a>
                    </li>
                    <li>
                        <a href="#" class="footer-link">
                            <i class="fas fa-chevron-right text-xs mr-2"></i>
                            Best Sellers
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Help & Support -->
            <div>
                <h4 class="font-semibold mb-6 text-lg" style="color: var(--primary);">Help & Support</h4>
                <ul class="space-y-3">
                    <li>
                        <a href="#" class="footer-link">
                            <i class="fas fa-chevron-right text-xs mr-2"></i>
                            FAQ
                        </a>
                    </li>
                    <li>
                        <a href="#" class="footer-link">
                            <i class="fas fa-chevron-right text-xs mr-2"></i>
                            Shipping Info
                        </a>
                    </li>
                    <li>
                        <a href="#" class="footer-link">
                            <i class="fas fa-chevron-right text-xs mr-2"></i>
                            Returns & Exchanges
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="footer-link">
                            <i class="fas fa-chevron-right text-xs mr-2"></i>
                            Contact Us
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div>
                <h4 class="font-semibold mb-6 text-lg" style="color: var(--primary);">Stay Updated</h4>
                <p class="mb-4" style="color: var(--accent);">
                    Subscribe to get special offers, free giveaways, and cute surprises!
                </p>
                
                <form class="space-y-3">
                    <div class="relative">
                        <input type="email" 
                               placeholder="Your email address" 
                               class="w-full pl-4 pr-12 py-3 rounded-xl border outline-none transition-all"
                               style="border-color: var(--light); color: var(--accent);">
                        <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 w-8 h-8 gradient-primary rounded-lg flex items-center justify-center text-white hover:scale-110 transition-transform">
                            <i class="fas fa-paper-plane text-sm"></i>
                        </button>
                    </div>
                    <p class="text-xs" style="color: var(--accent); opacity: 0.7;">
                        We respect your privacy. Unsubscribe at any time.
                    </p>
                </form>
            </div>
        </div>

        <!-- Bottom Footer -->
        <div class="pt-8 border-t" style="border-color: var(--light);">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <p class="text-sm" style="color: var(--accent);">
                        &copy; {{ date('Y') }} BUNNYPOPS. All rights reserved.
                    </p>
                    <p class="text-xs mt-1" style="color: var(--accent); opacity: 0.7;">
                        Made with <i class="fas fa-heart" style="color: var(--pink); margin: 0 0.25rem;"></i> 
                        by Syarifatul Azkiya Alganjari
                    </p>
                </div>
                
                <div class="text-center md:text-right">
                    <p class="text-sm mb-2" style="color: var(--accent);">
                        NIM: 241011701321 • Kelas: 03SIFP014 • Rekayasa Web
                    </p>
                    <p class="text-xs" style="color: var(--accent); opacity: 0.7;">
                        Tugas UAS - Ibu Mega Permata Sapani S.Kom., M.Kom.
                    </p>
                </div>
            </div>
            
            <!-- Payment Methods -->
            <div class="flex justify-center space-x-4 mt-6">
                <div class="p-2 bg-white rounded-lg shadow-sm border" style="border-color: var(--light);">
                    <i class="fab fa-cc-visa text-xl" style="color: var(--secondary);"></i>
                </div>
                <div class="p-2 bg-white rounded-lg shadow-sm border" style="border-color: var(--light);">
                    <i class="fab fa-cc-mastercard text-xl" style="color: var(--primary);"></i>
                </div>
                <div class="p-2 bg-white rounded-lg shadow-sm border" style="border-color: var(--light);">
                    <i class="fas fa-qrcode text-xl" style="color: var(--accent);"></i>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
    .footer-link {
        @apply flex items-center transition-colors duration-300;
        color: var(--accent);
    }
    
    .footer-link:hover {
        color: var(--primary);
        transform: translateX(4px);
    }
    
    .social-icon {
        @apply w-10 h-10 rounded-xl flex items-center justify-center transition-all duration-300 hover:scale-110;
        background-color: var(--light);
        color: var(--accent);
    }
    
    .social-icon:hover {
        background: linear-gradient(135deg, var(--pink) 0%, var(--secondary) 100%);
        color: white;
    }
</style>