@include('daisyUI.drawer') 
{{-- <div class="dropdown ">
    <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
        </svg>
    </div>
    <ul class="menu menu-sm dropdown-content bg-base-100 rounded-box z-1 mt-3 w-52 p-2 shadow">
        <li><a href='/'>{{ __('adminlte::landingpage.home') }}</a></li>
        <li>
            <details close>
                <summary>{{ __('adminlte::landingpage.salesAndMarketing') }}</summary>
                <ul class="p-2">
                    <li><a href={{ route('lang.switch', 'en') }}>{{ __('adminlte::landingpage.products') }}</a>
                    </li>
                    <li><a href={{ route('lang.switch', 'ar') }}>{{ __('adminlte::landingpage.branches') }}</a>
                    </li>
                    <li><a
                            href={{ route('lang.switch', 'ar') }}>{{ __('adminlte::landingpage.customerservice') }}</a>
                    </li>
                    <li><a
                            href={{ route('lang.switch', 'ar') }}>{{ __('adminlte::landingpage.suggestionsAndComplaints') }}</a>
                    </li>
                </ul>
            </details>
        </li>
        <li><a href='/aboutus'>{{ __('adminlte::adminlte.aboutus') }}</a></li>
    </ul>
</div> --}}