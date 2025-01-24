@use('\App\Enums\Gender')
@extends('admin.layouts.app')

@section('content')
    <!-- Page Header -->
    @include('admin.layouts.partials.page-header', [
        'title' => 'Create Role',
        'breadcrumb' => [
            'Home' => route('admin.dashboard.index'),
            'Roles' => route('admin.roles.index'),
        ],
    ])

    @include('admin.layouts.partials.alert')

    <!-- Create Role Form -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="card-title">
                        {{ __('module.role.create_role') }}
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.roles.store') }}" method="POST" id="create-role-form">
                        @csrf

                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="name">
                                        {{ __('module.role.name') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ old('name') }}" placeholder="{{ __('module.role.name') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            @foreach ($permissions as $collection => $permission)
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="name">
                                            {{ Str::title($collection) }}
                                        </label>
                                        <div class="d-flex flex-wrap align-items-center gap-3">
                                            @foreach ($permission as $key => $value)
                                                <div class="form-check">
                                                    <input class="form-check-input border-primary" type="checkbox"
                                                        name="permissions[]" value="{{ $value->id }}"
                                                        id="permission-{{ $value->id }}">
                                                    <label class="form-check-label" for="permission-{{ $value->id }}"
                                                        style="cursor: pointer;">
                                                        {{ $value->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-sm btn-primary d-flex align-items-center"
                        onclick="$('#create-role-form').submit();">
                        <i class="bx bx-check bx-xs me-2"></i>
                        {{ __('module.role.create_role') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @include('admin.validations.roles.create')
@endpush
