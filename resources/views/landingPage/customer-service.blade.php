@extends('layouts.app')
@section('title', app()->getLocale() == 'ar' ? 'خدمة العملاء - تواصل تكنولوجي' : 'Customer Service - Twasol Technology')
@section('meta_description', app()->getLocale() == 'ar' ? 'اطلب خدمتك الشبكية الآن من تواصل تكنولوجي وقم بتعبئة نموذج الطلب لتتواصل مع مهندسي المختصين بسرعة.' : 'Request your networking service now from Twasol Technology.')
@section('meta_keywords', 'طلب خدمة, خدمة العملاء, تواصل تكنولوجي, تقديم طلب, دعم فني شبكي')

@section('content')

<section style="background: var(--color-primary); padding: 100px 0 60px; text-align: center;">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold text-white mb-4" data-aos="fade-up">
            {{ app()->getLocale() == 'ar' ? 'خدمة العملاء' : 'Customer Service' }}
        </h1>
        <p class="text-white/80 text-lg max-w-xl mx-auto" data-aos="fade-up" data-aos-delay="100">
            {{ app()->getLocale() == 'ar' ? 'قم بتعبئة النموذج أدناه وسيتواصل معك فريقنا في أقرب وقت' : 'Fill out the form below and our team will contact you as soon as possible' }}
        </p>
    </div>
</section>

<section style="padding: 80px 0; background: #f8fafc;">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-xl p-8 md:p-12" data-aos="fade-up">

            @if(session('success'))
                <div class="alert alert-success mb-6 rounded-xl p-4" style="background: #d1fae5; border-left: 4px solid #10b981; color: #065f46;">
                    <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert mb-6 rounded-xl p-4" style="background: #fee2e2; border-left: 4px solid #ef4444; color: #991b1b;">
                    <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
                </div>
            @endif

            <h2 class="text-2xl font-bold mb-6" style="color: var(--color-primary);">
                {{ app()->getLocale() == 'ar' ? 'نموذج طلب الخدمة' : 'Service Request Form' }}
            </h2>

            <form action="{{ localizedRoute('customer-service.submit') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        {{ app()->getLocale() == 'ar' ? 'الاسم الكامل *' : 'Full Name *' }}
                    </label>
                    <input type="text" name="full_name" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:border-transparent @error('full_name') border-red-500 @enderror"
                        style="--tw-ring-color: var(--color-primary);" value="{{ old('full_name') }}" required>
                    @error('full_name')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">
                            {{ app()->getLocale() == 'ar' ? 'رقم الهاتف *' : 'Phone Number *' }}
                        </label>
                        <input type="text" name="phone" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none @error('phone') border-red-500 @enderror"
                            value="{{ old('phone') }}" required>
                        @error('phone')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">
                            {{ app()->getLocale() == 'ar' ? 'البريد الإلكتروني' : 'Email' }}
                        </label>
                        <input type="email" name="email" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none @error('email') border-red-500 @enderror"
                            value="{{ old('email') }}">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        {{ app()->getLocale() == 'ar' ? 'الخدمة المطلوبة' : 'Requested Service' }}
                    </label>
                    <select name="service_id" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none">
                        <option value="">{{ app()->getLocale() == 'ar' ? 'اختر الخدمة (اختياري)' : 'Select Service (Optional)' }}</option>
                        @foreach($services as $srv)
                            <option value="{{ $srv->id }}" {{ old('service_id') == $srv->id ? 'selected' : '' }}>
                                {{ app()->getLocale() == 'ar' ? $srv->name_ar : $srv->name_en }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        {{ app()->getLocale() == 'ar' ? 'تفاصيل الطلب *' : 'Request Details *' }}
                    </label>
                    <textarea name="message" rows="5" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none @error('message') border-red-500 @enderror"
                        placeholder="{{ app()->getLocale() == 'ar' ? 'اكتب تفاصيل طلبك هنا...' : 'Write your request details here...' }}"
                        required>{{ old('message') }}</textarea>
                    @error('message')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <button type="submit" class="w-full py-4 text-white font-bold text-lg rounded-xl transition-all duration-300 hover:opacity-90 hover:-translate-y-0.5" style="background: var(--color-primary);">
                    <i class="fas fa-paper-plane mr-2"></i>
                    {{ app()->getLocale() == 'ar' ? 'إرسال الطلب' : 'Submit Request' }}
                </button>
            </form>
        </div>
    </div>
</section>

@endsection