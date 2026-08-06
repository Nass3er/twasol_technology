@extends('adminlte::page')
@section('title', app()->getLocale() == 'ar' ? 'إضافة عقد جديد' : 'Add New Contract')

@section('content_header')
    <h1>{{ app()->getLocale() == 'ar' ? 'إضافة عقد جديد' : 'Add New Contract' }}</h1>
@stop

@section('content')
    <div class="container-fluid pb-5">
        <a href="{{ route('contracts.index', ['locale' => app()->getLocale()]) }}" class="btn btn-secondary mb-3">
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
                <h3 class="card-title">{{ app()->getLocale() == 'ar' ? 'نموذج عقد الصيانة' : 'Maintenance Contract Form' }}</h3>
            </div>
            <form action="{{ route('contracts.store', ['locale' => app()->getLocale()]) }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>{{ app()->getLocale() == 'ar' ? 'العميل *' : 'Customer *' }}</label>
                            <select name="customer_id" class="form-control" required>
                                <option value="">{{ app()->getLocale() == 'ar' ? 'اختر العميل' : 'Select Customer' }}</option>
                                @foreach($customers as $cust)
                                    <option value="{{ $cust->id }}" {{ old('customer_id') == $cust->id ? 'selected' : '' }}>
                                        {{ app()->getLocale() == 'ar' ? $cust->name_ar : $cust->name_en }} ({{ $cust->phone }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>{{ app()->getLocale() == 'ar' ? 'تاريخ بدء العقد *' : 'Start Date *' }}</label>
                            <input type="date" name="start_date" class="form-control" value="{{ old('start_date', now()->toDateString()) }}" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>{{ app()->getLocale() == 'ar' ? 'تاريخ انتهاء العقد *' : 'End Date *' }}</label>
                            <input type="date" name="end_date" class="form-control" value="{{ old('end_date', now()->addYear()->toDateString()) }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>{{ app()->getLocale() == 'ar' ? 'وصف العقد (عربي)' : 'Contract Description (Arabic)' }}</label>
                            <textarea name="description_ar" class="form-control" rows="4" placeholder="{{ app()->getLocale() == 'ar' ? 'تفاصيل العقد أو الأجهزة المشمولة...' : 'Contract details...' }}"></textarea>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>{{ app()->getLocale() == 'ar' ? 'وصف العقد (إنجليزي)' : 'Contract Description (English)' }}</label>
                            <textarea name="description_en" class="form-control" rows="4" placeholder="{{ app()->getLocale() == 'ar' ? 'تفاصيل العقد بالإنجليزي...' : 'Contract details in English...' }}"></textarea>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success font-weight-bold">
                        <i class="fas fa-save"></i> {{ app()->getLocale() == 'ar' ? 'حفظ العقد' : 'Save Contract' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@stop