@extends('adminlte::page')
@section('title', app()->getLocale() == 'ar' ? 'تعديل الخدمة' : 'Edit Service')

@section('content_header')
    <h1>{{ app()->getLocale() == 'ar' ? 'تعديل الخدمة' : 'Edit Service' }}</h1>
@stop

@section('content')
    <div class="container-fluid pb-5">
        <a href="{{ route('services.index', ['locale' => app()->getLocale()]) }}" class="btn btn-secondary mb-3">
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
                <h3 class="card-title">{{ app()->getLocale() == 'ar' ? 'نموذج تعديل الخدمة' : 'Service Edit Form' }}</h3>
            </div>
            <form action="{{ route('services.update', ['locale' => app()->getLocale(), 'service' => $service->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>{{ app()->getLocale() == 'ar' ? 'اسم الخدمة (عربي) *' : 'Service Name (Arabic) *' }}</label>
                            <input type="text" name="name_ar" class="form-control" value="{{ old('name_ar', $service->name_ar) }}" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>{{ app()->getLocale() == 'ar' ? 'اسم الخدمة (إنجليزي) *' : 'Service Name (English) *' }}</label>
                            <input type="text" name="name_en" class="form-control" value="{{ old('name_en', $service->name_en) }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>{{ app()->getLocale() == 'ar' ? 'الوصف (عربي)' : 'Description (Arabic)' }}</label>
                            <textarea name="description_ar" class="form-control" rows="4">{{ old('description_ar', $service->description_ar) }}</textarea>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>{{ app()->getLocale() == 'ar' ? 'الوصف (إنجليزي)' : 'Description (English)' }}</label>
                            <textarea name="description_en" class="form-control" rows="4">{{ old('description_en', $service->description_en) }}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>{{ app()->getLocale() == 'ar' ? 'السعر' : 'Price' }}</label>
                            <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $service->price) }}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>{{ app()->getLocale() == 'ar' ? 'إضافة صور جديدة' : 'Add New Images' }}</label>
                            <input type="file" name="images[]" class="form-control" multiple>
                        </div>
                    </div>

                    @if($service->images->isNotEmpty())
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <label>{{ app()->getLocale() == 'ar' ? 'الصور الحالية' : 'Current Images' }}</label>
                                <div class="row">
                                    @foreach($service->images as $img)
                                        <div class="col-md-2 col-sm-4 text-center img-container-{{ $img->id }} mb-3">
                                            <div class="position-relative border p-1 rounded" style="background: #f8f9fa;">
                                                <img src="{{ asset($img->image_path) }}" class="img-fluid mb-2" style="max-height: 100px;">
                                                <button type="button" class="btn btn-danger btn-xs btn-block delete-image-btn" data-id="{{ $img->id }}">
                                                    <i class="fas fa-trash"></i> {{ app()->getLocale() == 'ar' ? 'حذف الصورة' : 'Delete Image' }}
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
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

@section('js')
    <script>
        $(document).ready(function() {
            var isAr = "{{ app()->getLocale() == 'ar' }}";
            $('.delete-image-btn').on('click', function() {
                var imageId = $(this).data('id');
                var deleteUrl = '{{ route("services.destroyImage", ["locale" => app()->getLocale(), "id" => "__ID__"]) }}';
                deleteUrl = deleteUrl.replace('__ID__', imageId);

                if (confirm(isAr ? 'هل أنت متأكد من حذف هذه الصورة؟' : 'Are you sure you want to delete this image?')) {
                    $.ajax({
                        url: deleteUrl,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                $('.img-container-' + imageId).fadeOut();
                            }
                        },
                        error: function() {
                            alert(isAr ? 'حدث خطأ أثناء حذف الصورة.' : 'An error occurred while deleting the image.');
                        }
                    });
                }
            });
        });
    </script>
@stop