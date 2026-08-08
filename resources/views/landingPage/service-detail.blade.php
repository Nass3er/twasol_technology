@extends('layouts.app')

@php
    $serviceName = app()->getLocale() == 'ar' ? $service->name_ar : $service->name_en;
    $serviceDesc = app()->getLocale() == 'ar' ? $service->description_ar : $service->description_en;
@endphp

@section('title', $serviceName . ' - ' . (app()->getLocale() == 'ar' ? 'تواصل تكنولوجي' : 'Twasol Technology'))
@section('meta_description', Str::limit(strip_tags($serviceDesc), 160))

@section('content')

{{-- Hero Header --}}
<section style="background: linear-gradient(135deg, var(--color-primary), #1e293b); padding: 80px 0 50px; text-align: center; color: white;">
    <div class="container mx-auto px-4">
        <!-- Breadcrumbs -->
        <nav class="flex justify-center items-center gap-2 text-sm text-white/80 mb-4" aria-label="Breadcrumb">
            <a href="{{ localizedRoute('welcome') }}" class="hover:text-white transition-colors">
                {{ app()->getLocale() == 'ar' ? 'الرئيسية' : 'Home' }}
            </a>
            <span>/</span>
            <a href="{{ localizedRoute('services.landing') }}" class="hover:text-white transition-colors">
                {{ app()->getLocale() == 'ar' ? 'خدماتنا' : 'Services' }}
            </a>
            <span>/</span>
            <span class="text-white font-semibold">{{ $serviceName }}</span>
        </nav>

        <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-white mb-4" data-aos="fade-up">
            {{ $serviceName }}
        </h1>
    </div>
</section>

{{-- Main Details Section --}}
<section style="padding: 70px 0; background: #f8fafc;">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            
            <!-- Left/Main Column: Image Gallery & Full Description -->
            <div class="lg:col-span-8">
                <div class="bg-white rounded-3xl shadow-lg overflow-hidden p-6 sm:p-8" data-aos="fade-up">
                    
                    <!-- Images Section -->
                    @if($service->images->isNotEmpty())
                        <div class="mb-8">
                            <!-- Main Featured Image -->
                            <div class="rounded-2xl overflow-hidden shadow-md bg-gray-100 mb-4" style="max-height: 480px;">
                                <img id="main-service-img" src="{{ asset($service->images->first()->image_path) }}" alt="{{ $serviceName }}" class="w-full h-full object-cover transition-all duration-300" style="max-height: 480px;">
                            </div>

                            <!-- Thumbnails Gallery if multiple images exist -->
                            @if($service->images->count() > 1)
                                <div class="flex items-center gap-3 overflow-x-auto pb-2">
                                    @foreach($service->images as $img)
                                        <button type="button" onclick="document.getElementById('main-service-img').src = '{{ asset($img->image_path) }}'" class="rounded-xl overflow-hidden border-2 border-transparent hover:border-indigo-600 focus:border-indigo-600 transition-all shrink-0 w-24 h-20 bg-gray-100 shadow-sm">
                                            <img src="{{ asset($img->image_path) }}" alt="Thumbnail {{ $loop->iteration }}" class="w-full h-full object-cover">
                                        </button>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="rounded-2xl mb-8 p-12 text-center" style="background: linear-gradient(135deg, var(--color-primary), #2c3e50);">
                            <i class="fas fa-network-wired fa-5x text-white/40"></i>
                        </div>
                    @endif

                    <!-- Title & Full Description -->
                    <div class="border-b border-gray-100 pb-6 mb-6">
                        <h2 class="text-2xl sm:text-3xl font-bold mb-4" style="color: var(--color-primary);">
                            {{ $serviceName }}
                        </h2>
                        @if($service->price)
                            <div class="inline-block px-4 py-1.5 rounded-full text-base font-bold bg-indigo-50 text-indigo-700">
                                {{ number_format($service->price, 0) }} $
                            </div>
                        @endif
                    </div>

                    <!-- Complete Text Content -->
                    <div class="prose max-w-none text-gray-700 leading-relaxed text-base sm:text-lg" style="white-space: pre-line;">
                        {!! nl2br(e($serviceDesc)) !!}
                    </div>

                    <!-- Call to Action Footer inside card -->
                    <div class="mt-10 pt-6 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                        <span class="text-gray-500 text-sm">
                            {{ app()->getLocale() == 'ar' ? 'هل تريد الاستفسار أو طلب هذه الخدمة؟' : 'Interested in inquiring or requesting this service?' }}
                        </span>
                        <a href="{{ localizedRoute('customer-service', ['service_id' => $service->id]) }}" class="btn px-6 py-3 rounded-full text-white font-bold transition-all shadow-md hover:shadow-lg" style="background: var(--color-primary);">
                            <i class="fas fa-paper-plane mr-2"></i>
                            {{ app()->getLocale() == 'ar' ? 'طلب الخدمة الآن' : 'Request Service Now' }}
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Column: Sidebar & Quick Actions -->
            <div class="lg:col-span-4 space-y-8">
                
                <!-- Request Box Widget -->
                <div class="bg-white rounded-3xl shadow-lg p-6 border border-gray-100" data-aos="fade-up" data-aos-delay="100">
                    <h3 class="text-xl font-bold mb-4" style="color: var(--color-primary);">
                        {{ app()->getLocale() == 'ar' ? 'تواصل معنا مباشرة' : 'Contact Us Directly' }}
                    </h3>
                    <p class="text-gray-600 text-sm mb-6 leading-relaxed">
                        {{ app()->getLocale() == 'ar' ? 'فريقنا المهني في تواصل تكنولوجي جاهز لتقديم الاستشارات الفنية والحلول المخصصة.' : 'Our team at Twasol Technology is ready to provide technical support and custom solutions.' }}
                    </p>

                    <div class="space-y-3">
                        <a href="{{ localizedRoute('customer-service', ['service_id' => $service->id]) }}" class="w-full btn py-3.5 rounded-2xl text-white font-bold flex items-center justify-center gap-2 shadow-md hover:shadow-lg transition-all" style="background: var(--color-primary);">
                            <i class="fas fa-headset"></i>
                            <span>{{ app()->getLocale() == 'ar' ? 'طلب هذه الخدمة' : 'Request This Service' }}</span>
                        </a>

                        @if(!empty($settings['whatsapp']))
                            <a href="{{ $settings['whatsapp'] }}" target="_blank" class="w-full btn py-3.5 rounded-2xl text-white font-bold flex items-center justify-center gap-2 shadow-md hover:shadow-lg transition-all bg-emerald-600 hover:bg-emerald-700">
                                <i class="fab fa-whatsapp text-lg"></i>
                                <span>{{ app()->getLocale() == 'ar' ? 'محادثة واتساب مباشرة' : 'Direct WhatsApp Chat' }}</span>
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Related Services Widget -->
                @if($otherServices->isNotEmpty())
                    <div class="bg-white rounded-3xl shadow-lg p-6 border border-gray-100" data-aos="fade-up" data-aos-delay="200">
                        <h3 class="text-lg font-bold mb-4 border-b border-gray-100 pb-3" style="color: var(--color-primary);">
                            {{ app()->getLocale() == 'ar' ? 'خدمات أخرى ذات صلة' : 'Other Related Services' }}
                        </h3>
                        <div class="space-y-4">
                            @foreach($otherServices as $other)
                                <a href="{{ localizedRoute('services.detail', ['id' => $other->id]) }}" class="flex items-center gap-3 p-2.5 rounded-2xl hover:bg-slate-50 transition-all group">
                                    @if($other->images->isNotEmpty())
                                        <img src="{{ asset($other->images->first()->image_path) }}" alt="{{ $other->name_ar }}" class="w-14 h-14 rounded-xl object-cover shrink-0">
                                    @else
                                        <div class="w-14 h-14 rounded-xl bg-slate-100 flex items-center justify-center shrink-0 text-slate-500">
                                            <i class="fas fa-network-wired"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <h4 class="font-bold text-sm text-gray-800 group-hover:text-indigo-600 transition-colors line-clamp-1">
                                            {{ app()->getLocale() == 'ar' ? $other->name_ar : $other->name_en }}
                                        </h4>
                                        <span class="text-xs text-indigo-600 font-semibold inline-flex items-center gap-1 mt-0.5">
                                            {{ app()->getLocale() == 'ar' ? 'عرض التفاصيل' : 'View Details' }}
                                            <i class="fas fa-chevron-left text-[10px] rtl:rotate-0 ltr:rotate-180"></i>
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
