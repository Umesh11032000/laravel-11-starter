@extends('admin.layouts.app')

@section('content')
    <!-- Page Header -->
    @include('admin.layouts.partials.page-header', [
        'title' => 'Dashboard',
        'breadcrumb' => [
            'Home' => route('admin.dashboard.index'),
        ],
    ])

    <div class="row">
        <!-- Total Users -->
        <x-dashboard-widget icon="bx bx-group" title="{{ __('module.dashboard.total_users') }}"
            value="{{ $usersCounts->total_users }}" bg-color="primary" />

        <!-- Total Active Users -->
        <x-dashboard-widget icon="bx bx-user-check" title="{{ __('module.dashboard.total_active_users') }}"
            value="{{ $usersCounts->active_users }}" bg-color="success" />

        <!-- Total Inactive Users -->
        <x-dashboard-widget icon="bx bx-user-x" title="{{ __('module.dashboard.total_inactive_users') }}"
            value="{{ $usersCounts->inactive_users }}" bg-color="danger" />

        <!-- Dynamic Widgets for Roles -->
        @foreach ($roles as $role)
            <x-dashboard-widget icon="bx bx-id-card"
                title="{{ __('module.dashboard.total_role_users', ['role' => $role->name]) }}"
                value="{{ $role->users_count ?? 0 }}" bg-color="{{ $loop->iteration % 2 === 0 ? 'primary' : 'success' }}" />
        @endforeach
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card custom-card">
                <!-- Chart Filters -->
                <div class="card-header justify-content-between">
                    <div class="card-title mb-2 mb-sm-0">
                        {{ __('module.dashboard.user_registrations_chart') }}
                    </div>
                    <div class="form-group m-0 d-flex align-items-center">
                        <input type="text" class="form-control form-control-sm filter-date-range"
                            placeholder="Select Date" data-input>
                    </div>
                </div>

                <!-- Chart Container -->
                <div id="users-registrations-chart"></div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="module">
        var chart = new ApexCharts(document.querySelector("#users-registrations-chart"), {
            series: [{
                name: "{{ __('module.dashboard.user_registrations') }}",
                data: []
            }],
            chart: {
                height: 450,
                animations: {
                    speed: 500
                },
                dropShadow: {
                    enabled: true,
                    enabledOnSeries: undefined,
                    top: 8,
                    left: 0,
                    blur: 3,
                    color: '#000',
                    opacity: 0.1
                },
            },
            colors: ["rgb(132, 90, 223)", "rgba(35, 183, 229, 0.85)", "rgba(119, 119, 142, 0.05)"],
            dataLabels: {
                enabled: false
            },
            grid: {
                borderColor: '#f1f1f1',
                strokeDashArray: 3
            },
            stroke: {
                curve: 'smooth',
                width: [2, 2, 0],
                dashArray: [0, 5, 0],
            },
            xaxis: {
                axisTicks: {
                    show: false,
                },
            },
            yaxis: {
                labels: {
                    formatter: function(value) {
                        return value;
                    }
                },
            },
            legend: {
                show: true,
                customLegendItems: ["{{ __('module.dashboard.user_registrations') }}"],
                inverseOrder: true
            },
            title: {
                text: "{{ __('module.dashboard.user_registrations') }}",
                align: 'left',
                style: {
                    fontSize: '.8125rem',
                    fontWeight: 'semibold',
                    color: '#8c9097'
                },
            },
            markers: {
                hover: {
                    sizeOffset: 5
                }
            }
        });

        chart.render();

        // Fetch data and update the chart based on the selected filter
        function updateChart(startDate = null, endDate = null) {
            $.ajax({
                url: "{{ route('admin.dashboard.users-registrations') }}",
                data: {
                    startDate: startDate,
                    endDate: endDate
                },
                success: function(response) {
                    var categories = [];
                    var data = [];

                    // Prepare the data from the response
                    response.forEach(function(item) {
                        categories.push(item.category); // Adjust this field based on your data
                        data.push(item.count); // Adjust this field based on your data
                    });

                    // Update chart options
                    chart.updateOptions({
                        xaxis: {
                            categories: categories
                        }
                    });

                    // Update chart series data
                    chart.updateSeries([{
                        data: data
                    }]);
                }
            });
        }

        // Initial chart load with default filter
        updateChart();

        // Date Range Picker
        $('.filter-date-range').daterangepicker({
            maxSpan: {
                days: 30
            },
            singleDatePicker: false,
            showDropdowns: true,
            locale: daterangeLocale,
            ranges: {
                "{{ __('module.dashboard.today') }}": [moment(), moment()],
                "{{ __('module.dashboard.yesterday') }}": [moment().subtract(1, 'days'), moment().subtract(1,
                    'days')],
                "{{ __('module.dashboard.last_7_days') }}": [moment().subtract(7, 'days'), moment()],
                "{{ __('module.dashboard.last_30_days') }}": [moment().subtract(30, 'days'), moment()],
                "{{ __('module.dashboard.this_month') }}": [moment().startOf('month'), moment().endOf('month')],
                "{{ __('module.dashboard.last_month') }}": [moment().subtract(1, 'month').startOf('month'),
                    moment().subtract(1, 'month').endOf('month')
                ]
            },
            startDate: moment().subtract(30, 'days'),
            endDate: moment(),
            defaultDate: [moment().subtract(30, 'days'), moment()],
            maxDate: moment()
        }, function(start, end, label) {
            var startDate = start.format('YYYY-MM-DD');
            var endDate = end.format('YYYY-MM-DD');

            // Update the chart with the selected date range
            updateChart(startDate, endDate);
        });
    </script>
@endpush
