@extends('adminlte::page')
@section('title', app()->getLocale() == 'ar' ? 'إدارة العملاء' : 'Customers Management')

@section('content_header')
    <h1>{{ app()->getLocale() == 'ar' ? 'إدارة العملاء' : 'Customers Management' }}</h1>
@stop

@section('content')
    <div class="container-fluid pb-5">
        <div class="mb-3">
            <a href="{{ route('customers.create', ['locale' => app()->getLocale()]) }}" class="btn btn-success btn-lg">
                <i class="fas fa-plus"></i> {{ app()->getLocale() == 'ar' ? 'إضافة عميل جديد' : 'Add New Customer' }}
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card card-navy">
            <div class="card-header">
                <h3 class="card-title">{{ app()->getLocale() == 'ar' ? 'قائمة العملاء' : 'Customers List' }}</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped" id="customers-table">
                    <thead>
                        <tr>
                            <th>{{ app()->getLocale() == 'ar' ? 'الشعار' : 'Logo' }}</th>
                            <th>{{ app()->getLocale() == 'ar' ? 'اسم العميل' : 'Name' }}</th>
                            <th>{{ app()->getLocale() == 'ar' ? 'رقم الهاتف' : 'Phone' }}</th>
                            <th>{{ app()->getLocale() == 'ar' ? 'البريد الإلكتروني' : 'Email' }}</th>
                            <th>{{ app()->getLocale() == 'ar' ? 'الخدمات المشترك بها' : 'Services' }}</th>
                            <th>{{ app()->getLocale() == 'ar' ? 'الحالة' : 'Status' }}</th>
                            <th>{{ app()->getLocale() == 'ar' ? 'العمليات' : 'Actions' }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $customer)
                            <tr>
                                <td>
                                    @if($customer->logo)
                                        <img src="{{ asset($customer->logo) }}" class="img-thumbnail" style="max-height: 40px; max-width: 40px;">
                                    @else
                                        <span class="text-muted">{{ app()->getLocale() == 'ar' ? 'لا يوجد' : 'None' }}</span>
                                    @endif
                                </td>
                                <td>
                                    {{ app()->getLocale() == 'ar' ? $customer->name_ar : $customer->name_en }}
                                </td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->email ?? '-' }}</td>
                                <td>
                                    @forelse($customer->services as $service)
                                        <span class="badge badge-info p-1 mb-1">
                                            {{ app()->getLocale() == 'ar' ? $service->name_ar : $service->name_en }}
                                        </span>
                                    @empty
                                        <span class="text-muted">{{ app()->getLocale() == 'ar' ? 'لا توجد خدمات' : 'No services' }}</span>
                                    @endforelse
                                </td>
                                <td>
                                    <span class="badge badge-{{ $customer->active ? 'success' : 'danger' }}">
                                        {{ $customer->active 
                                            ? (app()->getLocale() == 'ar' ? 'نشط' : 'Active') 
                                            : (app()->getLocale() == 'ar' ? 'غير نشط' : 'Inactive') }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('customers.edit', ['locale' => app()->getLocale(), 'customer' => $customer->id]) }}" class="btn btn-warning btn-sm" title="{{ app()->getLocale() == 'ar' ? 'تعديل' : 'Edit' }}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    <form action="{{ route('customers.toggleActive', ['locale' => app()->getLocale(), 'id' => $customer->id]) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-{{ $customer->active ? 'secondary' : 'success' }} btn-sm" title="{{ $customer->active ? (app()->getLocale() == 'ar' ? 'تعطيل' : 'Deactivate') : (app()->getLocale() == 'ar' ? 'تنشيط' : 'Activate') }}">
                                            <i class="fas fa-{{ $customer->active ? 'eye-slash' : 'eye' }}"></i>
                                        </button>
                                    </form>

                                    <form action="{{ route('customers.destroy', ['locale' => app()->getLocale(), 'customer' => $customer->id]) }}" method="POST" style="display:inline;" onsubmit="return confirm('{{ app()->getLocale() == 'ar' ? 'هل أنت متأكد من الحذف؟ سيتم حذف عقود الصيانة المرتبطة به أيضاً.' : 'Are you sure you want to delete? Associated maintenance contracts will also be deleted.' }}');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="{{ app()->getLocale() == 'ar' ? 'حذف' : 'Delete' }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            var isAr = "{{ app()->getLocale() == 'ar' }}";
            $('#customers-table').DataTable({
                "responsive": true,
                "autoWidth": false,
                "language": isAr ? {
                    "search": "بحث:",
                    "lengthMenu": "عرض _MENU_ عناصر",
                    "info": "عرض من _START_ إلى _END_ من إجمالي _TOTAL_ عناصر",
                    "paginate": {
                        "next": "التالي",
                        "previous": "السابق"
                    }
                } : {}
            });
        });
    </script>
@stop