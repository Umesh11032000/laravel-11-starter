@use('\App\Models\Language')
@php
    $locales = Language::select('id', 'native_name', 'code', 'icon')->get()->toArray();

    $currentLocale = app()->getLocale();

    // Sort the locales by the current locale
    usort($locales, function ($a, $b) use ($currentLocale) {
        if ($a['code'] === $currentLocale) {
            return -1;
        }
        if ($b['code'] === $currentLocale) {
            return 1;
        }
        return 0;
    });
@endphp

<div class="header-element country-selector">
    <a href="javascript:void(0);" class="header-link dropdown-toggle" data-bs-auto-close="outside"
        data-bs-toggle="dropdown">
        {{ $locales[0]['icon'] }} {{ $locales[0]['native_name'] }}
    </a>
    <ul class="main-header-dropdown dropdown-menu dropdown-menu-end" data-popper-placement="none">
        @foreach ($locales as $locale => $data)
            <li>
                <a class="dropdown-item d-flex align-items-center" href="{{ route('lang.swap', $data['code']) }}">
                    {{ $data['icon'] }}
                    {{ $data['native_name'] }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
