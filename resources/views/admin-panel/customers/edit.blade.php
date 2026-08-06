@extends('adminlte::page')
@section('title', app()->getLocale() == 'ar' ? 'تعديل بيانات العميل' : 'Edit Customer Data')

@section('content_header')
    <h1>{{ app()->getLocale() == 'ar' ? 'تعديل بيانات العميل' : 'Edit Customer Data' }}</h1>
@stop

@section('content')
    <div class="container-fluid pb-5">
        <a href="{{ route('customers.index', ['locale' => app()->getLocale()]) }}" class="btn btn-secondary mb-3">
            <i class="fas fa-arrow-left"></i> {{ app()->getLocale() == 'ar' ? 'العودة' : 'Back' }}
        </a>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">{{ app()->getLocale() == 'ar' ? 'نموذج تعديل العميل' : 'Customer Edit Form' }}</h3>
            </div>
            <form action="{{ route('customers.update', ['locale' => app()->getLocale(), 'customer' => $customer->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>{{ app()->getLocale() == 'ar' ? 'اسم العميل (عربي) *' : 'Customer Name (Arabic) *' }}</label>
                            <input type="text" name="name_ar" class="form-control" value="{{ old('name_ar', $customer->name_ar) }}" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>{{ app()->getLocale() == 'ar' ? 'اسم العميل (إنجليزي) *' : 'Customer Name (English) *' }}</label>
                            <input type="text" name="name_en" class="form-control" value="{{ old('name_en', $customer->name_en) }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>{{ app()->getLocale() == 'ar' ? 'رقم الهاتف *' : 'Phone *' }}</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $customer->phone) }}" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>{{ app()->getLocale() == 'ar' ? 'البريد الإلكتروني' : 'Email' }}</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $customer->email) }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>{{ app()->getLocale() == 'ar' ? 'التفاصيل (عربي)' : 'Details (Arabic)' }}</label>
                            <textarea name="details_ar" class="form-control" rows="4">{{ old('details_ar', $customer->details_ar) }}</textarea>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>{{ app()->getLocale() == 'ar' ? 'التفاصيل (إنجليزي)' : 'Details (English)' }}</label>
                            <textarea name="details_en" class="form-control" rows="4">{{ old('details_en', $customer->details_en) }}</textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>{{ app()->getLocale() == 'ar' ? 'شعار العميل' : 'Customer Logo' }}</label>
                            @if($customer->logo)
                                <div class="mb-2">
                                    <img src="{{ asset($customer->logo) }}" alt="Logo" class="img-thumbnail" style="max-height: 80px;">
                                </div>
                            @endif
                            <input type="file" name="logo" class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>{{ app()->getLocale() == 'ar' ? 'الخدمات المقدمة للعميل' : 'Services Provided' }}</label>
                            <div class="border p-3 rounded bg-light" style="max-height: 180px; overflow-y: auto;">
                                @foreach($services as $srv)
                                    <div class="custom-control custom-checkbox mb-2">
                                        <input type="checkbox" class="custom-control-input" id="service_{{ $srv->id }}" name="services[]" value="{{ $srv->id }}"
                                            {{ in_array($srv->id, old('services', $selectedServices)) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="service_{{ $srv->id }}">
                                            {{ app()->getLocale() == 'ar' ? $srv->name_ar : $srv->name_en }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-warning text-dark font-weight-bold">
                        <i class="fas fa-save"></i> {{ app()->getLocale() == 'ar' ? 'حفظ التغييرات' : 'Save Changes' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@stop