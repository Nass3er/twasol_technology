@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@php( $dashboard_url = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'home') )

@if (config('adminlte.use_route_url', false))
    @php( $dashboard_url = $dashboard_url ?? '' )
@else
    @php( $dashboard_url = $dashboard_url ? url($dashboard_url) : '' )
@endif

<a href="{{ localizedRoute($dashboard_url) }}"
    @if($layoutHelper->isLayoutTopnavEnabled())
        class="navbar-brand {{ config('adminlte.classes_brand') }}"
    @else
        class="brand-link {{ config('adminlte.classes_brand') }}"
    @endif>

    {{-- Brand logo --}}
    <img src="{{ asset(config('adminlte.logo_img', 'images/twasol_logo.png')) }}"
         alt="{{ config('adminlte.logo_img_alt', 'Twasol Technology') }}"
         class="brand-image"
         style="max-height: 33px; object-fit: contain;">

    {{-- Brand text --}}
    <span class="brand-text font-weight-bold {{ config('adminlte.classes_brand_text') }}">
        {!! config('adminlte.logo', '<b>Twasol</b> Tech') !!}
    </span>

</a>
