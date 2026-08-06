@extends('adminlte::page')
@section('title', app()->getLocale() == 'ar' ? 'إضافة خدمة جديدة' : 'Add New Service')

@section('content_header')
    <h1>{{ app()->getLocale() == 'ar' ? 'إضافة خدمة جديدة' : 'Add New Service' }}</h1>
@stop

@section('content')
    <div class="container-fluid pb-5">
        <a href="{{ route('services.index', ['locale' => app()->getLocale()]) }}" class="btn btn-secondary mb-3">
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

        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">{{ app()->getLocale() == 'ar' ? 'نموذج الخدمة' : 'Service Form' }}</h3>
            </div>
            <form action="{{ route('services.store', ['locale' => app()->getLocale()]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>{{ app()->getLocale() == 'ar' ? 'اسم الخدمة (عربي) *' : 'Service Name (Arabic) *' }}</label>
                            <input type="text" name="name_ar" class="form-control" value="{{ old('name_ar') }}" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>{{ app()->getLocale() == 'ar' ? 'اسم الخدمة (إنجليزي) *' : 'Service Name (English) *' }}</label>
                            <input type="text" name="name_en" class="form-control" value="{{ old('name_en') }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>{{ app()->getLocale() == 'ar' ? 'الوصف (عربي)' : 'Description (Arabic)' }}</label>
                            <textarea name="description_ar" class="form-control" rows="4">{{ old('description_ar') }}</textarea>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>{{ app()->getLocale() == 'ar' ? 'الوصف (إنجليزي)' : 'Description (English)' }}</label>
                            <textarea name="description_en" class="form-control" rows="4">{{ old('description_en') }}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>{{ app()->getLocale() == 'ar' ? 'السعر' : 'Price' }}</label>
                            <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price') }}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>{{ app()->getLocale() == 'ar' ? 'إضافة صور الخدمة' : 'Add Service Images' }}</label>
                            <input type="file" name="images[]" class="form-control" multiple>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success font-weight-bold">
                        <i class="fas fa-save"></i> {{ app()->getLocale() == 'ar' ? 'حفظ الخدمة' : 'Save Service' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@stop