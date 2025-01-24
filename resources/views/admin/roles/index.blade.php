@use('\App\Enums\UserStatus')
@extends('admin.layouts.app')

@section('content')
    <!-- Page Header -->
    @include('admin.layouts.partials.page-header', [
        'title' => 'Roles',
        'breadcrumb' => [
            'Home' => route('admin.dashboard.index'),
            'Roles' => route('admin.roles.index'),
        ],
    ])

    @include('admin.layouts.partials.alert')

    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="card-title">
                        {{ __('module.role.manage_roles') }}
                    </div>
                    <div class="btn-canvas d-flex align-items-center justify-content-end flex-wrap">
                        <div class="action-buttons flex-wrap btn-group-sm">
                            <a href="{{ route('admin.roles.create') }}" class="btn btn-sm btn-primary">
                                <span class="d-flex align-items-center">
                                    <i class="bx bx-plus bx-xs"></i>
                                    {{ __('module.role.create_role') }}
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
@endpush
