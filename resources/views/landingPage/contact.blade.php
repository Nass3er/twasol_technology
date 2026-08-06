@extends('layouts.app')
@section('title', app()->getLocale() == 'ar' ? 'تواصل معنا - تواصل تكنولوجي' : 'Contact Us - Twasol Technology')
@section('meta_description', app()->getLocale() == 'ar' ? 'تواصل مع فريق تواصل تكنولوجي عبر الهاتف والواتساب والبريد الإلكتروني للاستفسارات وطلبات الخدمة والدعم الفني.' : 'Contact Twasol Technology team via phone, WhatsApp, and email for inquiries and support.')
@section('meta_keywords', 'تواصل معنا, اتصل بنا, رقم تواصل تكنولوجي, واتساب تواصل تكنولوجي, بريد تواصل تكنولوجي')

@section('content')

<section style="background: var(--color-primary); padding: 100px 0 60px; text-align: center;">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold text-white mb-4" data-aos="fade-up">
            {{ app()->getLocale() == 'ar' ? 'تواصل معنا' : 'Contact Us' }}
        </h1>
    </div>
</section>

<section style="padding: 80px 0; background: #fff;">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 max-w-5xl mx-auto">

            <!-- Contact Info -->
            <div data-aos="fade-right">
                <h2 class="text-2xl font-bold mb-8" style="color: var(--color-primary);">
                    {{ app()->getLocale() == 'ar' ? 'معلومات التواصل' : 'Contact Information' }}
                </h2>
                <div class="space-y-6">
                    @if(!empty($settings['phone']))
                        <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl hover:shadow-md transition-shadow">
                            <div class="w-12 h-12 flex items-center justify-center rounded-full text-white flex-shrink-0" style="background: var(--color-primary);">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div>
                                <div class="text-sm text-gray-500">{{ app()->getLocale() == 'ar' ? 'رقم الهاتف' : 'Phone' }}</div>
                                <a href="tel:{{ $settings['phone'] }}" class="font-semibold text-gray-800 hover:underline">{{ $settings['phone'] }}</a>
                            </div>
                        </div>
                    @endif

                    @if(!empty($settings['email']))
                        <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl hover:shadow-md transition-shadow">
                            <div class="w-12 h-12 flex items-center justify-center rounded-full text-white flex-shrink-0" style="background: var(--color-primary);">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <div class="text-sm text-gray-500">{{ app()->getLocale() == 'ar' ? 'البريد الإلكتروني' : 'Email' }}</div>
                                <a href="mailto:{{ $settings['email'] }}" class="font-semibold text-gray-800 hover:underline">{{ $settings['email'] }}</a>
                            </div>
                        </div>
                    @endif

                    @if(!empty($settings['whatsapp']))
                        <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl hover:shadow-md transition-shadow">
                            <div class="w-12 h-12 flex items-center justify-center rounded-full text-white flex-shrink-0" style="background: #25d366;">
                                <i class="fab fa-whatsapp"></i>
                            </div>
                            <div>
                                <div class="text-sm text-gray-500">WhatsApp</div>
                                <a href="{{ $settings['whatsapp'] }}" target="_blank" class="font-semibold text-gray-800 hover:underline">
                                    {{ app()->getLocale() == 'ar' ? 'تواصل عبر واتساب' : 'Chat on WhatsApp' }}
                                </a>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Social Media Links -->
                <div class="mt-8">
                    <h4 class="font-semibold text-gray-600 mb-4">{{ app()->getLocale() == 'ar' ? 'تابعونا على' : 'Follow Us On' }}</h4>
                    <div class="flex gap-3 flex-wrap">
                        @if(!empty($settings['facebook']))
                            <a href="{{ $settings['facebook'] }}" target="_blank" class="w-10 h-10 rounded-full flex items-center justify-center text-white text-lg hover:scale-110 transition-transform" style="background: #1877f2;"><i class="fab fa-facebook-f"></i></a>
                        @endif
                        @if(!empty($settings['instagram']))
                            <a href="{{ $settings['instagram'] }}" target="_blank" class="w-10 h-10 rounded-full flex items-center justify-center text-white text-lg hover:scale-110 transition-transform" style="background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%);"><i class="fab fa-instagram"></i></a>
                        @endif
                        @if(!empty($settings['youtube']))
                            <a href="{{ $settings['youtube'] }}" target="_blank" class="w-10 h-10 rounded-full flex items-center justify-center text-white text-lg hover:scale-110 transition-transform" style="background: #ff0000;"><i class="fab fa-youtube"></i></a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Service Request Link -->
            <div data-aos="fade-left">
                <div class="bg-gray-50 rounded-2xl p-8 text-center shadow-sm border">
                    <i class="fas fa-headset fa-4x mb-6" style="color: var(--color-primary);"></i>
                    <h3 class="text-xl font-bold mb-3" style="color: var(--color-primary);">
                        {{ app()->getLocale() == 'ar' ? 'هل تحتاج إلى خدمة؟' : 'Need a Service?' }}
                    </h3>
                    <p class="text-gray-600 mb-6">
                        {{ app()->getLocale() == 'ar' ? 'قم بتعبئة نموذج طلب الخدمة وسيتواصل معك فريقنا المتخصص.' : 'Fill out the service request form and our specialized team will contact you.' }}
                    </p>
                    <a href="{{ localizedRoute('customer-service') }}" class="btn btn-lg px-8 py-3 rounded-full font-bold text-white" style="background: var(--color-primary);">
                        <i class="fas fa-paper-plane mr-2"></i>
                        {{ app()->getLocale() == 'ar' ? 'طلب خدمة' : 'Request Service' }}
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection