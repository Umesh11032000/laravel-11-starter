@use('App\Helpers\Helper')
@php
    $causer = $q->causer->full_name ?? '-';
    $action = $q->description;
    $subjectType = $q->subject_type;
    $module = Helper::moduleNameByModelClass($subjectType);
    $color = '';
    switch ($action) {
        case 'created':
            $color = 'success';
            break;

        case 'updated':
            $color = 'warning';
            break;

        case 'deleted':
            $color = 'danger';
            break;

        case 'restored':
            $color = 'info';
            break;

        case 'force deleted':
            $color = 'danger';
            break;

        default:
            $color = 'secondary';
            break;
    }
@endphp

<p class="mb-0">
    <span class="font-weight-bold"> {{ $causer }} </span>
    <span class="text-{{ $color }}"> {{ $action }} </span>
    the
    <span class="font-weight-bold"> {{ $module }} </span>
</p>
