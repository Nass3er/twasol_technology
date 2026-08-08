<footer class="footer p-10 bg-base-200 text-base-content" style="background-color: #1a1a2e; color: #a0aec0; border-top: 4px solid var(--color-primary); padding: 60px 0;">
    <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-10">
        
        <!-- Column 1: Info -->
        <div>
            <span class="footer-title text-white font-bold text-lg mb-4 block">
                {{ app()->getLocale() == 'ar' ? ($settings['company_name_ar'] ?? 'تواصل تكنولوجي') : ($settings['company_name_en'] ?? 'Twasol Technology') }}
            </span>
            <p class="text-sm leading-relaxed mb-4">
                {{ app()->getLocale() == 'ar' ? 'حلول الربط الشبكي المتقدمة والحلول السحابية واستعادة قواعد البيانات المتضررة باستخدام أفضل التقنيات الرائدة بضمان استقرار الخدمة.' : 'Advanced networking, cloud solutions, and encrypted database recovery using leading technologies with guaranteed stability.' }}
            </p>
            <div class="flex gap-3">
                @if(!empty($settings['facebook']))
                    <a href="{{ $settings['facebook'] }}" target="_blank" class="w-8 h-8 rounded-full flex items-center justify-center text-white text-sm hover:scale-110 transition-transform" style="background: #1877f2;"><i class="fab fa-facebook-f"></i></a>
                @endif
                @if(!empty($settings['instagram']))
                    <a href="{{ $settings['instagram'] }}" target="_blank" class="w-8 h-8 rounded-full flex items-center justify-center text-white text-sm hover:scale-110 transition-transform" style="background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%);"><i class="fab fa-instagram"></i></a>
                @endif
                @if(!empty($settings['youtube']))
                    <a href="{{ $settings['youtube'] }}" target="_blank" class="w-8 h-8 rounded-full flex items-center justify-center text-white text-sm hover:scale-110 transition-transform" style="background: #ff0000;"><i class="fab fa-youtube"></i></a>
                @endif
            </div>
        </div>

        <!-- Column 2: Quick Links -->
        <div>
            <span class="footer-title text-white font-bold text-lg mb-4 block">
                {{ app()->getLocale() == 'ar' ? 'روابط سريعة' : 'Quick Links' }}
            </span>
            <div class="flex flex-col gap-2">
                <a href="{{ localizedRoute('welcome') }}" class="hover:underline hover:text-white">{{ app()->getLocale() == 'ar' ? 'الرئيسية' : 'Home' }}</a>
                <a href="{{ localizedRoute('about') }}" class="hover:underline hover:text-white">{{ app()->getLocale() == 'ar' ? 'من نحن' : 'About Us' }}</a>
                <a href="{{ localizedRoute('services.landing') }}" class="hover:underline hover:text-white">{{ app()->getLocale() == 'ar' ? 'خدماتنا' : 'Services' }}</a>
                <a href="{{ localizedRoute('customers.landing') }}" class="hover:underline hover:text-white">{{ app()->getLocale() == 'ar' ? 'عملائنا' : 'Customers' }}</a>
                <a href="{{ localizedRoute('customer-service') }}" class="hover:underline hover:text-white">{{ app()->getLocale() == 'ar' ? 'طلب خدمة / خدمة العملاء' : 'Customer Service' }}</a>
            </div>
        </div>

        <!-- Column 3: Contact details -->
        <div>
            <span class="footer-title text-white font-bold text-lg mb-4 block">
                {{ app()->getLocale() == 'ar' ? 'تواصل معنا' : 'Contact Us' }}
            </span>
            <div class="flex flex-col gap-3">
                @if(!empty($settings['phone']))
                    <p class="flex items-center gap-2"><i class="fas fa-phone text-white/70"></i> {{ $settings['phone'] }}</p>
                @endif
                @if(!empty($settings['email']))
                    <p class="flex items-center gap-2"><i class="fas fa-envelope text-white/70"></i> {{ $settings['email'] }}</p>
                @endif
                @if(!empty($settings['whatsapp']))
                    <a href="{{ $settings['whatsapp'] }}" target="_blank" class="flex items-center gap-2 hover:underline hover:text-white">
                        <i class="fab fa-whatsapp text-green-500"></i> {{ app()->getLocale() == 'ar' ? 'واتساب الدعم الفني' : 'WhatsApp Support' }}
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="container mx-auto px-4 mt-8 pt-8 border-t border-gray-800 text-center text-xs">
        <p>
            {{ app()->getLocale() == 'ar' 
                ? 'حقوق النشر © ' . date('Y') . ' - جميع الحقوق محفوظة لشركة تواصل تكنولوجي' 
                : 'Copyright © ' . date('Y') . ' - All Rights Reserved by Twasol Technology' }}
        </p>
    </div>
</footer>