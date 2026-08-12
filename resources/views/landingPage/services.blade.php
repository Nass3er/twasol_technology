@extends('layouts.app')
@section('title', app()->getLocale() == 'ar' ? 'خدماتنا - تواصل تكنولوجي' : 'Our Services - Twasol Technology')
@section('meta_description', app()->getLocale() == 'ar' ? 'استعرض خدمات الربط الشبكي، الحلول السحابية، واستعادة قواعد البيانات المتضررة والمشفرة المقدمة من شركة تواصل تكنولوجي.' : 'Explore branch networking, cloud solutions, and encrypted database recovery services by Twasol Technology.')
@section('meta_keywords', 'ربط فروع, VMware, Citrix, TSplus, حلول سحابية, استعادة قواعد البيانات, تواصل تكنولوجي, خدمات شبكية')

@section('content')

{{-- Page Hero --}}
<section style="background: var(--color-primary); padding: 100px 0 60px; text-align: center;">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold text-white mb-4" data-aos="fade-up">
            {{ app()->getLocale() == 'ar' ? 'خدماتنا' : 'Our Services' }}
        </h1>
        <p class="text-white/80 text-lg max-w-xl mx-auto" data-aos="fade-up" data-aos-delay="100">
            {{ app()->getLocale() == 'ar' ? 'حلول شبكية متكاملة للربط بين الفروع بأفضل التقنيات' : 'Comprehensive networking solutions using the best technologies' }}
        </p>
    </div>
</section>

{{-- Services Grid --}}
<section style="padding: 80px 0; background: #f8fafc;">
    <div class="container mx-auto px-4">
        @if($services->isEmpty())
            <div class="text-center py-16 text-gray-400">
                <i class="fas fa-network-wired fa-3x mb-4 d-block"></i>
                <p>{{ app()->getLocale() == 'ar' ? 'لا توجد خدمات متاحة حالياً.' : 'No services available at the moment.' }}</p>
            </div>
        @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($services as $service)
            <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-2" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                {{-- Service Images (Carousel-like) --}}
                @if($service->images->isNotEmpty())
                    <div style="height: 220px; overflow: hidden; position: relative;">
                        <img src="{{ asset($service->images->first()->image_path) }}" alt="{{ $service->name_ar }}" class="w-full object-cover h-full transition-transform duration-500 hover:scale-105">
                        @if($service->images->count() > 1)
                            <span class="absolute top-2 end-2 badge" style="background: var(--color-primary); color: white; padding: 4px 8px; border-radius: 999px;">
                                <i class="fas fa-images mr-1"></i>{{ $service->images->count() }}
                            </span>
                        @endif
                    </div>
                @else
                    <div style="height: 220px; background: linear-gradient(135deg, var(--color-primary), #2c3e50); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-network-wired fa-4x" style="color: rgba(255,255,255,0.4);"></i>
                    </div>
                @endif

                <div class="p-6 flex flex-col justify-between h-full">
                    <div>
                        <h3 class="text-xl font-bold mb-3" style="color: var(--color-primary);">
                            {{ app()->getLocale() == 'ar' ? $service->name_ar : $service->name_en }}
                        </h3>

                        @php
                            $fullText  = app()->getLocale() == 'ar' ? $service->description_ar : $service->description_en;
                            $shortText = Str::limit($fullText, 120);
                            $needsMore = mb_strlen($fullText) > 120;
                            $moreLabel = app()->getLocale() == 'ar' ? ' عرض أكثر' : ' Show more';
                            $lessLabel = app()->getLocale() == 'ar' ? ' عرض أقل' : ' Show less';
                        @endphp

                        <p class="text-gray-600 leading-relaxed text-sm mb-3 service-desc-para">
                            @if($needsMore)
                                <span class="short-part">{{ $shortText }}<button type="button" class="toggle-inline-btn" data-more="{{ $moreLabel }}" data-less="{{ $lessLabel }}" style="color: var(--color-primary); background:none; border:none; cursor:pointer; font-size:inherit; font-weight:600; padding:0 2px;">{{ $moreLabel }}</button></span>
                                <span class="full-part" style="display:none;">{{ $fullText }}<button type="button" class="toggle-inline-btn" data-more="{{ $moreLabel }}" data-less="{{ $lessLabel }}" style="color: #9ca3af; background:none; border:none; cursor:pointer; font-size:inherit; font-weight:600; padding:0 2px;">{{ $lessLabel }}</button></span>
                            @else
                                {{ $fullText }}
                            @endif
                        </p>

                    </div>

                    <div>
                        @if($service->price)
                            <div class="mb-3 font-bold text-lg" style="color: var(--color-primary);">
                                {{ number_format($service->price, 0) }} $
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>

{{-- CTA --}}
<section style="padding: 60px 0; background: var(--color-primary);">
    <div class="container mx-auto px-4 text-center">
        <h3 class="text-2xl font-bold text-white mb-4">
            {{ app()->getLocale() == 'ar' ? 'تحتاج خدمة معينة؟ تواصل معنا الآن' : 'Need a Specific Service? Contact Us Now' }}
        </h3>
        <a href="{{ localizedRoute('customer-service') }}" class="btn btn-lg px-8 py-3 rounded-full font-bold" style="background: white; color: var(--color-primary);">
            {{ app()->getLocale() == 'ar' ? 'طلب خدمة' : 'Request Service' }}
        </a>
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.toggle-inline-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var para      = btn.closest('.service-desc-para');
            var shortPart = para.querySelector('.short-part');
            var fullPart  = para.querySelector('.full-part');

            if (shortPart.style.display === 'none') {
                // Collapse
                fullPart.style.display  = 'none';
                shortPart.style.display = '';
            } else {
                // Expand
                shortPart.style.display = 'none';
                fullPart.style.display  = '';
            }
        });
    });
});
</script>
@endpush

@endsection