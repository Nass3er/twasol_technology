@extends('adminlte::page')
@section('title', app()->getLocale() == 'ar' ? 'تعديل الإحصائية' : 'Edit Statistic')

@section('content_header')
    <h1>{{ app()->getLocale() == 'ar' ? 'تعديل الإحصائية' : 'Edit Statistic' }}</h1>
@stop

@section('content')
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">{{ app()->getLocale() == 'ar' ? 'نموذج التعديل' : 'Edit Form' }}</h3>
        </div>
        <form action="{{ route('statistics.update', ['locale' => app()->getLocale(), 'statistic' => $statistic->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>{{ app()->getLocale() == 'ar' ? 'اسم الإحصائية (عربي) *' : 'Statistic Name (Arabic) *' }}</label>
                        <input type="text" name="name_ar" class="form-control" value="{{ old('name_ar', $statistic->name_ar) }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>{{ app()->getLocale() == 'ar' ? 'اسم الإحصائية (إنجليزي) *' : 'Statistic Name (English) *' }}</label>
                        <input type="text" name="name_en" class="form-control" value="{{ old('name_en', $statistic->name_en) }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>{{ app()->getLocale() == 'ar' ? 'الرقم أو النسبة * (مثال: 150+ , 99.9%)' : 'Number or Value * (e.g. 150+ , 99.9%)' }}</label>
                        <input type="text" name="number" class="form-control" value="{{ old('number', $statistic->number) }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>{{ app()->getLocale() == 'ar' ? 'الأيقونة (مثال: fas fa-users)' : 'Icon (e.g. fas fa-users)' }}</label>
                        <input type="text" name="icon" class="form-control" value="{{ old('icon', $statistic->icon) }}">
                        <small class="form-text text-muted">{{ app()->getLocale() == 'ar' ? 'استخدم كلاسات FontAwesome 5' : 'Use FontAwesome 5 classes' }}</small>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>{{ app()->getLocale() == 'ar' ? 'الوصف (عربي)' : 'Description (Arabic)' }}</label>
                        <textarea name="description_ar" class="form-control" rows="3">{{ old('description_ar', $statistic->description_ar) }}</textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label>{{ app()->getLocale() == 'ar' ? 'الوصف (إنجليزي)' : 'Description (English)' }}</label>
                        <textarea name="description_en" class="form-control" rows="3">{{ old('description_en', $statistic->description_en) }}</textarea>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-warning text-dark font-weight-bold">{{ app()->getLocale() == 'ar' ? 'حفظ التغييرات' : 'Save Changes' }}</button>
                <a href="{{ route('statistics.index', ['locale' => app()->getLocale()]) }}" class="btn btn-default">{{ app()->getLocale() == 'ar' ? 'إلغاء' : 'Cancel' }}</a>
            </div>
        </form>
    </div>
@stop