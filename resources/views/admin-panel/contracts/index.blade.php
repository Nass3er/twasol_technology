@extends('adminlte::page')
@section('title', app()->getLocale() == 'ar' ? 'عقود الصيانة السنوية' : 'Annual Maintenance Contracts')

@section('content_header')
    <h1>{{ app()->getLocale() == 'ar' ? 'عقود الصيانة السنوية' : 'Annual Maintenance Contracts' }}</h1>
@stop

@section('content')
    <div class="container-fluid pb-5">
        <div class="mb-3">
            <a href="{{ route('contracts.create', ['locale' => app()->getLocale()]) }}" class="btn btn-success btn-lg">
                <i class="fas fa-plus"></i> {{ app()->getLocale() == 'ar' ? 'إضافة عقد جديد' : 'Add New Contract' }}
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

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card card-navy">
            <div class="card-header">
                <h3 class="card-title">{{ app()->getLocale() == 'ar' ? 'قائمة عقود الصيانة' : 'Contracts List' }}</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped" id="contracts-table">
                    <thead>
                        <tr>
                            <th>{{ app()->getLocale() == 'ar' ? 'العميل' : 'Customer' }}</th>
                            <th>{{ app()->getLocale() == 'ar' ? 'تاريخ البدء' : 'Start Date' }}</th>
                            <th>{{ app()->getLocale() == 'ar' ? 'تاريخ الانتهاء' : 'End Date' }}</th>
                            <th>{{ app()->getLocale() == 'ar' ? 'المدة المتبقية' : 'Time Left' }}</th>
                            <th>{{ app()->getLocale() == 'ar' ? 'الحالة' : 'Status' }}</th>
                            <th>{{ app()->getLocale() == 'ar' ? 'تنبيه الإيميل' : 'Email Notified' }}</th>
                            <th>{{ app()->getLocale() == 'ar' ? 'العمليات' : 'Actions' }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contracts as $contract)
                            @php
                                $daysLeft = (int) now()->diffInDays($contract->end_date, false);
                                $isExpired = $daysLeft < 0;
                                $isExpiringSoon = !$isExpired && $daysLeft <= 30;
                            @endphp
                            <tr>
                                <td>
                                    {{ app()->getLocale() == 'ar' ? $contract->customer->name_ar : $contract->customer->name_en }}
                                </td>
                                <td>{{ $contract->start_date->format('Y-m-d') }}</td>
                                <td>{{ $contract->end_date->format('Y-m-d') }}</td>
                                <td>
                                    @if($isExpired)
                                        <span class="badge badge-danger p-1">
                                            {{ app()->getLocale() == 'ar' ? 'منتهي' : 'Expired' }} ({{ abs($daysLeft) }} {{ app()->getLocale() == 'ar' ? 'يوم' : 'Days' }})
                                        </span>
                                    @elseif($isExpiringSoon)
                                        <span class="badge badge-warning p-1">
                                            {{ app()->getLocale() == 'ar' ? 'ينتهي قريباً' : 'Expiring Soon' }} ({{ $daysLeft }} {{ app()->getLocale() == 'ar' ? 'يوم' : 'Days' }})
                                        </span>
                                    @else
                                        <span class="badge badge-success p-1">{{ $daysLeft }} {{ app()->getLocale() == 'ar' ? 'يوم' : 'Days' }}</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge badge-{{ $contract->active ? 'success' : 'danger' }}">
                                        {{ $contract->active 
                                            ? (app()->getLocale() == 'ar' ? 'نشط' : 'Active') 
                                            : (app()->getLocale() == 'ar' ? 'غير نشط' : 'Inactive') }}
                                    </span>
                                </td>
                                <td>
                                    @if($contract->notified_at)
                                        <span class="text-success" title="{{ $contract->notified_at }}">
                                            <i class="fas fa-check-circle"></i> {{ app()->getLocale() == 'ar' ? 'نعم' : 'Yes' }}
                                        </span>
                                    @else
                                        <span class="text-muted"><i class="fas fa-times-circle"></i> {{ app()->getLocale() == 'ar' ? 'لا' : 'No' }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('contracts.edit', ['locale' => app()->getLocale(), 'contract' => $contract->id]) }}" class="btn btn-warning btn-sm" title="{{ app()->getLocale() == 'ar' ? 'تعديل' : 'Edit' }}">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <button type="button" class="btn btn-info btn-sm renew-btn" data-id="{{ $contract->id }}" data-customer="{{ app()->getLocale() == 'ar' ? $contract->customer->name_ar : $contract->customer->name_en }}" data-end="{{ $contract->end_date->format('Y-m-d') }}" data-toggle="modal" data-target="#renewModal" title="{{ app()->getLocale() == 'ar' ? 'تجديد العقد' : 'Renew Contract' }}">
                                        <i class="fas fa-sync-alt"></i> {{ app()->getLocale() == 'ar' ? 'تجديد' : 'Renew' }}
                                    </button>
                                    
                                    <form action="{{ route('contracts.toggleActive', ['locale' => app()->getLocale(), 'id' => $contract->id]) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-{{ $contract->active ? 'secondary' : 'success' }} btn-sm" title="{{ $contract->active ? (app()->getLocale() == 'ar' ? 'تعطيل' : 'Deactivate') : (app()->getLocale() == 'ar' ? 'تنشيط' : 'Activate') }}">
                                            <i class="fas fa-{{ $contract->active ? 'eye-slash' : 'eye' }}"></i>
                                        </button>
                                    </form>

                                    <form action="{{ route('contracts.destroy', ['locale' => app()->getLocale(), 'contract' => $contract->id]) }}" method="POST" style="display:inline;" onsubmit="return confirm('{{ app()->getLocale() == 'ar' ? 'هل أنت متأكد من الحذف؟' : 'Are you sure you want to delete?' }}');">
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

    <!-- Renewal Modal -->
    <div class="modal fade" id="renewModal" tabindex="-1" role="dialog" aria-labelledby="renewModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="renewModalLabel">{{ app()->getLocale() == 'ar' ? 'تجديد عقد الصيانة' : 'Renew Contract' }}</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="renewForm" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label>{{ app()->getLocale() == 'ar' ? 'العميل' : 'Customer' }}</label>
                            <input type="text" class="form-control" id="modalCustomerName" readonly>
                        </div>
                        <div class="form-group">
                            <label>{{ app()->getLocale() == 'ar' ? 'تاريخ الانتهاء الحالي' : 'Current End Date' }}</label>
                            <input type="text" class="form-control" id="modalCurrentEndDate" readonly>
                        </div>
                        <div class="form-group">
                            <label>{{ app()->getLocale() == 'ar' ? 'تاريخ الانتهاء الجديد *' : 'New End Date *' }}</label>
                            <input type="date" name="new_end_date" class="form-control" id="modalNewEndDate" required>
                        </div>
                        <div class="form-group">
                            <label>{{ app()->getLocale() == 'ar' ? 'تفاصيل التجديد (عربي)' : 'Renewal Details (Arabic)' }}</label>
                            <textarea name="renewal_description_ar" class="form-control" rows="3" placeholder="{{ app()->getLocale() == 'ar' ? 'ملاحظات تجديد العقد...' : 'Renewal notes...' }}"></textarea>
                        </div>
                        <div class="form-group">
                            <label>{{ app()->getLocale() == 'ar' ? 'تفاصيل التجديد (إنجليزي)' : 'Renewal Details (English)' }}</label>
                            <textarea name="renewal_description_en" class="form-control" rows="3" placeholder="{{ app()->getLocale() == 'ar' ? 'ملاحظات بالإنجليزية...' : 'English renewal description...' }}"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ app()->getLocale() == 'ar' ? 'إلغاء' : 'Cancel' }}</button>
                        <button type="submit" class="btn btn-info">{{ app()->getLocale() == 'ar' ? 'تجديد العقد' : 'Renew Contract' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            var isAr = "{{ app()->getLocale() == 'ar' }}";
            $('#contracts-table').DataTable({
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

            $('.renew-btn').on('click', function() {
                var contractId = $(this).data('id');
                var customerName = $(this).data('customer');
                var currentEnd = $(this).data('end');

                $('#modalCustomerName').val(customerName);
                $('#modalCurrentEndDate').val(currentEnd);
                
                // Set the action of the form dynamically
                var renewUrl = '{{ route("contracts.renew", ["locale" => app()->getLocale(), "id" => "__ID__"]) }}';
                renewUrl = renewUrl.replace('__ID__', contractId);
                $('#renewForm').attr('action', renewUrl);

                // Pre-populate new end date to +1 year from current end date
                var currentEndParts = currentEnd.split('-');
                if (currentEndParts.length === 3) {
                    var year = parseInt(currentEndParts[0]) + 1;
                    var month = currentEndParts[1];
                    var day = currentEndParts[2];
                    $('#modalNewEndDate').val(year + '-' + month + '-' + day);
                }
            });
        });
    </script>
@stop