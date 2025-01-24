@use('Illuminate\Support\Str')

<div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
    <h1 class="page-title fw-semibold fs-18 mb-0">
        {{ $title ?? '' }}
    </h1>
    <div class="ms-md-1 ms-0">
        <nav>
            <ol class="breadcrumb mb-0">
                @foreach ($breadcrumb as $key => $value)
                    <li class="breadcrumb-item {{ $key == count($breadcrumb) - 1 ? 'active' : '' }}">
                        <a href="{{ $value }}">{{ Str::title($key) }}</a>
                    </li>   
                @endforeach
            </ol>
        </nav>
    </div>
</div>
