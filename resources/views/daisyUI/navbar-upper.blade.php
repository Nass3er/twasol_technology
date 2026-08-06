{{-- <div class="navbar fixed top-0 z-[997] w-1/2 mx-auto bg-base-100 rounded-2xl " > --}}
<div
    class="navbar fixed top-0 z-[997] left-1/2 transform -translate-x-1/2 lg:w-[85%] bg-transparent lg:bg-base-100
{{-- rounded-2xl border-b-4 border-green-900 --}}
 ">

    <div class="navbar-start">
        @include('daisyUI.navbar-mobile')
        <div class="hidden lg:flex">
            @foreach ($loginicons as $loginicon)
                <div class="tooltip tooltip-right" data-tip="{{ __('adminlte::landingpage.css') }}">

                    <a href="{{ $loginicon->url }}" target="_self"
                        class="inline-block transition-transform duration-300 hover:scale-105 ms-8 ">
                        <img src="{{ asset($loginicon->image) }}" class="w-10 h-10 object-contain rounded-xl shadow-md" />
                    </a>
                </div>
            @endforeach
        </div>
    </div>



    <div class="navbar-center">
        <a href="/">
            {{-- <img src="./images/logo.png" alt="Logo" class="h-auto w-auto "> --}}
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-auto w-auto">
        </a>
    </div>

    <div class="navbar-end top-0 z-[998] relative">

        <ul
            class="menu menu-horizontal dropdown-content z-1
            {{-- border-b-4 border-green-900 rounded-2xl rounded-box --}}
            justify-center-safe items-center-safe
            ">
            {{-- <li><a class="nav-parent" href='/'>{{ __('adminlte::landingpage.home') }}</a></li> --}}



            {{-- about us --}}
            <li class="relative group/main font-bold text-black">
                <div tabindex="0" role="button" class="btn btn-ghost btn-sm px-2 hidden lg:flex items-center">
                    <i class="{{ app()->getLocale() == 'ar' ? 'flag-icon flag-icon-eg' : 'flag-icon flag-icon-us' }}"></i>
                    <svg class="ml-2 w-4 h-4 transform group-hover/main:rotate-180 transition-transform duration-200"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.23 7.21a.75.75 0 011.06.02L10 11.194l3.71-3.965a.75.75 0 111.08 1.04l-4.25 4.54a.75.75 0 01-1.08 0l-4.25-4.54a.75.75 0 01.02-1.06z"
                            clip-rule="evenodd" />
                    </svg>
                </div>

                <ul class="absolute top-[100%] rtl:translate-x-[15%] ltr:-translate-x-[15%]  min-w-full w-fit z-999 text-right
                opacity-0 scale-95 pointer-events-none group-hover/main:opacity-100 group-hover/main:scale-100 group-hover/main:pointer-events-auto transition-all duration-300 ease-out
                flex flex-col bg-white shadow-lg rounded-b-xl border-s-4 border-emerald-900 text-[13px]">
                    <li><a href="{{ route('lang.switch', 'en') }}"><i class="flag-icon flag-icon-us"></i>English</a></li>
                    <li><a href="{{ route('lang.switch', 'ar') }}"> <i class="flag-icon flag-icon-eg"></i>العربية</a></li>
                </ul>
            </li>
        </ul>
        {{-- <div class="dropdown dropdown-hover">
            <div tabindex="0" role="button" class="btn btn-ghost btn-sm px-2 hidden lg:flex items-center">
                <i class="{{ app()->getLocale() == 'ar' ? 'flag-icon flag-icon-eg' : 'flag-icon flag-icon-us' }}"></i>
            </div>
            <ul tabindex="0" class="menu menu-sm dropdown-content z-[999] p-2 shadow bg-base-100 rounded-box w-40">
                <li><a href="{{ route('lang.switch', 'en') }}">English</a></li>
                <li><a href="{{ route('lang.switch', 'ar') }}">العربية</a></li>
            </ul>
        </div> --}}
    </div>

</div>
