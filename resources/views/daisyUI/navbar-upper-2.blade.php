<header style="background: var(--color-secondary); border-bottom: 1px solid rgba(0,0,0,0.08); position: sticky; top: 0; z-index: 1000;">
    <div class="container mx-auto px-4 py-3 flex items-center justify-between">
        
        <!-- Logo -->
        <a href="{{ localizedRoute('welcome') }}" class="flex items-center gap-2">
            @if(isset($logoPath) && $logoPath)
                <img src="{{ asset($logoPath) }}" alt="Twasol Logo" style="max-height: 48px; object-fit: contain;">
            @else
                <span class="font-extrabold text-2xl tracking-wider" style="color: var(--color-primary);">
                    {{ app()->getLocale() == 'ar' ? 'تواصل' : 'Twasol' }}
                </span>
            @endif
        </a>

        <!-- Desktop Menu -->
        <nav class="hidden lg:flex items-center gap-8">
            <a href="{{ localizedRoute('welcome') }}" class="font-semibold hover:opacity-85 transition-opacity" style="color: var(--color-primary);">
                {{ app()->getLocale() == 'ar' ? 'الرئيسية' : 'Home' }}
            </a>
            <a href="{{ localizedRoute('about') }}" class="font-semibold hover:opacity-85 transition-opacity" style="color: var(--color-primary);">
                {{ app()->getLocale() == 'ar' ? 'من نحن' : 'About Us' }}
            </a>
            <a href="{{ localizedRoute('services.landing') }}" class="font-semibold hover:opacity-85 transition-opacity" style="color: var(--color-primary);">
                {{ app()->getLocale() == 'ar' ? 'خدماتنا' : 'Services' }}
            </a>
            <a href="{{ localizedRoute('customers.landing') }}" class="font-semibold hover:opacity-85 transition-opacity" style="color: var(--color-primary);">
                {{ app()->getLocale() == 'ar' ? 'عملائنا' : 'Customers' }}
            </a>
            <a href="{{ localizedRoute('customer-service') }}" class="font-semibold hover:opacity-85 transition-opacity" style="color: var(--color-primary);">
                {{ app()->getLocale() == 'ar' ? 'خدمة العملاء' : 'Customer Service' }}
            </a>
            <a href="{{ localizedRoute('contact') }}" class="font-semibold hover:opacity-85 transition-opacity" style="color: var(--color-primary);">
                {{ app()->getLocale() == 'ar' ? 'تواصل معنا' : 'Contact' }}
            </a>
        </nav>

        <!-- Right Buttons (Lang) -->
        <div class="hidden lg:flex items-center gap-4">
            <!-- Language Switcher -->
            <a href="{{ route('lang.switch', ['locale' => app()->getLocale(), 'lang' => app()->getLocale() == 'ar' ? 'en' : 'ar']) }}" class="btn btn-sm btn-outline rounded-full font-bold px-4" style="border-color: var(--color-primary); color: var(--color-primary);">
                <i class="fas fa-globe mr-1"></i>
                {{ app()->getLocale() == 'ar' ? 'English' : 'العربية' }}
            </a>
        </div>

        <!-- Mobile Menu Toggle Button -->
        <button id="mobile-menu-btn" class="lg:hidden p-2 rounded" style="color: var(--color-primary);">
            <i class="fas fa-bars fa-lg"></i>
        </button>
    </div>

    <!-- Mobile Dropdown Menu -->
    <div id="mobile-menu" class="hidden lg:hidden" style="background: var(--color-secondary); border-top: 1px solid rgba(0,0,0,0.08);">
        <div class="flex flex-col gap-4 p-4">
            <a href="{{ localizedRoute('welcome') }}" class="font-semibold py-2 border-b border-gray-100" style="color: var(--color-primary);">
                {{ app()->getLocale() == 'ar' ? 'الرئيسية' : 'Home' }}
            </a>
            <a href="{{ localizedRoute('about') }}" class="font-semibold py-2 border-b border-gray-100" style="color: var(--color-primary);">
                {{ app()->getLocale() == 'ar' ? 'من نحن' : 'About Us' }}
            </a>
            <a href="{{ localizedRoute('services.landing') }}" class="font-semibold py-2 border-b border-gray-100" style="color: var(--color-primary);">
                {{ app()->getLocale() == 'ar' ? 'خدماتنا' : 'Services' }}
            </a>
            <a href="{{ localizedRoute('customers.landing') }}" class="font-semibold py-2 border-b border-gray-100" style="color: var(--color-primary);">
                {{ app()->getLocale() == 'ar' ? 'عملائنا' : 'Customers' }}
            </a>
            <a href="{{ localizedRoute('customer-service') }}" class="font-semibold py-2 border-b border-gray-100" style="color: var(--color-primary);">
                {{ app()->getLocale() == 'ar' ? 'خدمة العملاء' : 'Customer Service' }}
            </a>
            <a href="{{ localizedRoute('contact') }}" class="font-semibold py-2 border-b border-gray-100" style="color: var(--color-primary);">
                {{ app()->getLocale() == 'ar' ? 'تواصل معنا' : 'Contact' }}
            </a>
            <div class="flex flex-col sm:flex-row gap-3 pt-2">
                <a href="{{ route('lang.switch', ['locale' => app()->getLocale(), 'lang' => app()->getLocale() == 'ar' ? 'en' : 'ar']) }}" class="btn btn-outline rounded-full text-center" style="border-color: var(--color-primary); color: var(--color-primary);">
                    <i class="fas fa-globe mr-1"></i>
                    {{ app()->getLocale() == 'ar' ? 'English' : 'العربية' }}
                </a>
            </div>
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');
        
        btn.addEventListener('click', function () {
            menu.classList.toggle('hidden');
        });
    });
</script>