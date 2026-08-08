@extends('layouts.app')
@section('title', app()->getLocale() == 'ar' ? 'الرئيسية - تواصل تكنولوجي' : 'Home - Twasol Technology')

@section('content')

{{-- HERO SECTION --}}
<section class="hero-section" style="background: linear-gradient(135deg, rgba(15, 23, 42, 0.72) 0%, rgba(30, 41, 59, 0.78) 100%), url('{{ asset('images/hero_background.jpg') }}') no-repeat center center/cover; min-height: 85vh; display: flex; align-items: center; position: relative; overflow: hidden; padding: 80px 0;">
    <!-- Ambient glowing lights behind elements -->
    <div style="position: absolute; top: -10%; right: -10%; width: 40vw; height: 40vw; background: radial-gradient(circle, rgba(var(--color-primary-rgb, 99, 102, 241), 0.15) 0%, transparent 70%); pointer-events: none; filter: blur(50px);"></div>
    <div style="position: absolute; bottom: -10%; left: -10%; width: 30vw; height: 30vw; background: radial-gradient(circle, rgba(var(--color-primary-rgb, 99, 102, 241), 0.1) 0%, transparent 70%); pointer-events: none; filter: blur(50px);"></div>

    <div class="container mx-auto px-4 text-center" style="position: relative; z-index: 2;">
        <!-- Glowing Badge -->
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-semibold text-white/90 bg-white/5 border border-white/10 mb-6 backdrop-blur-md" data-aos="fade-down">
            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
            {{ app()->getLocale() == 'ar' ? 'حلول الربط الشبكي الذكي وتكنولوجيا المعلومات' : 'Smart Networking & IT Solutions' }}
        </div>

        <!-- Logo Container -->
        @if(isset($logoPath) && $logoPath)
            <div class="inline-block p-4 bg-white rounded-2xl shadow-2xl mb-6 logo-card-shadow" data-aos="zoom-in" data-aos-delay="100" style="transition: transform 0.3s ease;">
                <img src="{{ asset($logoPath) }}" alt="{{ $settings['company_name_ar'] ?? 'Twasol' }}" class="hero-logo" style="max-height: 80px; max-width: 220px; object-fit: contain;">
            </div>
        @endif

        <!-- Responsive Headings -->
        <h1 class="text-white font-extrabold mb-4 hero-title" style="font-size: clamp(2rem, 6vw, 3.8rem); line-height: 1.25; letter-spacing: -0.02em;" data-aos="fade-up" data-aos-delay="200">
            {{ $settings['company_name_ar'] ?? 'تواصل تكنولوجي' }}
            @if(app()->getLocale() == 'en')
                <span class="hero-subtitle block mt-2" style="font-size: 0.55em; font-weight: 400; color: #a5b4fc;">{{ $settings['company_name_en'] ?? 'Twasol Technology' }}</span>
            @else
                <span class="hero-subtitle block mt-2" style="font-size: 0.5em; font-weight: 400; color: #a5b4fc; direction: ltr;">{{ $settings['company_name_en'] ?? 'Twasol Technology' }}</span>
            @endif
        </h1>

        <!-- Short Pitch -->
        <p class="text-base sm:text-lg text-white/70 max-w-2xl mx-auto mb-8 px-4 leading-relaxed" style="font-weight: 300;" data-aos="fade-up" data-aos-delay="300">
            {{ app()->getLocale() == 'ar' ? 'حلول متكاملة للربط الشبكي بين الفروع والتحكم السحابي بأعلى مستويات الأمان والاستقرار ومتابعة عقود الصيانة الدورية.' : 'Integrated solutions for branch connectivity, cloud management with maximum security, stability, and periodic maintenance tracking.' }}
        </p>

        <!-- CTA Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center px-4" data-aos="fade-up" data-aos-delay="400">
            <a href="{{ localizedRoute('services.landing') }}" class="btn px-8 py-3.5 text-white border-2 border-white/20 hover:border-white hover:bg-white hover:text-slate-900 rounded-full w-full sm:w-auto font-bold transition-all duration-300 backdrop-blur-sm" style="background: rgba(255,255,255,0.03);">
                <i class="fas fa-network-wired mr-2"></i>
                {{ app()->getLocale() == 'ar' ? 'اكتشف خدماتنا' : 'Explore Our Services' }}
            </a>
            <a href="{{ localizedRoute('customer-service') }}" class="btn px-8 py-3.5 rounded-full w-full sm:w-auto font-bold transition-all duration-300 text-white shadow-lg shadow-indigo-500/20" style="background: var(--color-primary); border: 2px solid var(--color-primary);">
                <i class="fas fa-headset mr-2"></i>
                {{ app()->getLocale() == 'ar' ? 'تواصل معنا' : 'Contact Us' }}
            </a>
        </div>
    </div>

    <!-- Animated background nodes (Hidden on mobile to reduce clutter and increase page speed) -->
    <div class="floating-icons hidden md:block" style="position: absolute; inset: 0; pointer-events: none; overflow: hidden; opacity: 0.12;">
        <i class="fas fa-network-wired" style="position: absolute; top: 15%; left: 10%; font-size: 3rem; animation: float 6s ease-in-out infinite; color: #a5b4fc;"></i>
        <i class="fas fa-shield-alt" style="position: absolute; top: 60%; right: 12%; font-size: 2.5rem; animation: float 8s ease-in-out infinite 2s; color: #818cf8;"></i>
        <i class="fas fa-server" style="position: absolute; top: 30%; right: 25%; font-size: 3rem; animation: float 7s ease-in-out infinite 1s; color: #6366f1;"></i>
        <i class="fas fa-laptop" style="position: absolute; bottom: 20%; left: 15%; font-size: 2.5rem; animation: float 9s ease-in-out infinite 3s; color: #4f46e5;"></i>
    </div>
</section>

<style>
@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(3deg); }
}
.logo-card-shadow {
    box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.5);
}
.logo-card-shadow:hover {
    transform: translateY(-5px);
}
@media (max-width: 640px) {
    .hero-title {
        font-size: 1.8rem !important;
    }
    .hero-subtitle {
        font-size: 0.65em !important;
    }
    .hero-logo {
        max-height: 60px !important;
        max-width: 180px !important;
    }
}
</style>

{{-- STATISTICS SECTION --}}
@if($statistics->isNotEmpty())
<section style="background: var(--color-primary); padding: 60px 0;">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-{{ min($statistics->count(), 4) }} gap-8">
            @foreach($statistics->where('active', true)->take(4) as $stat)
            <div class="text-center" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                @if($stat->icon)
                    <i class="{{ $stat->icon }} fa-2x text-white/70 mb-3 d-block"></i>
                @endif
                <div style="font-size: 2.5rem; font-weight: 800; color: white;">{{ $stat->number }}</div>
                <div style="color: white; opacity: 0.8; font-size: 0.95rem;">
                    {{ app()->getLocale() == 'ar' ? $stat->name_ar : $stat->name_en }}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ABOUT US SECTION --}}
<section style="padding: 80px 0; background: #fff;">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-3xl font-bold mb-4" style="color: var(--color-primary);">
                {{ app()->getLocale() == 'ar' ? 'من نحن' : 'About Us' }}
            </h2>
            <div style="width: 60px; height: 4px; background: var(--color-primary); margin: 0 auto;"></div>
        </div>
        <div class="flex flex-col md:flex-row items-center gap-10 max-w-4xl mx-auto">
            <div class="flex-1" data-aos="fade-right">
                @if(isset($logoPath) && $logoPath)
                    <img src="{{ asset($logoPath) }}" alt="{{ $settings['company_name_ar'] ?? '' }}" class="mx-auto" style="max-height: 180px; max-width: 300px; object-fit: contain;">
                @endif
            </div>
            <div class="flex-1" data-aos="fade-left">
                <p class="text-gray-700 text-lg leading-relaxed">
                    {{ app()->getLocale() == 'ar' ? ($settings['about_ar'] ?? '') : ($settings['about_en'] ?? '') }}
                </p>
                <a href="{{ localizedRoute('about') }}" class="mt-6 inline-block btn btn-outline px-6 py-2 rounded-full" style="border-color: var(--color-primary); color: var(--color-primary);">
                    {{ app()->getLocale() == 'ar' ? 'المزيد عنا' : 'Read More' }} <i class="fas fa-arrow-left ms-2"></i>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- SERVICES SECTION --}}
@if($services->isNotEmpty())
<section style="padding: 80px 0; background: #f8fafc;">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-3xl font-bold mb-4" style="color: var(--color-primary);">
                {{ app()->getLocale() == 'ar' ? 'خدماتنا' : 'Our Services' }}
            </h2>
            <div style="width: 60px; height: 4px; background: var(--color-primary); margin: 0 auto;"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($services->where('active', true)->take(6) as $service)
            <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-1" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                @if($service->images->isNotEmpty())
                    <img src="{{ asset($service->images->first()->image_path) }}" alt="{{ $service->name_ar }}" class="w-full object-cover" style="height: 200px;">
                @else
                    <div style="height: 200px; background: linear-gradient(135deg, var(--color-primary), #2c3e50); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-network-wired fa-3x text-white opacity-50"></i>
                    </div>
                @endif
                <div class="p-6 flex flex-col justify-between flex-1">
                    <div>
                        <h3 class="text-xl font-bold mb-2" style="color: var(--color-primary);">
                            {{ app()->getLocale() == 'ar' ? $service->name_ar : $service->name_en }}
                        </h3>
                        <p class="text-gray-600 text-sm leading-relaxed mb-4">
                            {{ Str::limit(app()->getLocale() == 'ar' ? $service->description_ar : $service->description_en, 110) }}
                        </p>
                    </div>
                    <div class="pt-3 border-t border-gray-100 flex items-center justify-between">
                        <a href="{{ localizedRoute('services.detail', ['id' => $service->id]) }}" class="inline-flex items-center gap-1.5 font-bold text-sm hover:underline" style="color: var(--color-primary);">
                            <span>{{ app()->getLocale() == 'ar' ? 'تفاصيل أكثر' : 'More Details' }}</span>
                            <i class="fas fa-arrow-left text-xs rtl:rotate-0 ltr:rotate-180"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-8" data-aos="fade-up">
            <a href="{{ localizedRoute('services.landing') }}" class="btn btn-lg px-8 py-3 rounded-full text-white" style="background: var(--color-primary);">
                {{ app()->getLocale() == 'ar' ? 'عرض جميع الخدمات' : 'View All Services' }}
            </a>
        </div>
    </div>
</section>
@endif

{{-- CUSTOMERS SECTION (TWO HORIZONTAL SLIDERS) --}}
@if((isset($latestCustomers) && $latestCustomers->isNotEmpty()) || (isset($oldestCustomers) && $oldestCustomers->isNotEmpty()))
<section style="padding: 70px 0; background: #ffffff; overflow: hidden;">
    <div class="container mx-auto px-4">
        
        <!-- Section Header -->
        <div class="text-center mb-10" data-aos="fade-up">
            <h2 class="text-3xl font-extrabold mb-3" style="color: var(--color-primary);">
                {{ app()->getLocale() == 'ar' ? 'شركاء النجاح وعملاؤنا' : 'Our Valued Clients' }}
            </h2>
            <p class="text-slate-500 text-sm max-w-lg mx-auto">
                {{ app()->getLocale() == 'ar' ? 'تفخر تواصل تكنولوجي بتقديم خدماتها لكبرى المؤسسات والشركات' : 'Twasol Technology is proud to serve leading enterprises and organizations' }}
            </p>
            <div style="width: 50px; height: 4px; background: var(--color-primary); margin: 12px auto 0; border-radius: 2px;"></div>
        </div>

        <style>
            .customers-slider-container {
                position: relative;
                margin-bottom: 32px;
            }
            .customers-scroll-row {
                display: flex;
                gap: 20px;
                overflow-x: auto;
                scroll-behavior: smooth;
                padding: 12px 6px;
                -webkit-overflow-scrolling: touch;
                scrollbar-width: thin;
                scrollbar-color: rgba(71, 102, 225, 0.25) transparent;
            }
            .customers-scroll-row::-webkit-scrollbar {
                height: 5px;
            }
            .customers-scroll-row::-webkit-scrollbar-thumb {
                background: rgba(71, 102, 225, 0.3);
                border-radius: 10px;
            }
            .customer-scroll-card {
                width: 190px;
                flex: 0 0 190px;
                background: #ffffff;
                border: 1px solid #e2e8f0;
                border-radius: 20px;
                padding: 20px 14px;
                text-align: center;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
                transition: all 0.3s ease;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }
            .customer-scroll-card:hover {
                transform: translateY(-4px);
                box-shadow: 0 12px 25px rgba(0, 0, 0, 0.08);
                border-color: var(--color-primary);
            }
            .slider-title-badge {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                font-size: 13px;
                font-weight: 700;
                color: var(--color-primary);
                background: rgba(71, 102, 225, 0.08);
                padding: 4px 14px;
                border-radius: 50px;
                margin-bottom: 12px;
            }
            .scroll-btn {
                width: 36px;
                height: 36px;
                border-radius: 50%;
                background: #ffffff;
                border: 1px solid #cbd5e1;
                color: #334155;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                box-shadow: 0 4px 10px rgba(0,0,0,0.06);
                transition: all 0.2s ease;
            }
            .scroll-btn:hover {
                background: var(--color-primary);
                color: #ffffff;
                border-color: var(--color-primary);
            }
        </style>

        <!-- FIRST SLIDER: NEWEST 8 CUSTOMERS -->
        @if(isset($latestCustomers) && $latestCustomers->isNotEmpty())
        <div class="customers-slider-container" data-aos="fade-up">
            <div class="flex items-center justify-between mb-2">
                <span class="slider-title-badge">
                    <i class="fas fa-sparkles text-xs"></i>
                    <span>{{ app()->getLocale() == 'ar' ? 'أحدث العملاء' : 'Newest Clients ' }}</span>
                </span>
                
                <div class="flex items-center gap-2">
                    <button type="button" class="scroll-btn" onclick="document.getElementById('latest-customers-row').scrollBy({left: -250, behavior: 'smooth'})" aria-label="Previous">
                        <i class="fas fa-chevron-right text-xs rtl:rotate-0 ltr:rotate-180"></i>
                    </button>
                    <button type="button" class="scroll-btn" onclick="document.getElementById('latest-customers-row').scrollBy({left: 250, behavior: 'smooth'})" aria-label="Next">
                        <i class="fas fa-chevron-left text-xs rtl:rotate-0 ltr:rotate-180"></i>
                    </button>
                </div>
            </div>

            <div id="latest-customers-row" class="customers-scroll-row">
                @foreach($latestCustomers as $customer)
                <div class="customer-scroll-card">
                    @if($customer->logo)
                        <img src="{{ asset($customer->logo) }}" alt="{{ $customer->name_ar }}" style="height: 60px; width: 100%; object-fit: contain; filter: grayscale(30%); transition: filter 0.3s;" class="hover:filter-none">
                    @else
                        <div style="width: 54px; height: 54px; border-radius: 50%; background: linear-gradient(135deg, var(--color-primary), #1e293b); display: flex; align-items: center; justify-content: center; color: white; font-weight: 800; font-size: 18px;">
                            {{ mb_substr($customer->name_ar, 0, 1) }}
                        </div>
                    @endif
                    <h4 class="text-xs font-bold text-slate-800 mt-3 truncate w-full">
                        {{ app()->getLocale() == 'ar' ? $customer->name_ar : $customer->name_en }}
                    </h4>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- SECOND SLIDER: OLDEST 8 CUSTOMERS -->
        @if(isset($oldestCustomers) && $oldestCustomers->isNotEmpty())
        <div class="customers-slider-container" data-aos="fade-up" data-aos-delay="100">
            <div class="flex items-center justify-between mb-2">
                <!-- <span class="slider-title-badge" style="background: rgba(16, 185, 129, 0.08); color: #059669;">
                    <i class="fas fa-award text-xs"></i>
                    <span>{{ app()->getLocale() == 'ar' ? 'شركاء المسيرة (8)' : 'Long-standing Clients (8)' }}</span>
                </span> -->
                <span class="slider-title-badge">
                    <span></span>
                </span>
            
            
                <div class="flex items-center gap-2">
                    <button type="button" class="scroll-btn" onclick="document.getElementById('oldest-customers-row').scrollBy({left: -250, behavior: 'smooth'})" aria-label="Previous">
                        <i class="fas fa-chevron-right text-xs rtl:rotate-0 ltr:rotate-180"></i>
                    </button>
                    <button type="button" class="scroll-btn" onclick="document.getElementById('oldest-customers-row').scrollBy({left: 250, behavior: 'smooth'})" aria-label="Next">
                        <i class="fas fa-chevron-left text-xs rtl:rotate-0 ltr:rotate-180"></i>
                    </button>
                </div>
            </div>

            <div id="oldest-customers-row" class="customers-scroll-row">
                @foreach($oldestCustomers as $customer)
                <div class="customer-scroll-card">
                    @if($customer->logo)
                        <img src="{{ asset($customer->logo) }}" alt="{{ $customer->name_ar }}" style="height: 60px; width: 100%; object-fit: contain; filter: grayscale(30%); transition: filter 0.3s;" class="hover:filter-none">
                    @else
                        <div style="width: 54px; height: 54px; border-radius: 50%; background: linear-gradient(135deg, #059669, #065f46); display: flex; align-items: center; justify-content: center; color: white; font-weight: 800; font-size: 18px;">
                            {{ mb_substr($customer->name_ar, 0, 1) }}
                        </div>
                    @endif
                    <h4 class="text-xs font-bold text-slate-800 mt-3 truncate w-full">
                        {{ app()->getLocale() == 'ar' ? $customer->name_ar : $customer->name_en }}
                    </h4>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- BUTTON TO VIEW ALL CUSTOMERS -->
        <div class="text-center mt-6" data-aos="fade-up">
            <a href="{{ localizedRoute('customers.landing') }}" class="btn px-8 py-3.5 rounded-full text-white font-bold inline-flex items-center gap-2 shadow-lg transition-all hover:scale-[1.03]" style="background: var(--color-primary);">
                <i class="fas fa-users text-sm"></i>
                <span>{{ app()->getLocale() == 'ar' ? 'كل العملاء' : 'All Customers' }}</span>
                <i class="fas fa-arrow-left text-xs rtl:rotate-0 ltr:rotate-180"></i>
            </a>
        </div>

    </div>
</section>
@endif

{{-- CTA SECTION --}}
<section style="padding: 80px 0; background: linear-gradient(135deg, var(--color-primary) 0%, #2c3e50 100%);">
    <div class="container mx-auto px-4 text-center" data-aos="fade-up">
        <h2 class="text-3xl font-bold text-white mb-4">
            {{ app()->getLocale() == 'ar' ? 'هل تحتاج إلى حلول شبكية احترافية؟' : 'Need Professional Networking Solutions?' }}
        </h2>
        <p class="text-white/80 text-lg mb-8">
            {{ app()->getLocale() == 'ar' ? 'تواصل معنا اليوم وسنساعدك في إيجاد الحل الأمثل لربط فروعك.' : 'Contact us today and we will help you find the optimal solution for connecting your branches.' }}
        </p>
        <a href="{{ localizedRoute('customer-service') }}" class="btn btn-lg px-10 py-3 rounded-full font-bold" style="background: white; color: var(--color-primary);">
            <i class="fas fa-headset mr-2"></i>
            {{ app()->getLocale() == 'ar' ? 'طلب خدمة الآن' : 'Request Service Now' }}
        </a>
    </div>
</section>

@endsection