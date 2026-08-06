{{-- resources/views/errors/404.blade.php --}}
@extends('errors.error-layout') {{-- Change to your main layout --}}
@include('daisyUI.navbar-upper-2')
@section('content')
<div
class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-b from-gray-500 via-green-950 to-black text-white px-4" style="background-image: linear-gradient(rgba(0, 0, 0, 0.60), rgba(0, 0, 0, 0.95)), url('{{ asset('images/backgrounds/subtle-prism.svg') }}');
background-size: cover;
background-position: center;">

{{-- Big Error Number --}}
<h1
    class="font-extrabold leading-none tracking-widest text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-teal-600"
    style="font-size: clamp(4rem, 20vw, 12rem);">
    404
</h1>

{{-- Message --}}
<p class="mt-4 text-gray-300 text-center" style="font-size: clamp(1rem, 2.5vw, 1.5rem);">
    {{ __('adminlte::landingpage.error404') }}
</p>

{{-- Fun icon --}}
<div class="mt-6 animate-bounce">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-green-400" fill="none" viewBox="0 0 24 24"
        stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M13 16h-1v-4h-1m1-4h.01M21 12c0 4.97-4.03 9-9 9S3 16.97 3 12 7.03 3 12 3s9 4.03 9 9z" />
    </svg>
</div>

{{-- Button back to previous page --}}
<a href="{{ url()->previous() }}"
    class="mt-8 btn btn-warning btn-lg shadow-lg hover:shadow-amber-400/20 transition-all duration-300">
    {{ __('adminlte::landingpage.prevurl') }}
</a>
</div>

@endsection
