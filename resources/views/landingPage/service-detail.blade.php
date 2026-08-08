@extends('layouts.app')

@php
    $serviceName = app()->getLocale() == 'ar' ? $service->name_ar : $service->name_en;
    $serviceDesc = app()->getLocale() == 'ar' ? $service->description_ar : $service->description_en;
@endphp

@section('title', $serviceName . ' - ' . (app()->getLocale() == 'ar' ? 'تواصل تكنولوجي' : 'Twasol Technology'))
@section('meta_description', Str::limit(strip_tags($serviceDesc), 160))

@section('content')

{{-- Sub-header Breadcrumb Bar (Simple & Clean) --}}
<div style="background: #f1f5f9; border-bottom: 1px solid #e2e8f0; padding: 14px 0;">
    <div class="container mx-auto px-4">
        <div style="font-size: 14px; color: #64748b; display: flex; items-center; gap: 8px; flex-wrap: wrap;">
            <a href="{{ localizedRoute('welcome') }}" style="color: #64748b; text-decoration: none;" onmouseover="this.style.color='var(--color-primary)'" onmouseout="this.style.color='#64748b'">
                {{ app()->getLocale() == 'ar' ? 'الرئيسية' : 'Home' }}
            </a>
            <span style="color: #cbd5e1;">/</span>
            <a href="{{ localizedRoute('services.landing') }}" style="color: #64748b; text-decoration: none;" onmouseover="this.style.color='var(--color-primary)'" onmouseout="this.style.color='#64748b'">
                {{ app()->getLocale() == 'ar' ? 'خدماتنا' : 'Services' }}
            </a>
            <span style="color: #cbd5e1;">/</span>
            <span style="color: #0f172a; font-weight: 700;">{{ $serviceName }}</span>
        </div>
    </div>
</div>

{{-- Service Detail Main Section --}}
<section style="padding: 40px 0 80px; background: #f8fafc; min-height: 70vh;">
    <div class="container mx-auto px-4" style="max-width: 1200px;">
        
        {{-- Unified Premium Service Card --}}
        <div style="background: #ffffff; border-radius: 24px; box-shadow: 0 15px 40px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; overflow: hidden; padding: 32px;">
            
            <style>
                .service-detail-wrapper {
                    display: flex;
                    flex-direction: column-reverse;
                    gap: 32px;
                }
                @media (min-width: 992px) {
                    .service-detail-wrapper {
                        display: grid;
                        grid-template-columns: 1fr 440px;
                        gap: 40px;
                        align-items: start;
                    }
                }
                .main-img-box {
                    width: 100%;
                    height: 320px;
                    border-radius: 20px;
                    overflow: hidden;
                    border: 1px solid #e2e8f0;
                    box-shadow: 0 10px 25px rgba(0,0,0,0.06);
                    background: #f1f5f9;
                    position: relative;
                }
                @media (min-width: 992px) {
                    .main-img-box {
                        height: 380px;
                    }
                }
                .main-img-box img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    display: block;
                }
                .thumb-btn {
                    width: 72px;
                    height: 56px;
                    border-radius: 12px;
                    overflow: hidden;
                    border: 2px solid #e2e8f0;
                    cursor: pointer;
                    transition: all 0.2s ease;
                    padding: 0;
                    background: #f8fafc;
                }
                .thumb-btn:hover, .thumb-btn:focus {
                    border-color: var(--color-primary);
                    transform: translateY(-2px);
                }
                .thumb-btn img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                }
                .action-btn-primary {
                    background: var(--color-primary);
                    color: #ffffff !important;
                    border-radius: 50px;
                    font-weight: 700;
                    padding: 14px 28px;
                    font-size: 15px;
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    gap: 10px;
                    text-decoration: none;
                    box-shadow: 0 10px 20px rgba(71, 102, 225, 0.25);
                    transition: all 0.3s ease;
                }
                .action-btn-primary:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 14px 25px rgba(71, 102, 225, 0.35);
                }
                .action-btn-whatsapp {
                    background: #25D366;
                    color: #ffffff !important;
                    border-radius: 50px;
                    font-weight: 700;
                    padding: 14px 28px;
                    font-size: 15px;
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    gap: 10px;
                    text-decoration: none;
                    box-shadow: 0 10px 20px rgba(37, 211, 102, 0.25);
                    transition: all 0.3s ease;
                }
                .action-btn-whatsapp:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 14px 25px rgba(37, 211, 102, 0.35);
                }
            </style>

            <div class="service-detail-wrapper">
                
                {{-- RIGHT COLUMN: Title, Badge, Description, and Buttons --}}
                <div style="display: flex; flex-direction: column; justify-content: space-between;">
                    <div>
                        <!-- Category Badge -->
                        <div style="display: inline-flex; align-items: center; gap: 6px; background: rgba(71, 102, 225, 0.08); color: var(--color-primary); font-size: 13px; font-weight: 700; padding: 6px 16px; border-radius: 50px; margin-bottom: 16px;">
                            <i class="fas fa-layer-group"></i>
                            <span>{{ app()->getLocale() == 'ar' ? 'خدمة متميزة' : 'Featured Service' }}</span>
                        </div>

                        <!-- Service Title -->
                        <h1 style="font-size: 28px; font-weight: 800; color: #0f172a; margin: 0 0 16px 0; line-height: 1.35;">
                            {{ $serviceName }}
                        </h1>

                        <!-- Price (If available) -->
                        @if($service->price)
                            <div style="display: inline-block; background: #ecfdf5; color: #059669; font-size: 16px; font-weight: 800; padding: 6px 18px; border-radius: 50px; border: 1px solid #a7f3d0; margin-bottom: 20px;">
                                {{ number_format($service->price, 0) }} $
                            </div>
                        @endif

                        <!-- Description Box -->
                        <div style="background: #f8fafc; border-radius: 16px; padding: 24px; border: 1px solid #f1f5f9; margin-bottom: 28px;">
                            <h3 style="font-size: 16px; font-weight: 700; color: #0f172a; margin: 0 0 12px 0;">
                                {{ app()->getLocale() == 'ar' ? 'تفاصيل ومعلومات الخدمة:' : 'Service Overview & Details:' }}
                            </h3>
                            <div style="font-size: 15px; color: #334155; line-height: 1.85; font-weight: 400; white-space: pre-line;">
                                {!! nl2br(e($serviceDesc)) !!}
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons Bar -->
                    <div style="display: flex; flex-wrap: wrap; gap: 14px; padding-top: 12px; border-top: 1px solid #f1f5f9;">
                        <a href="{{ localizedRoute('customer-service', ['service_id' => $service->id]) }}" class="action-btn-primary">
                            <i class="fas fa-paper-plane"></i>
                            <span>{{ app()->getLocale() == 'ar' ? 'طلب هذه الخدمة الآن' : 'Request Service Now' }}</span>
                        </a>

                        @if(!empty($settings['whatsapp']))
                            <a href="{{ $settings['whatsapp'] }}" target="_blank" class="action-btn-whatsapp">
                                <i class="fab fa-whatsapp" style="font-size: 18px;"></i>
                                <span>{{ app()->getLocale() == 'ar' ? 'استفسار عبر واتساب' : 'WhatsApp Inquiry' }}</span>
                            </a>
                        @endif
                    </div>
                </div>

                {{-- LEFT COLUMN: Service Image Gallery & Related List --}}
                <div style="display: flex; flex-direction: column; gap: 20px;">
                    
                    <!-- Image Gallery Box -->
                    @if($service->images->isNotEmpty())
                        <div>
                            <div class="main-img-box">
                                <img id="main-service-img" src="{{ asset($service->images->first()->image_path) }}" alt="{{ $serviceName }}">
                            </div>

                            @if($service->images->count() > 1)
                                <div style="display: flex; gap: 8px; margin-top: 12px; overflow-x: auto; padding-bottom: 4px;">
                                    @foreach($service->images as $img)
                                        <button type="button" class="thumb-btn" onclick="document.getElementById('main-service-img').src = '{{ asset($img->image_path) }}'">
                                            <img src="{{ asset($img->image_path) }}" alt="Thumbnail {{ $loop->iteration }}">
                                        </button>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="main-img-box" style="display: flex; flex-direction: column; align-items: center; justify-content: center; background: linear-gradient(135deg, var(--color-primary), #1e293b);">
                            <i class="fas fa-network-wired" style="font-size: 50px; color: rgba(255,255,255,0.4); margin-bottom: 10px;"></i>
                            <span style="color: rgba(255,255,255,0.7); font-size: 13px; font-weight: 600;">{{ $serviceName }}</span>
                        </div>
                    @endif

                    <!-- Related Services Quick Links -->
                    @if($otherServices->isNotEmpty())
                        <div style="background: #f8fafc; border-radius: 16px; padding: 20px; border: 1px solid #f1f5f9;">
                            <h4 style="font-size: 14px; font-weight: 700; color: var(--color-primary); margin: 0 0 12px 0; border-bottom: 1px solid #e2e8f0; padding-bottom: 8px;">
                                {{ app()->getLocale() == 'ar' ? 'خدمات أخرى ذات صلة:' : 'Other Related Services:' }}
                            </h4>
                            <div style="display: flex; flex-direction: column; gap: 10px;">
                                @foreach($otherServices as $other)
                                    <a href="{{ localizedRoute('services.detail', ['id' => $other->id]) }}" style="display: flex; align-items: center; gap: 12px; text-decoration: none; padding: 8px; border-radius: 12px; background: #ffffff; border: 1px solid #e2e8f0; transition: all 0.2s ease;" onmouseover="this.style.borderColor='var(--color-primary)'" onmouseout="this.style.borderColor='#e2e8f0'">
                                        @if($other->images->isNotEmpty())
                                            <img src="{{ asset($other->images->first()->image_path) }}" alt="{{ $other->name_ar }}" style="width: 44px; height: 44px; border-radius: 8px; object-fit: cover; shrink: 0;">
                                        @else
                                            <div style="width: 44px; height: 44px; border-radius: 8px; background: #f1f5f9; display: flex; align-items: center; justify-content: center; color: #64748b; font-size: 14px; shrink: 0;">
                                                <i class="fas fa-network-wired"></i>
                                            </div>
                                        @endif
                                        <div style="flex: 1; overflow: hidden;">
                                            <div style="font-size: 13px; font-weight: 700; color: #0f172a; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                {{ app()->getLocale() == 'ar' ? $other->name_ar : $other->name_en }}
                                            </div>
                                            <div style="font-size: 11px; color: var(--color-primary); font-weight: 600; margin-top: 2px;">
                                                {{ app()->getLocale() == 'ar' ? 'عرض التفاصيل ←' : 'View Details →' }}
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>

            </div>

        </div>

    </div>
</section>

@endsection
