<li @isset($item['id']) id="{{ $item['id'] }}" @endisset class="nav-header {{ $item['class'] ?? '' }}">

    @php
        $headerText = is_string($item) ? $item : $item['header'];
        $translated = __('adminlte::adminlte.' . $headerText);
        echo $translated !== 'adminlte::adminlte.' . $headerText ? $translated : $headerText;
    @endphp

</li>
