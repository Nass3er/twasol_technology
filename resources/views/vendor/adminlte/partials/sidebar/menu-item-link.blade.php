@isset($item['route'])
    @php
        if (is_array($item['route'])) {
            $routeName = $item['route'][0]; // first element = route name
            $routePara = $item['route'][1] ?? []; // second element = parameters
        } else {
            $routeName = $item['route']; // first element = route name
            $routePara = null; // second element = parameters
        }
    @endphp
@endisset

<li @isset($item['id']) id="{{ $item['id'] }}" @endisset class="nav-item">

    <a class="nav-link {{ $item['class'] }} @isset($item['shift']) {{ $item['shift'] }} @endisset"
        @if (isset($routePara)) href="{{ localizedRoute($routeName, $routePara) }}" 
    @else
    href="{{ localizedRoute($routeName) }}" @endif
        @isset($item['target']) target="{{ $item['target'] }}" @endisset {!! $item['data-compiled'] ?? '' !!}>

        <i
            class="{{ $item['icon'] ?? 'far fa-fw fa-circle' }} {{ isset($item['icon_color']) ? 'text-' . $item['icon_color'] : '' }}"></i>

        <p>
            {{ __('adminlte::adminlte.' . $item['text']) !== 'adminlte::adminlte.' . $item['text'] ? __('adminlte::adminlte.' . $item['text']) : $item['text'] }}

            @isset($item['label'])
                <span class="badge badge-{{ $item['label_color'] ?? 'primary' }} right">
                    {{ $item['label'] }}
                </span>
            @endisset
        </p>

    </a>

</li>
