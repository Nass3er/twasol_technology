@extends('adminlte::page')
@section('title', app()->getLocale() == 'ar' ? 'تعديل عقد الصيانة' : 'Edit Maintenance Contract')

@section('content_header')
    <h1>{{ app()->getLocale() == 'ar' ? 'تعديل عقد الصيانة' : 'Edit Maintenance Contract' }}</h1>
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

        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">{{ app()->getLocale() == 'ar' ? 'تعديل نموذج العقد' : 'Edit Contract Form' }}</h3>
            </div>
            <form action="{{ route('contracts.update', ['locale' => app()->getLocale(), 'contract' => $contract->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>{{ app()->getLocale() == 'ar' ? 'العميل *' : 'Customer *' }}</label>
                            <select name="customer_id" class="form-control" required>
                                @foreach($customers as $cust)
                                    <option value="{{ $cust->id }}" {{ old('customer_id', $contract->customer_id) == $cust->id ? 'selected' : '' }}>
                                        {{ app()->getLocale() == 'ar' ? $cust->name_ar : $cust->name_en }} ({{ $cust->phone }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>{{ app()->getLocale() == 'ar' ? 'تاريخ بدء العقد *' : 'Start Date *' }}</label>
                            <input type="date" name="start_date" class="form-control" value="{{ old('start_date', $contract->start_date->format('Y-m-d')) }}" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>{{ app()->getLocale() == 'ar' ? 'تاريخ انتهاء العقد *' : 'End Date *' }}</label>
                            <input type="date" name="end_date" class="form-control" value="{{ old('end_date', $contract->end_date->format('Y-m-d')) }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>{{ app()->getLocale() == 'ar' ? 'وصف العقد (عربي)' : 'Contract Description (Arabic)' }}</label>
                            <textarea name="description_ar" class="form-control" rows="4">{{ old('description_ar', $contract->description_ar) }}</textarea>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>{{ app()->getLocale() == 'ar' ? 'وصف العقد (إنجليزي)' : 'Contract Description (English)' }}</label>
                            <textarea name="description_en" class="form-control" rows="4">{{ old('description_en', $contract->description_en) }}</textarea>
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