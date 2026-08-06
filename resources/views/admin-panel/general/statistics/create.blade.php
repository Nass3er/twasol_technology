@extends('adminlte::page')
@section('title', app()->getLocale() == 'ar' ? 'إضافة إحصائية جديدة' : 'Add New Statistic')

@section('content_header')
    <h1>{{ app()->getLocale() == 'ar' ? 'إضافة إحصائية جديدة' : 'Add New Statistic' }}</h1>
@stop

@section('content')
    <div class="card card-olive">
        <div class="card-header">
            <h3 class="card-title">{{ app()->getLocale() == 'ar' ? 'نموذج الإحصائية' : 'Statistic Form' }}</h3>
        </div>
        <form action="{{ route('statistics.store', ['locale' => app()->getLocale()]) }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>{{ app()->getLocale() == 'ar' ? 'اسم الإحصائية (عربي) *' : 'Statistic Name (Arabic) *' }}</label>
                        <input type="text" name="name_ar" class="form-control" value="{{ old('name_ar') }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>{{ app()->getLocale() == 'ar' ? 'اسم الإحصائية (إنجليزي) *' : 'Statistic Name (English) *' }}</label>
                        <input type="text" name="name_en" class="form-control" value="{{ old('name_en') }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>{{ app()->getLocale() == 'ar' ? 'الرقم أو النسبة * (مثال: 150+ , 99.9%)' : 'Number or Value * (e.g. 150+ , 99.9%)' }}</label>
                        <input type="text" name="number" class="form-control" value="{{ old('number') }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>{{ app()->getLocale() == 'ar' ? 'الأيقونة (مثال: fas fa-users)' : 'Icon (e.g. fas fa-users)' }}</label>
                        <input type="text" name="icon" class="form-control" value="{{ old('icon', 'fas fa-chart-bar') }}">
                        <small class="form-text text-muted">{{ app()->getLocale() == 'ar' ? 'استخدم كلاسات FontAwesome 5' : 'Use FontAwesome 5 classes' }}</small>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>{{ app()->getLocale() == 'ar' ? 'الوصف (عربي)' : 'Description (Arabic)' }}</label>
                        <textarea name="description_ar" class="form-control" rows="3">{{ old('description_ar') }}</textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label>{{ app()->getLocale() == 'ar' ? 'الوصف (إنجليزي)' : 'Description (English)' }}</label>
                        <textarea name="description_en" class="form-control" rows="3">{{ old('description_en') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success">{{ app()->getLocale() == 'ar' ? 'حفظ' : 'Save' }}</button>
                <a href="{{ route('statistics.index', ['locale' => app()->getLocale()]) }}" class="btn btn-default">{{ app()->getLocale() == 'ar' ? 'إلغاء' : 'Cancel' }}</a>
            </div>
        </form>
    </div>
@stop