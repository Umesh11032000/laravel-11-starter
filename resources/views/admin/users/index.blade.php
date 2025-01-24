@use('\App\Enums\UserStatus')
@extends('admin.layouts.app')

@section('content')
    <!-- Page Header -->
    @include('admin.layouts.partials.page-header', [
        'title' => 'Users',
        'breadcrumb' => [
            'Home' => route('admin.dashboard.index'),
            'Users' => route('admin.users.index'),
        ],
    ])

    @include('admin.layouts.partials.alert')

    <!-- Filter -->
    <div class="row collapse" id="filter-canvas">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="card-title">
                        {{ __('module.user.filter_users') }}
                    </div>
                    <div class="d-flex align-items-center justify-content-end flex-wrap">
                        <a data-bs-toggle="collapse" href="#filter-canvas" role="button" aria-expanded="false"
                            aria-controls="filter-canvas" class="text-danger d-flex align-items-center">
                            <i class="bx bx-x bx-sm"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <label for="status">
                                    {{ __('module.user.status') }}
                                </label>
                                <select name="status" id="status" class="form-select form-select2">
                                    <option value="">All</option>
                                    @foreach (UserStatus::options() as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <label for="date_range">
                                    {{ __('module.user.date_range') }}
                                </label>
                                <input type="text" name="date_range" id="date_range" class="form-control"
                                    placeholder="{{ __('module.user.date_range') }}" autocomplete="off" value="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-sm btn-primary d-flex align-items-center" onclick="showTable()">
                        <i class="bx bx-check bx-xs me-2"></i>
                        {{ __('module.user.filter') }}
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="card-title">
                        {{ __('module.user.manage_users') }}
                    </div>
                    <div class="btn-canvas d-flex align-items-center justify-content-end flex-wrap">
                        <div class="action-buttons flex-wrap btn-group-sm">
                            @if (auth()->user()->hasPermissionTo('create-update-user'))
                                <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-primary">
                                    <span class="d-flex align-items-center">
                                        <i class="bx bx-plus bx-xs"></i>
                                        {{ __('module.user.create_user') }}
                                    </span>
                                </a>
                            @endif
                            <a data-bs-toggle="collapse" href="#filter-canvas" role="button" aria-expanded="false"
                                aria-controls="filter-canvas" class="btn btn-sm btn-dark">
                                <span class="d-flex align-items-center">
                                    <i class="bx bx-filter bx-xs"></i>
                                    {{ __('module.user.filter') }}
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        {{ $dataTable->table([
                            'class' => 'w-100 table-striped table-hover table-bordered',
                        ]) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script type="module">
        $(document).ready(function() {
            $('#users-table').on('preXhr.dt', function(e, settings, data) {
                var status = $('#status').val();
                var dateRange = $('#date_range').val();

                var startDate = '';
                var endDate = '';

                if (dateRange) {
                    var dates = dateRange.split(' - ');
                    startDate = dates[0];
                    endDate = dates[1];
                }

                data['status'] = $('#status').val();
                data['startDate'] = startDate;
                data['endDate'] = endDate;
            });

            window.showTable = function() {
                window.LaravelDataTables["users-table"].draw();
            }

            // Date Range Picker
            $('#date_range').daterangepicker({
                locale: daterangeLocale,
                showDropdowns: true,
                autoUpdateInput: false,
                ranges: {
                    "{{ __('module.dashboard.today') }}": [moment(), moment()],
                    "{{ __('module.dashboard.yesterday') }}": [moment().subtract(1, 'days'), moment()
                        .subtract(1,
                            'days')
                    ],
                    "{{ __('module.dashboard.last_7_days') }}": [moment().subtract(7, 'days'), moment()],
                    "{{ __('module.dashboard.last_30_days') }}": [moment().subtract(30, 'days'), moment()],
                    "{{ __('module.dashboard.this_month') }}": [moment().startOf('month'), moment().endOf(
                        'month')],
                    "{{ __('module.dashboard.last_month') }}": [moment().subtract(1, 'month').startOf(
                            'month'),
                        moment().subtract(1, 'month').endOf('month')
                    ]
                },
                maxDate: moment(),
            });

            $('#date_range').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format(
                    'YYYY-MM-DD'));
            });
        });
    </script>
@endpush
