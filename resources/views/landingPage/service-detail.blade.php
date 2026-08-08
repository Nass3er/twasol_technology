@extends('layouts.app')

@php
    $serviceName = app()->getLocale() == 'ar' ? $service->name_ar : $service->name_en;
    $serviceDesc = app()->getLocale() == 'ar' ? $service->description_ar : $service->description_en;
@endphp

@section('title', $serviceName . ' - ' . (app()->getLocale() == 'ar' ? 'تواصل تكنولوجي' : 'Twasol Technology'))
@section('meta_description', Str::limit(strip_tags($serviceDesc), 160))

@section('content')

{{-- Sub-header Breadcrumb Bar (Clean & Elegant) --}}
<div style="background: #f1f5f9; border-bottom: 1px solid rgba(0,0,0,0.06); padding: 14px 0;">
    <div class="container mx-auto px-4">
        <nav class="flex items-center gap-2 text-sm text-slate-600" aria-label="Breadcrumb">
            <a href="{{ localizedRoute('welcome') }}" class="hover:text-indigo-600 transition-colors">
                {{ app()->getLocale() == 'ar' ? 'الرئيسية' : 'Home' }}
            </a>
            <span class="text-slate-400">/</span>
            <a href="{{ localizedRoute('services.landing') }}" class="hover:text-indigo-600 transition-colors">
                {{ app()->getLocale() == 'ar' ? 'خدماتنا' : 'Services' }}
            </a>
            <span class="text-slate-400">/</span>
            <span class="font-semibold text-slate-900 truncate">{{ $serviceName }}</span>
        </nav>
    </div>
</div>

{{-- Main Details Section --}}
<section style="padding: 50px 0 80px; background: #f8fafc;">
    <div class="container mx-auto px-4">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">

            <!-- RIGHT COLUMN ON DESKTOP / BOTTOM ON MOBILE (Title, Full Description & Action Buttons) -->
            <div class="lg:col-span-7 order-2 lg:order-1 bg-white rounded-3xl p-6 sm:p-10 shadow-sm border border-slate-100" data-aos="fade-up">
                
                <!-- Badge & Title -->
                <div class="mb-6 pb-6 border-b border-slate-100">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full text-xs font-bold text-indigo-700 bg-indigo-50 mb-3">
                        <i class="fas fa-layer-group text-[11px]"></i>
                        <span>{{ app()->getLocale() == 'ar' ? 'خدمة متميزة' : 'Featured Service' }}</span>
                    </div>
                    
                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold leading-snug" style="color: var(--color-primary);">
                        {{ $serviceName }}
                    </h1>

                    @if($service->price)
                        <div class="mt-4 inline-block px-4 py-1.5 rounded-full text-lg font-bold bg-emerald-50 text-emerald-700">
                            {{ number_format($service->price, 0) }} $
                        </div>
                    @endif
                </div>

                <!-- Full Description Body -->
                <div class="mb-8">
                    <h3 class="text-lg font-bold mb-4 text-slate-900">
                        {{ app()->getLocale() == 'ar' ? 'تفاصيل الخدمة' : 'Service Details' }}
                    </h3>
                    <div class="text-slate-700 leading-relaxed text-base sm:text-lg space-y-4" style="white-space: pre-line;">
                        {!! nl2br(e($serviceDesc)) !!}
                    </div>
                </div>

                <!-- Primary Action Buttons -->
                <div class="pt-6 border-t border-slate-100 flex flex-col sm:flex-row gap-4">
                    <a href="{{ localizedRoute('customer-service', ['service_id' => $service->id]) }}" class="btn px-8 py-3.5 rounded-2xl text-white font-bold flex items-center justify-center gap-2 shadow-lg shadow-indigo-500/20 transition-all hover:scale-[1.02]" style="background: var(--color-primary);">
                        <i class="fas fa-paper-plane"></i>
                        <span>{{ app()->getLocale() == 'ar' ? 'طلب هذه الخدمة الآن' : 'Request Service Now' }}</span>
                    </a>

                    @if(!empty($settings['whatsapp']))
                        <a href="{{ $settings['whatsapp'] }}" target="_blank" class="btn px-6 py-3.5 rounded-2xl text-white font-bold flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-700 shadow-lg shadow-emerald-500/20 transition-all hover:scale-[1.02]">
                            <i class="fab fa-whatsapp text-lg"></i>
                            <span>{{ app()->getLocale() == 'ar' ? 'استفسار عبر واتساب' : 'WhatsApp Inquiry' }}</span>
                        </a>
                    @endif
                </div>

            </div>

            <!-- LEFT COLUMN ON DESKTOP / TOP ON MOBILE (Image Gallery & Related Sidebar) -->
            <div class="lg:col-span-5 order-1 lg:order-2 space-y-6" data-aos="fade-up" data-aos-delay="100">
                
                <!-- Images Gallery Card -->
                <div class="bg-white rounded-3xl p-4 sm:p-6 shadow-sm border border-slate-100">
                    @if($service->images->isNotEmpty())
                        <!-- Main Featured Image -->
                        <div class="rounded-2xl overflow-hidden shadow-sm bg-slate-100 mb-4" style="aspect-ratio: 4/3;">
                            <img id="main-service-img" src="{{ asset($service->images->first()->image_path) }}" alt="{{ $serviceName }}" class="w-full h-full object-cover transition-all duration-300">
                        </div>

                        <!-- Thumbnails preview if multiple images exist -->
                        @if($service->images->count() > 1)
                            <div class="flex items-center gap-2.5 overflow-x-auto pb-1">
                                @foreach($service->images as $img)
                                    <button type="button" onclick="document.getElementById('main-service-img').src = '{{ asset($img->image_path) }}'" class="rounded-xl overflow-hidden border-2 border-transparent hover:border-indigo-600 focus:border-indigo-600 transition-all shrink-0 w-20 h-16 bg-slate-100">
                                        <img src="{{ asset($img->image_path) }}" alt="Thumbnail {{ $loop->iteration }}" class="w-full h-full object-cover">
                                    </button>
                                @endforeach
                            </div>
                        @endif
                    @else
                        <div class="rounded-2xl p-12 text-center" style="aspect-ratio: 4/3; background: linear-gradient(135deg, var(--color-primary), #1e293b); display: flex; flex-direction: column; align-items: center; justify-content: center;">
                            <i class="fas fa-network-wired fa-4x text-white/40 mb-3"></i>
                            <span class="text-white/60 text-xs font-semibold">{{ $serviceName }}</span>
                        </div>
                    @endif
                </div>

                <!-- Related Services Card -->
                @if($otherServices->isNotEmpty())
                    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100">
                        <h3 class="text-base font-bold mb-4 border-b border-slate-100 pb-3" style="color: var(--color-primary);">
                            <i class="fas fa-th-large mr-1.5 text-xs"></i>
                            {{ app()->getLocale() == 'ar' ? 'خدمات أخرى ذات صلة' : 'Other Related Services' }}
                        </h3>
                        <div class="space-y-3">
                            @foreach($otherServices as $other)
                                <a href="{{ localizedRoute('services.detail', ['id' => $other->id]) }}" class="flex items-center gap-3 p-2 rounded-2xl hover:bg-slate-50 transition-all group">
                                    @if($other->images->isNotEmpty())
                                        <img src="{{ asset($other->images->first()->image_path) }}" alt="{{ $other->name_ar }}" class="w-12 h-12 rounded-xl object-cover shrink-0">
                                    @else
                                        <div class="w-12 h-12 rounded-xl bg-slate-100 flex items-center justify-center shrink-0 text-slate-500">
                                            <i class="fas fa-network-wired text-sm"></i>
                                        </div>
                                    @endif
                                    <div class="min-w-0 flex-1">
                                        <h4 class="font-bold text-xs text-slate-800 group-hover:text-indigo-600 transition-colors truncate">
                                            {{ app()->getLocale() == 'ar' ? $other->name_ar : $other->name_en }}
                                        </h4>
                                        <span class="text-[11px] text-indigo-600 font-semibold inline-flex items-center gap-1 mt-0.5">
                                            {{ app()->getLocale() == 'ar' ? 'عرض التفاصيل' : 'View Details' }}
                                            <i class="fas fa-chevron-left text-[9px] rtl:rotate-0 ltr:rotate-180"></i>
                                        </span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>

        </div>

    </div>
</section>

@endsection
