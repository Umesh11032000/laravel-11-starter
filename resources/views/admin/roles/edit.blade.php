@use('\App\Enums\Gender')
@extends('admin.layouts.app')

@section('content')
    <!-- Page Header -->
    @include('admin.layouts.partials.page-header', [
        'title' => 'Update User',
        'breadcrumb' => [
            'Home' => route('admin.dashboard.index'),
            'Users' => route('admin.roles.index'),
        ],
    ])

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @include('admin.layouts.partials.alert')

    <!-- Create User Form -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="card-title">
                        {{ __('module.role.update_role') }}
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.roles.update', $role) }}" method="POST" id="create-role-form">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="id" value="{{ $role->id }}" id="id">

                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="name">
                                        {{ __('module.role.name') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ old('name', $role->name) }}" placeholder="First Name">
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
                                                        id="permission-{{ $value->id }}"
                                                        {{ in_array($value->id, $role->permissions->pluck('id')->toArray()) ? 'checked' : '' }}>
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
                        {{ __('module.role.update_role') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @include('admin.validations.roles.edit')
@endpush
