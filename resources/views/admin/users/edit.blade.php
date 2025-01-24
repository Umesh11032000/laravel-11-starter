@use('\App\Enums\Gender')
@extends('admin.layouts.app')

@section('content')
    <!-- Page Header -->
    @include('admin.layouts.partials.page-header', [
        'title' => 'Update User',
        'breadcrumb' => [
            'Home' => route('admin.dashboard.index'),
            'Users' => route('admin.users.index'),
        ],
    ])

    <!-- Create User Form -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="card-title">
                        {{ __('module.user.update_user') }}
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.users.update', $user) }}" method="POST" id="create-user-form">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="id" value="{{ $user->id }}" id="id">

                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="first_name">
                                        {{ Str::title(__('module.user.first_name')) }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="first_name" id="first_name" class="form-control"
                                        value="{{ old('first_name', $user->first_name) }}"
                                        placeholder="{{ Str::title(__('module.user.first_name')) }}">
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-12">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="middle_name">
                                        {{ Str::title(__('module.user.middle_name')) }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="middle_name" id="middle_name" class="form-control"
                                        value="{{ old('middle_name', $user->middle_name) }}"
                                        placeholder="{{ Str::title(__('module.user.middle_name')) }}">
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-12">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="last_name">
                                        {{ Str::title(__('module.user.last_name')) }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="last_name" id="last_name" class="form-control"
                                        value="{{ old('last_name', $user->last_name) }}"
                                        placeholder="{{ Str::title(__('module.user.last_name')) }}">
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-12">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="email">
                                        {{ Str::title(__('module.user.email')) }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        value="{{ old('email', $user->email) }}"
                                        placeholder="{{ Str::title(__('module.user.email')) }}">
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-12">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="mobile_number">
                                        {{ Str::title(__('module.user.mobile_number')) }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="mobile_number" id="mobile_number" class="form-control"
                                        value="{{ old('mobile_number', $user->mobile_number) }}"
                                        placeholder="{{ Str::title(__('module.user.mobile_number')) }}">
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-12">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="gender">
                                        {{ Str::title(__('module.user.gender')) }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="d-flex flex-wrap align-items-center">
                                        @foreach (Gender::options() as $key => $value)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender"
                                                    id="{{ $key }}" value="{{ $key }}"
                                                    {{ old('gender', $user->gender) == $key ? 'checked' : '' }}>
                                                <label class="form-check-label" for="{{ $key }}"
                                                    style="cursor: pointer;">
                                                    {{ $value }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-12">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="role_id">
                                        {{ Str::title(__('module.user.role')) }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="role_id" id="role_id" class="form-select">
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-12">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="date_of_birth">
                                        {{ Str::title(__('module.user.date_of_birth')) }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="date_of_birth" id="date_of_birth" class="form-control"
                                        value="{{ old('date_of_birth', $user->date_of_birth) }}"
                                        placeholder="{{ Str::title(__('module.user.date_of_birth')) }}">
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-12">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="state_id">
                                        {{ Str::title(__('module.user.state')) }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="state_id" id="state_id" class="form-select">
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-12">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="city_id">
                                        {{ Str::title(__('module.user.city')) }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="city_id" id="city_id" class="form-select">
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-12">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="address">
                                        {{ Str::title(__('module.user.address')) }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <textarea name="address" id="address" class="form-control"
                                        placeholder="{{ Str::title(__('module.user.address')) }}">{{ old('address', $user->address) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-sm btn-primary d-flex align-items-center"
                        onclick="$('#create-user-form').submit();">
                        <i class="bx bx-check bx-xs me-2"></i>
                        {{ __('module.user.update_user') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="module">
        $(document).ready(function() {
            $('#role_id').select2({
                placeholder: "{{ __('module.user.select_role') }}",
                allowClear: true,
                ajax: {
                    url: '{{ route('admin.select2.roles') }}',
                    dataType: 'json',
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    }
                }
            });

            $('#state_id').select2({
                placeholder: 'Select State',
                allowClear: true,
                ajax: {
                    url: "{{ route('admin.select2.states') }}",
                    dataType: 'json',
                    method: 'POST',
                    data: function(params) {
                        return {
                            search: params.term,
                            _token: '{{ csrf_token() }}'
                        }
                    },
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    }
                }
            });

            $('#city_id').select2({
                placeholder: 'Select City',
                allowClear: true,
                ajax: {
                    url: "{{ route('admin.select2.cities') }}",
                    dataType: 'json',
                    method: 'POST',
                    data: function(params) {
                        return {
                            _token: '{{ csrf_token() }}',
                            state_id: $('#state_id').val(),
                            search: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    }
                }
            });

            $('#date_of_birth').daterangepicker({
                singleDatePicker: true,
                locale: {
                    format: 'YYYY-MM-DD'
                },
            });

            const currentRole = @json($user->currentRole() ?? []);
            console.log(currentRole);
            if (currentRole) {
                const option = new Option(currentRole.name, currentRole.id, true, true);
                $('#role_id').append(option).trigger('change');
            }

            const currentState = @json($user->state ?? []);
            if (currentState) {
                const option = new Option(currentState.name, currentState.id, true, true);
                $('#state_id').append(option).trigger('change');
            }

            const currentCity = @json($user->city ?? []);
            if (currentCity) {
                const option = new Option(currentCity.name, currentCity.id, true, true);
                $('#city_id').append(option).trigger('change');
            }
        });
    </script>

    @include('admin.validations.users.create')
@endpush
