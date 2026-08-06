@extends('layouts.app')
@section('title', app()->getLocale() == 'ar' ? 'من نحن - تواصل تكنولوجي' : 'About Us - Twasol Technology')
@section('meta_description', app()->getLocale() == 'ar' ? 'تعرف على شركة تواصل تكنولوجي، المفهوم والخبرة في تقديم أفضل حلول الربط الشبكي بين الفروع والأنظمة.' : 'Learn more about Twasol Technology, experts in providing advanced network connectivity solutions.')
@section('meta_keywords', 'تواصل تكنولوجي, من نحن, عن الشركة, حلول شبكية, ربط فروع, تقنية معلومات, اليمن')

@section('content')

{{-- Page Hero --}}
<section style="background: var(--color-primary); padding: 100px 0 60px; text-align: center;">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold text-white mb-4" data-aos="fade-up">
            {{ app()->getLocale() == 'ar' ? 'من نحن' : 'About Us' }}
        </h1>
        <nav class="text-white/70 text-sm" data-aos="fade-up" data-aos-delay="100">
            <a href="{{ localizedRoute('welcome') }}" class="hover:text-white">{{ app()->getLocale() == 'ar' ? 'الرئيسية' : 'Home' }}</a>
            <span class="mx-2">/</span>
            <span>{{ app()->getLocale() == 'ar' ? 'من نحن' : 'About Us' }}</span>
        </nav>
    </div>
</section>

{{-- About Content --}}
<section style="padding: 80px 0; background: #fff;">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row items-center gap-12 max-w-5xl mx-auto">
            <div class="flex-1 text-center" data-aos="fade-right">
                @if(isset($logoPath) && $logoPath)
                    <img src="{{ asset($logoPath) }}" alt="{{ $settings['company_name_ar'] ?? '' }}" style="max-height: 200px; max-width: 320px; object-fit: contain;" class="mx-auto drop-shadow-xl">
                @endif
            </div>
            <div class="flex-1" data-aos="fade-left">
                <h2 class="text-2xl font-bold mb-4" style="color: var(--color-primary);">
                    {{ app()->getLocale() == 'ar' ? ($settings['company_name_ar'] ?? 'تواصل تكنولوجي') : ($settings['company_name_en'] ?? 'Twasol Technology') }}
                </h2>
                <p class="text-gray-700 text-lg leading-relaxed mb-4">
                    {{ app()->getLocale() == 'ar' ? ($settings['about_ar'] ?? '') : ($settings['about_en'] ?? '') }}
                </p>
            </div>
        </div>
    </div>
</section>

{{-- Stats --}}
@if($statistics->isNotEmpty())
<section style="padding: 60px 0; background: #f8fafc;">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
            @foreach($statistics as $stat)
            <div class="text-center bg-white rounded-2xl shadow-md p-6" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                @if($stat->icon)
                    <i class="{{ $stat->icon }} fa-2x mb-3" style="color: var(--color-primary);"></i>
                @endif
                <div class="text-4xl font-bold mb-1" style="color: var(--color-primary);">{{ $stat->number }}</div>
                <div class="font-semibold text-gray-700">{{ app()->getLocale() == 'ar' ? $stat->name_ar : $stat->name_en }}</div>
                @if($stat->description_ar || $stat->description_en)
                    <div class="text-sm text-gray-500 mt-1">{{ app()->getLocale() == 'ar' ? $stat->description_ar : $stat->description_en }}</div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection