@extends('adminlte::page')

@section('title', 'طلبات الخدمات المرفوعة')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1>طلبات الخدمات من الموقع الإلكتروني</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="{{ route('home', ['locale' => app()->getLocale()]) }}">الرئيسية</a></li>
                <li class="breadcrumb-item active">طلبات الخدمات</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card card-olive card-outline">
            <div class="card-header">
                <h3 class="card-title">قائمة الطلبات المستلمة ({{ $requests->total() }})</h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الاسم الكامل</th>
                            <th>رقم الهاتف</th>
                            <th>البريد الإلكتروني</th>
                            <th>الخدمة المطلوبة</th>
                            <th>تفاصيل الرسالة</th>
                            <th>تاريخ الطلب</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($requests as $req)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><strong>{{ $req->full_name }}</strong></td>
                                <td>
                                    <a href="tel:{{ $req->phone }}" class="btn btn-xs btn-outline-success">
                                        <i class="fas fa-phone mr-1"></i> {{ $req->phone }}
                                    </a>
                                </td>
                                <td>{{ $req->email ?? 'غير مذكور' }}</td>
                                <td>
                                    <span class="badge badge-info">{{ $req->service_name }}</span>
                                </td>
                                <td style="max-width: 250px; white-space: normal;">{{ $req->message }}</td>
                                <td>{{ $req->created_at->format('Y-m-d H:i') }}</td>
                                <td>
                                    <form action="{{ route('service-requests.destroy', ['locale' => app()->getLocale(), 'service_request' => $req->id]) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('هل أنت تأكد من حذف هذا الطلب؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-xs btn-danger" title="حذف">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
                                    لا توجد طلبات خدمات مستلمة حالياً.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($requests->hasPages())
                <div class="card-footer clearfix">
                    {{ $requests->links() }}
                </div>
            @endif
        </div>
    </div>
@stop
