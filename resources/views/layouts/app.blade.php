<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @php
        $pageTitle = $__env->yieldContent('title', app()->getLocale() == 'ar' ? ($settings['company_name_ar'] ?? 'تواصل تكنولوجي - حلول الربط الشبكي') : ($settings['company_name_en'] ?? 'Twasol Technology - Networking Solutions'));
        $pageDescription = $__env->yieldContent('meta_description', app()->getLocale() == 'ar' 
            ? ($settings['about_ar'] ?? 'تواصل تكنولوجي - نقدم أحدث حلول الربط الشبكي بين الفروع والأنظمة والتحكم السحابي بأعلى درجات الأمان والاستقرار.') 
            : ($settings['about_en'] ?? 'Twasol Technology - Providing advanced networking solutions to connect branches remotely with highest security and stability.'));
        $pageKeywords = $__env->yieldContent('meta_keywords', 'ربط شبكي, VMware, Citrix, TSplus, Radmin VPN, عقود صيانة, IT solutions, تواصل تواصل تكنولوجي, شبكات, اليمن');
        $pageOgImage = $__env->yieldContent('og_image', isset($logoPath) && $logoPath ? asset($logoPath) : asset('images/twasol_logo.png'));
        $currentUrl = url()->current();
        $currentLocale = app()->getLocale();
        
        $segments = request()->segments();
        $pathAfterLocale = count($segments) > 1 ? implode('/', array_slice($segments, 1)) : '';
        $arUrl = url('ar' . ($pathAfterLocale ? '/' . $pathAfterLocale : ''));
        $enUrl = url('en' . ($pathAfterLocale ? '/' . $pathAfterLocale : ''));
    @endphp

    <!-- Primary Meta Tags -->
    <title>{{ $pageTitle }}</title>
    <meta name="title" content="{{ $pageTitle }}">
    <meta name="description" content="{{ $pageDescription }}">
    <meta name="keywords" content="{{ $pageKeywords }}">
    <meta name="author" content="Twasol Technology">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <link rel="canonical" href="{{ $currentUrl }}">

    <!-- Multi-language Hreflang Tags for Search Engines -->
    <link rel="alternate" hreflang="ar" href="{{ $arUrl }}">
    <link rel="alternate" hreflang="en" href="{{ $enUrl }}">
    <link rel="alternate" hreflang="x-default" href="{{ $arUrl }}">

    <!-- Open Graph / Social Media Meta Tags -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $currentUrl }}">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $pageDescription }}">
    <meta property="og:image" content="{{ $pageOgImage }}">
    <meta property="og:site_name" content="{{ app()->getLocale() == 'ar' ? 'تواصل تكنولوجي' : 'Twasol Technology' }}">
    <meta property="og:locale" content="{{ $currentLocale == 'ar' ? 'ar_AR' : 'en_US' }}">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ $currentUrl }}">
    <meta name="twitter:title" content="{{ $pageTitle }}">
    <meta name="twitter:description" content="{{ $pageDescription }}">
    <meta name="twitter:image" content="{{ $pageOgImage }}">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ isset($logoPath) && $logoPath ? asset($logoPath) : asset('images/twasol_logo.png') }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;800&family=Outfit:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous">
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <!-- Vite Assets -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <!-- Dynamic Theme Colors -->
    <style>
        :root {
            --color-primary: {{ $settings['primary_color'] ?? '#000000' }};
            --color-secondary: {{ $settings['secondary_color'] ?? '#ffffff' }};
        }
        body { font-family: 'Cairo', 'Outfit', sans-serif; }
    </style>

    <!-- Schema.org JSON-LD Structured Data for Google Indexing -->
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "Organization",
      "name": "{{ $settings['company_name_ar'] ?? 'تواصل تكنولوجي' }}",
      "alternateName": "{{ $settings['company_name_en'] ?? 'Twasol Technology' }}",
      "url": "{{ url('/') }}",
      "logo": "{{ isset($logoPath) && $logoPath ? asset($logoPath) : asset('images/twasol_logo.png') }}",
      "contactPoint": {
        "@@type": "ContactPoint",
        "telephone": "{{ $settings['phone'] ?? '+967776891846' }}",
        "contactType": "customer service",
        "email": "{{ $settings['email'] ?? 'n716527766@gmail.com' }}"
      },
      "sameAs": [
        "{{ $settings['facebook'] ?? 'https://facebook.com/twasol' }}",
        "{{ $settings['instagram'] ?? 'https://instagram.com/twasol' }}",
        "{{ $settings['youtube'] ?? 'https://youtube.com/twasol' }}"
      ]
    }
    </script>

    @yield('css')
</head>

<body>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>AOS.init({ once: true });</script>

    @include('daisyUI.navbar-upper-2')

    <main>
        @yield('content')
    </main>

    @include('daisyUI.footer')

    @yield('js')
</body>
</html>