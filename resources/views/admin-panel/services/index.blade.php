@extends('adminlte::page')
@section('title', app()->getLocale() == 'ar' ? 'إدارة الخدمات' : 'Services Management')

@section('content_header')
    <h1>{{ app()->getLocale() == 'ar' ? 'إدارة الخدمات' : 'Services Management' }}</h1>
@stop

@section('content')
    <div class="container-fluid pb-5">
        <div class="mb-3">
            <a href="{{ route('services.create', ['locale' => app()->getLocale()]) }}" class="btn btn-success btn-lg">
                <i class="fas fa-plus"></i> {{ app()->getLocale() == 'ar' ? 'إضافة خدمة جديدة' : 'Add New Service' }}
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
                <h3 class="card-title">{{ app()->getLocale() == 'ar' ? 'قائمة الخدمات' : 'Services List' }}</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped" id="services-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>{{ app()->getLocale() == 'ar' ? 'اسم الخدمة (عربي)' : 'Service Name (AR)' }}</th>
                            <th>{{ app()->getLocale() == 'ar' ? 'اسم الخدمة (إنجليزي)' : 'Service Name (EN)' }}</th>
                            <th>{{ app()->getLocale() == 'ar' ? 'السعر' : 'Price' }}</th>
                            <th>{{ app()->getLocale() == 'ar' ? 'الصور' : 'Images' }}</th>
                            <th>{{ app()->getLocale() == 'ar' ? 'الحالة' : 'Status' }}</th>
                            <th>{{ app()->getLocale() == 'ar' ? 'العمليات' : 'Actions' }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($services as $service)
                            <tr>
                                <td>{{ $service->id }}</td>
                                <td>{{ $service->name_ar }}</td>
                                <td>{{ $service->name_en }}</td>
                                <td>
                                    @if($service->price)
                                        {{ $service->price }} $
                                    @else
                                        {{ app()->getLocale() == 'ar' ? 'مجاني' : 'Free' }}
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex flex-wrap">
                                        @foreach($service->images as $img)
                                            <img src="{{ asset($img->image_path) }}" class="img-thumbnail mr-1 mb-1" style="max-height: 40px;">
                                        @endforeach
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-{{ $service->active ? 'success' : 'danger' }}">
                                        {{ $service->active 
                                            ? (app()->getLocale() == 'ar' ? 'نشط' : 'Active') 
                                            : (app()->getLocale() == 'ar' ? 'غير نشط' : 'Inactive') }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('services.edit', ['locale' => app()->getLocale(), 'service' => $service->id]) }}" class="btn btn-warning btn-sm" title="{{ app()->getLocale() == 'ar' ? 'تعديل' : 'Edit' }}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    <form action="{{ route('services.toggleActive', ['locale' => app()->getLocale(), 'id' => $service->id]) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-{{ $service->active ? 'secondary' : 'success' }} btn-sm" title="{{ $service->active ? (app()->getLocale() == 'ar' ? 'تعطيل' : 'Deactivate') : (app()->getLocale() == 'ar' ? 'تنشيط' : 'Activate') }}">
                                            <i class="fas fa-{{ $service->active ? 'eye-slash' : 'eye' }}"></i>
                                        </button>
                                    </form>

                                    <form action="{{ route('services.destroy', ['locale' => app()->getLocale(), 'service' => $service->id]) }}" method="POST" style="display:inline;" onsubmit="return confirm('{{ app()->getLocale() == 'ar' ? 'هل أنت متأكد من الحذف؟' : 'Are you sure you want to delete?' }}');">
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
            $('#services-table').DataTable({
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