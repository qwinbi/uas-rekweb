<footer class="bg-[#4D4C7D] text-white mt-12">
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Logo & Description -->
            <div>
                <a href="{{ route('home') }}" class="flex items-center space-x-3 mb-4">
                    @if(\App\Models\Setting::get('footer_logo'))
                        <img src="{{ asset('storage/logo/' . \App\Models\Setting::get('footer_logo')) }}" 
                             alt="BUNNYPOPS Logo" 
                             class="w-14 h-14 rounded-full object-cover border-2 border-white">
                    @else
                        <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center">
                            <i class="fas fa-bunny text-3xl text-[#FF6F61]"></i>
                        </div>
                    @endif
                    <div>
                        <h3 class="text-2xl font-bold">BUNNYPOPS</h3>
                        <p class="text-sm text-[#F9DCC4]">Cute Shopping Paradise</p>
                    </div>
                </a>
                <p class="text-[#F9DCC4] text-sm mt-3">
                    {{ \App\Models\Setting::get('footer_text', '© 2024 BUNNYPOPS. All rights reserved.') }}
                </p>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="font-bold text-lg mb-4 text-[#F9DCC4]">Quick Links</h4>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('home') }}" class="hover:text-[#F9DCC4] transition-colors flex items-center">
                            <i class="fas fa-chevron-right text-xs mr-2"></i>
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('shop') }}" class="hover:text-[#F9DCC4] transition-colors flex items-center">
                            <i class="fas fa-chevron-right text-xs mr-2"></i>
                            Shop
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}" class="hover:text-[#F9DCC4] transition-colors flex items-center">
                            <i class="fas fa-chevron-right text-xs mr-2"></i>
                            About Us
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('cart.index') }}" class="hover:text-[#F9DCC4] transition-colors flex items-center">
                            <i class="fas fa-chevron-right text-xs mr-2"></i>
                            Shopping Cart
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h4 class="font-bold text-lg mb-4 text-[#F9DCC4]">Contact Us</h4>
                <ul class="space-y-3">
                    <li class="flex items-start">
                        <i class="fas fa-envelope mt-1 mr-3 text-[#FF6F61]"></i>
                        <span>hello@bunnypops.com</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-phone mt-1 mr-3 text-[#FF6F61]"></i>
                        <span>+62 812 3456 7890</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-map-marker-alt mt-1 mr-3 text-[#FF6F61]"></i>
                        <span>Bunny Street 123, Cute City</span>
                    </li>
                </ul>
            </div>

            <!-- Social Media -->
            <div>
                <h4 class="font-bold text-lg mb-4 text-[#F9DCC4]">Follow Us</h4>
                <div class="flex space-x-4 mb-6">
                    <a href="#" class="w-10 h-10 bg-[#8E7AB5] rounded-full flex items-center justify-center hover:bg-[#FF6F61] transition-colors">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-[#8E7AB5] rounded-full flex items-center justify-center hover:bg-[#FF6F61] transition-colors">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-[#8E7AB5] rounded-full flex items-center justify-center hover:bg-[#FF6F61] transition-colors">
                        <i class="fab fa-tiktok"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-[#8E7AB5] rounded-full flex items-center justify-center hover:bg-[#FF6F61] transition-colors">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </div>
                
                <!-- Newsletter -->
                <div class="mt-4">
                    <p class="text-sm mb-2">Subscribe to our newsletter</p>
                    <form class="flex">
                        <input type="email" 
                               placeholder="Your email" 
                               class="flex-grow px-3 py-2 rounded-l-lg text-[#4D4C7D] outline-none">
                        <button type="submit" class="bg-[#FF6F61] px-4 py-2 rounded-r-lg hover:bg-[#FF8A80] transition-colors">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Copyright & Credits -->
        <div class="mt-8 pt-6 border-t border-white/20">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="text-center md:text-left mb-4 md:mb-0">
                    <p class="text-[#F9DCC4] text-sm">
                        Created with <i class="fas fa-heart text-[#FF6F61] mx-1"></i> by Syarifatul Azkiya Alganjari
                    </p>
                </div>
                
                <div class="text-center">
                    <p class="text-sm text-white/80">
                        NIM: 241011701321 | Kelas: 03SIFP014 | Mata Kuliah: Rekayasa Web
                    </p>
                    <p class="text-sm text-white/80 mt-1">
                        Web ini dibuat untuk menyelesaikan Tugas UAS dari Ibu Mega Permata Sapani S.Kom., M.Kom.
                    </p>
                </div>
            </div>
            
            <!-- Payment Methods -->
            <div class="flex justify-center mt-6 space-x-6">
                <div class="bg-white p-2 rounded-lg">
                    <i class="fab fa-cc-visa text-2xl text-[#4D4C7D]"></i>
                </div>
                <div class="bg-white p-2 rounded-lg">
                    <i class="fab fa-cc-mastercard text-2xl text-[#4D4C7D]"></i>
                </div>
                <div class="bg-white p-2 rounded-lg">
                    <i class="fas fa-qrcode text-2xl text-[#4D4C7D]"></i>
                </div>
                <div class="bg-white p-2 rounded-lg">
                    <span class="text-sm font-bold text-[#4D4C7D]">QRIS</span>
                </div>
            </div>
        </div>
    </div>
</footer>