@extends('adminlte::page')
@section('title', app()->getLocale() == 'ar' ? 'الإحصائيات' : 'Statistics')

@section('content_header')
    <h1>{{ app()->getLocale() == 'ar' ? 'الإحصائيات' : 'Statistics' }}</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="mb-3">
            <a href="{{ route('statistics.create', ['locale' => app()->getLocale()]) }}" class="btn btn-success btn-lg">
                <i class="fas fa-plus"></i> {{ app()->getLocale() == 'ar' ? 'إضافة إحصائية جديدة' : 'Add New Statistic' }}
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            </div>
        @endif

        <div class="card card-olive">
            <div class="card-header">
                <h3 class="card-title">{{ app()->getLocale() == 'ar' ? 'قائمة الإحصائيات' : 'Statistics List' }}</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped" id="stats-table">
                    <thead>
                        <tr>
                            <th>{{ app()->getLocale() == 'ar' ? 'الأيقونة' : 'Icon' }}</th>
                            <th>{{ app()->getLocale() == 'ar' ? 'الاسم (عربي)' : 'Name (AR)' }}</th>
                            <th>{{ app()->getLocale() == 'ar' ? 'الاسم (إنجليزي)' : 'Name (EN)' }}</th>
                            <th>{{ app()->getLocale() == 'ar' ? 'الرقم / القيمة' : 'Number / Value' }}</th>
                            <th>{{ app()->getLocale() == 'ar' ? 'الوصف' : 'Description' }}</th>
                            <th>{{ app()->getLocale() == 'ar' ? 'الحالة' : 'Status' }}</th>
                            <th>{{ app()->getLocale() == 'ar' ? 'العمليات' : 'Actions' }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($statistics as $stat)
                            <tr>
                                <td class="text-center">
                                    @if($stat->icon)
                                        <i class="{{ $stat->icon }} fa-lg"></i>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>{{ $stat->name_ar }}</td>
                                <td>{{ $stat->name_en }}</td>
                                <td><strong>{{ $stat->number }}</strong></td>
                                <td>{{ Str::limit(app()->getLocale() == 'ar' ? $stat->description_ar : $stat->description_en, 60) }}</td>
                                <td>
                                    <span class="badge badge-{{ $stat->active ? 'success' : 'danger' }}">
                                        {{ $stat->active 
                                            ? (app()->getLocale() == 'ar' ? 'نشط' : 'Active') 
                                            : (app()->getLocale() == 'ar' ? 'معطل' : 'Inactive') }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('statistics.edit', ['locale' => app()->getLocale(), 'statistic' => $stat->id]) }}" class="btn btn-warning btn-sm" title="{{ app()->getLocale() == 'ar' ? 'تعديل' : 'Edit' }}">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('statistics.toggleActive', ['locale' => app()->getLocale(), 'id' => $stat->id]) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-{{ $stat->active ? 'secondary' : 'success' }} btn-sm" title="{{ $stat->active ? (app()->getLocale() == 'ar' ? 'تعطيل' : 'Deactivate') : (app()->getLocale() == 'ar' ? 'تنشيط' : 'Activate') }}">
                                            <i class="fas fa-{{ $stat->active ? 'eye-slash' : 'eye' }}"></i>
                                        </button>
                                    </form>

                                    <form action="{{ route('statistics.destroy', ['locale' => app()->getLocale(), 'statistic' => $stat->id]) }}" method="POST" style="display:inline;" onsubmit="return confirm('{{ app()->getLocale() == 'ar' ? 'هل أنت متأكد من حذف الإحصائية؟' : 'Are you sure you want to delete this statistic?' }}');">
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
            $('#stats-table').DataTable({
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