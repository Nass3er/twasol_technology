@extends('layouts.app')
@section('title', app()->getLocale() == 'ar' ? 'عملاؤنا - تواصل تكنولوجي' : 'Our Customers - Twasol Technology')
@section('meta_description', app()->getLocale() == 'ar' ? 'قائمة بشركاء النجاح والشركات والمؤسسات التي تم ربط فروعها بنجاح عبر خدمات شركة تواصل تكنولوجي.' : 'List of success partners, companies, and organizations connected via Twasol Technology services.')
@section('meta_keywords', 'عملاء تواصل تكنولوجي, شركاء النجاح, شركات يمنية, ربط فروع الشركات, خدمات شبكات')

@section('content')

<section style="background: var(--color-primary); padding: 100px 0 60px; text-align: center;">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold text-white mb-4" data-aos="fade-up">{{ app()->getLocale() == 'ar' ? 'عملاؤنا' : 'Our Customers' }}</h1>
        <p class="text-white/80 text-lg max-w-xl mx-auto" data-aos="fade-up" data-aos-delay="100">
            {{ app()->getLocale() == 'ar' ? 'نفخر بثقة عملائنا الكرام في خدماتنا الشبكية' : 'We are proud of our valued customers trust in our networking services' }}
        </p>
    </div>
</section>

<section style="padding: 80px 0; background: #fff;">
    <div class="container mx-auto px-4">
        @if($customers->isEmpty())
            <div class="text-center py-16 text-gray-400">
                <i class="fas fa-users fa-3x mb-4 d-block"></i>
                <p>{{ app()->getLocale() == 'ar' ? 'لا توجد بيانات عملاء.' : 'No customers data available.' }}</p>
            </div>
        @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($customers as $customer)
            <div class="bg-white border rounded-2xl shadow-sm p-6 text-center hover:shadow-xl transition-all duration-300" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                <div class="flex items-center justify-center mb-4" style="height: 80px;">
                    @if($customer->logo)
                        <img src="{{ asset($customer->logo) }}" alt="{{ $customer->name_ar }}" class="mx-auto" style="max-height: 80px; max-width: 150px; object-fit: contain;">
                    @else
                        <div style="width: 70px; height: 70px; background: var(--color-primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.8rem; font-weight: bold; margin: 0 auto;">
                            {{ mb_substr($customer->name_ar, 0, 1) }}
                        </div>
                    @endif
                </div>
                <h3 class="text-xl font-bold mb-1" style="color: var(--color-primary);">
                    {{ app()->getLocale() == 'ar' ? $customer->name_ar : $customer->name_en }}
                </h3>
                @if($customer->details_ar || $customer->details_en)
                    <p class="text-gray-500 text-sm mb-3">
                        {{ Str::limit(app()->getLocale() == 'ar' ? $customer->details_ar : $customer->details_en, 100) }}
                    </p>
                @endif
                @if($customer->services->isNotEmpty())
                    <div class="flex flex-wrap gap-1 justify-center mt-3">
                        @foreach($customer->services->take(3) as $srv)
                            <span class="badge text-xs px-2 py-1 rounded-full text-white" style="background: var(--color-primary); opacity: 0.85;">
                                {{ app()->getLocale() == 'ar' ? $srv->name_ar : $srv->name_en }}
                            </span>
                        @endforeach
                    </div>
                @endif
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>

@endsection