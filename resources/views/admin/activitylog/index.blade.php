@use('\App\Enums\UserStatus')
@extends('admin.layouts.app')

@section('content')
    <!-- Page Header -->
    @include('admin.layouts.partials.page-header', [
        'title' => 'Activities',
        'breadcrumb' => [
            'Home' => route('admin.dashboard.index'),
            'Activities' => route('admin.activities.index'),
        ],
    ])

    @include('admin.layouts.partials.alert')

    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="card-title">
                        {{ __('module.activitylog.activity_logs') }}
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
@endpush
