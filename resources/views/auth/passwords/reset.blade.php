@extends('layouts.guest')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center authentication authentication-basic h-100">
            <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-6 col-sm-8 col-12">
                <div class="my-5 d-flex justify-content-center">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('assets/images/brand-logos/desktop-logo.png') }}" alt="logo"
                            class="desktop-logo">
                        <img src="{{ asset('assets/images/brand-logos/desktop-dark.png') }}" alt="logo"
                            class="desktop-dark">
                    </a>
                </div>
                <div class="card custom-card">
                    <div class="card-body p-5">
                        <p class="h5 fw-semibold mb-2 text-center">{{ __('module.auth.sign_in') }}</p>
                        <form action="{{ route('password.update') }}" method="POST" id="resetPasswordForm">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="row gy-3">
                                <div class="col-xl-12">
                                    <label for="signin-email" class="form-label text-default">
                                        {{ __('module.auth.email') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control form-control-lg" id="signin-email"
                                        name="email" placeholder="{{ __('module.auth.email_placeholder') }}"
                                        value="{{ $email ?? old('email') }}" readonly>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-xl-12 mb-2">
                                    <label for="signin-password" class="form-label text-default d-block">
                                        {{ __('module.auth.password') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="{{ __('module.auth.password') }}" autocomplete="current-password">
                                        <span class="input-group-text cursor-pointer"
                                            onclick="togglePassword('password', this)">
                                            <i class="bi bi-eye-slash-fill"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-xl-12 mb-2">
                                    <label for="password-confirm" class="form-label text-default d-block">
                                        {{ __('module.auth.confirm_password') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password-confirm"
                                            name="password_confirmation" placeholder="{{ __('module.auth.password') }}"
                                            autocomplete="current-password">
                                        <span class="input-group-text cursor-pointer"
                                            onclick="togglePassword('password-confirm', this)">
                                            <i class="bi bi-eye-slash-fill"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-xl-12 d-grid mt-2">
                                    <button type="submit"
                                        class="btn btn-lg btn-primary">{{ __('module.auth.reset_password') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    @include('admin.validations.auth.password-reset')
@endpush
