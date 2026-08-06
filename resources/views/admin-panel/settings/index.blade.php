@extends('adminlte::page')
@section('title', app()->getLocale() == 'ar' ? 'إعدادات الشركة' : 'Company Settings')

@section('content_header')
    <h1>{{ app()->getLocale() == 'ar' ? 'إعدادات الشركة' : 'Company Settings' }}</h1>
@stop

@section('content')
    <div class="container-fluid pb-5">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <form action="{{ route('admin.settings.update', ['locale' => app()->getLocale()]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <!-- Left Column: Core Info & Colors -->
                <div class="col-md-6">
                    <!-- General Settings -->
                    <x-adminlte-card title="{{ app()->getLocale() == 'ar' ? 'بيانات الشركة العامة' : 'General Info' }}" theme="navy" icon="fas fa-building">
                        <div class="row">
                            <div class="col-md-12">
                                <label>{{ app()->getLocale() == 'ar' ? 'اسم الشركة (عربي)' : 'Company Name (Arabic)' }}</label>
                                <x-adminlte-input name="company_name_ar" value="{{ $settings['company_name_ar'] ?? '' }}" placeholder="تواصل تكنولوجي" disable-feedback />
                            </div>
                            <div class="col-md-12">
                                <label>{{ app()->getLocale() == 'ar' ? 'اسم الشركة (إنجليزي)' : 'Company Name (English)' }}</label>
                                <x-adminlte-input name="company_name_en" value="{{ $settings['company_name_en'] ?? '' }}" placeholder="Twasol Technology" disable-feedback />
                            </div>
                            <div class="col-md-12">
                                <label>{{ app()->getLocale() == 'ar' ? 'شعار الشركة الحالي' : 'Current Company Logo' }}</label>
                                @if($logo && $logo->imagepath)
                                    <div class="mb-2">
                                        <img src="{{ asset($logo->imagepath) }}" alt="Logo" class="img-thumbnail" style="max-height: 80px;">
                                    </div>
                                @endif
                                <x-adminlte-input-file name="logo" placeholder="{{ app()->getLocale() == 'ar' ? 'اختر شعار جديد' : 'Choose new logo' }}" disable-feedback />
                            </div>
                        </div>
                    </x-adminlte-card>

                    <!-- Theme Settings -->
                    <x-adminlte-card title="{{ app()->getLocale() == 'ar' ? 'الهوية البصرية والألوان' : 'Theme Colors' }}" theme="dark" icon="fas fa-palette">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ app()->getLocale() == 'ar' ? 'اللون الأساسي' : 'Primary Color' }}</label>
                                    <div class="input-group">
                                        <input type="color" name="primary_color" class="form-control form-control-color" value="{{ $settings['primary_color'] ?? '#000000' }}" style="height: 38px; width: 100%;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ app()->getLocale() == 'ar' ? 'اللون الفرعي' : 'Secondary Color' }}</label>
                                    <div class="input-group">
                                        <input type="color" name="secondary_color" class="form-control form-control-color" value="{{ $settings['secondary_color'] ?? '#ffffff' }}" style="height: 38px; width: 100%;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </x-adminlte-card>
                </div>

                <!-- Right Column: Contact & About -->
                <div class="col-md-6">
                    <!-- Contact and Social links -->
                    <x-adminlte-card title="{{ app()->getLocale() == 'ar' ? 'بيانات التواصل والشبكات' : 'Contacts & Social Links' }}" theme="olive" icon="fas fa-share-alt">
                        <div class="row">
                            <div class="col-md-6">
                                <label>{{ app()->getLocale() == 'ar' ? 'رقم التواصل' : 'Phone' }}</label>
                                <x-adminlte-input name="phone" value="{{ $settings['phone'] ?? '' }}" placeholder="+967777777777" disable-feedback />
                            </div>
                            <div class="col-md-6">
                                <label>{{ app()->getLocale() == 'ar' ? 'البريد الإلكتروني' : 'Email' }}</label>
                                <x-adminlte-input type="email" name="email" value="{{ $settings['email'] ?? '' }}" placeholder="info@twasol-tech.com" disable-feedback />
                            </div>
                            <div class="col-md-6">
                                <label>{{ app()->getLocale() == 'ar' ? 'رابط واتساب' : 'WhatsApp Link' }}</label>
                                <x-adminlte-input name="whatsapp" value="{{ $settings['whatsapp'] ?? '' }}" placeholder="https://wa.me/..." disable-feedback />
                            </div>
                            <div class="col-md-6">
                                <label>{{ app()->getLocale() == 'ar' ? 'رابط فيسبوك' : 'Facebook Link' }}</label>
                                <x-adminlte-input name="facebook" value="{{ $settings['facebook'] ?? '' }}" placeholder="https://facebook.com/..." disable-feedback />
                            </div>
                            <div class="col-md-6">
                                <label>{{ app()->getLocale() == 'ar' ? 'رابط انستقرام' : 'Instagram Link' }}</label>
                                <x-adminlte-input name="instagram" value="{{ $settings['instagram'] ?? '' }}" placeholder="https://instagram.com/..." disable-feedback />
                            </div>
                            <div class="col-md-6">
                                <label>{{ app()->getLocale() == 'ar' ? 'رابط يوتيوب' : 'YouTube Link' }}</label>
                                <x-adminlte-input name="youtube" value="{{ $settings['youtube'] ?? '' }}" placeholder="https://youtube.com/..." disable-feedback />
                            </div>
                        </div>
                    </x-adminlte-card>
                </div>
            </div>

            <!-- About Us Content -->
            <div class="row">
                <div class="col-md-12">
                    <x-adminlte-card title="{{ app()->getLocale() == 'ar' ? 'محتوى من نحن' : 'About Us Content' }}" theme="teal" icon="fas fa-info-circle">
                        <div class="row">
                            <div class="col-md-6">
                                <label>{{ app()->getLocale() == 'ar' ? 'من نحن (عربي)' : 'About Us (Arabic)' }}</label>
                                <x-adminlte-textarea name="about_ar" rows="5" placeholder="{{ app()->getLocale() == 'ar' ? 'اكتب نبذة عن الشركة هنا...' : 'Write about company here...' }}">{{ $settings['about_ar'] ?? '' }}</x-adminlte-textarea>
                            </div>
                            <div class="col-md-6">
                                <label>{{ app()->getLocale() == 'ar' ? 'من نحن (إنجليزي)' : 'About Us (English)' }}</label>
                                <x-adminlte-textarea name="about_en" rows="5" placeholder="{{ app()->getLocale() == 'ar' ? 'اكتب نبذة بالإنجليزية...' : 'Write about company in English...' }}">{{ $settings['about_en'] ?? '' }}</x-adminlte-textarea>
                            </div>
                        </div>
                    </x-adminlte-card>
                </div>
            </div>

            <div class="text-center mt-3">
                <x-adminlte-button type="submit" label="{{ app()->getLocale() == 'ar' ? 'حفظ التغييرات' : 'Save Changes' }}" theme="success" icon="fas fa-save" class="btn-lg" />
            </div>
        </form>
    </div>
@stop