@extends('adminlte::page')
@section('title', app()->getLocale() == 'ar' ? 'لوحة التحكم - تواصل تكنولوجي' : 'Dashboard - Twasol Technology')

@section('content_header')
    <h1 class="m-0 text-dark">
        <i class="fas fa-tachometer-alt text-navy mr-2"></i>
        {{ app()->getLocale() == 'ar' ? 'لوحة التحكم' : 'Dashboard' }}
    </h1>
@stop

@section('content')
    <div class="container-fluid py-2">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            </div>
        @endif

        <!-- Summary Cards -->
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <x-adminlte-info-box
                    title="{{ app()->getLocale() == 'ar' ? 'الخدمات النشطة' : 'Active Services' }}"
                    text="{{ $totalServices }}"
                    icon="fas fa-network-wired"
                    theme="info" />
            </div>
            <div class="col-md-4 col-sm-6">
                <x-adminlte-info-box
                    title="{{ app()->getLocale() == 'ar' ? 'إجمالي العملاء' : 'Total Customers' }}"
                    text="{{ $totalCustomers }}"
                    icon="fas fa-users"
                    theme="success" />
            </div>
            <div class="col-md-4 col-sm-6">
                <x-adminlte-info-box
                    title="{{ app()->getLocale() == 'ar' ? 'عقود الصيانة الجارية' : 'Active Contracts' }}"
                    text="{{ $activeContracts }}"
                    icon="fas fa-file-contract"
                    theme="navy" />
            </div>
        </div>

        <!-- Expiring Contracts Alert -->
        @if($expiringContracts->isNotEmpty())
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="card card-warning card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-exclamation-triangle text-warning mr-2"></i>
                            {{ app()->getLocale() == 'ar' ? 'عقود تنتهي خلال 30 يوم' : 'Contracts Expiring Within 30 Days' }}
                        </h3>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>{{ app()->getLocale() == 'ar' ? 'العميل' : 'Customer' }}</th>
                                    <th>{{ app()->getLocale() == 'ar' ? 'تاريخ الانتهاء' : 'End Date' }}</th>
                                    <th>{{ app()->getLocale() == 'ar' ? 'الأيام المتبقية' : 'Days Remaining' }}</th>
                                    <th>{{ app()->getLocale() == 'ar' ? 'العملية' : 'Action' }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($expiringContracts as $contract)
                                    @php $daysLeft = (int) now()->diffInDays($contract->end_date, false); @endphp
                                    <tr>
                                        <td><strong>{{ app()->getLocale() == 'ar' ? $contract->customer->name_ar : $contract->customer->name_en }}</strong></td>
                                        <td>{{ $contract->end_date->format('Y-m-d') }}</td>
                                        <td>
                                            <span class="badge badge-{{ $daysLeft <= 7 ? 'danger' : 'warning' }} p-2">
                                                {{ $daysLeft }} {{ app()->getLocale() == 'ar' ? 'يوم' : 'Days' }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('contracts.edit', ['locale' => app()->getLocale(), 'contract' => $contract->id]) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-sync-alt"></i>
                                                {{ app()->getLocale() == 'ar' ? 'تجديد' : 'Renew' }}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Quick Links -->
        <div class="row mt-4">
            <div class="col-md-12">
                <h5 class="text-muted mb-3">{{ app()->getLocale() == 'ar' ? 'روابط سريعة' : 'Quick Links' }}</h5>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <a href="{{ route('services.index', app()->getLocale()) }}" class="btn btn-block btn-outline-info btn-lg">
                    <i class="fas fa-network-wired mb-1 d-block fa-2x"></i>
                    {{ app()->getLocale() == 'ar' ? 'إدارة الخدمات' : 'Manage Services' }}
                </a>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <a href="{{ route('customers.index', app()->getLocale()) }}" class="btn btn-block btn-outline-success btn-lg">
                    <i class="fas fa-users mb-1 d-block fa-2x"></i>
                    {{ app()->getLocale() == 'ar' ? 'إدارة العملاء' : 'Manage Customers' }}
                </a>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <a href="{{ route('contracts.index', app()->getLocale()) }}" class="btn btn-block btn-outline-warning btn-lg">
                    <i class="fas fa-file-contract mb-1 d-block fa-2x"></i>
                    {{ app()->getLocale() == 'ar' ? 'عقود الصيانة' : 'Maintenance Contracts' }}
                </a>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <a href="{{ route('admin.settings.index', app()->getLocale()) }}" class="btn btn-block btn-outline-secondary btn-lg">
                    <i class="fas fa-cog mb-1 d-block fa-2x"></i>
                    {{ app()->getLocale() == 'ar' ? 'إعدادات الشركة' : 'Company Settings' }}
                </a>
            </div>
        </div>

    </div>
@stop