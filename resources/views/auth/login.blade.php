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
                <div class="card custom-card shadow-lg">
                    <div class="card-body p-5">
                        <p class="h5 fw-semibold mb-2 text-center">{{ __('module.auth.sign_in') }}</p>
                        <form action="{{ route('login') }}" method="POST" id="loginForm">
                            @csrf
                            <div class="row gy-3">
                                <div class="col-xl-12">
                                    <label for="signin-email"
                                        class="form-label text-default">
                                        {{ __('module.auth.email') }}
                                    </label>
                                    <input type="text" class="form-control form-control-lg" id="signin-email"
                                        name="email" placeholder="{{ __('module.auth.email_placeholder') }}">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span> 
                                    @enderror
                                </div>
                                <div class="col-xl-12 mb-2">
                                    <label for="signin-password" class="form-label text-default d-block">
                                        {{ __('module.auth.password') }}
                                        <a href="{{ route('password.request') }}" class="float-end text-danger">
                                            {{ __('module.auth.forgot_password') }}
                                        </a>
                                    </label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="{{ __('module.auth.password') }}" autocomplete="current-password">
                                        <span class="input-group-text cursor-pointer"
                                            onclick="togglePassword('password', this)">
                                            <i class="bi bi-eye-slash-fill"></i>
                                        </span>
                                    </div>
                                    <div class="mt-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input border-primary cursor-pointer" type="checkbox" value="1"
                                                id="rember-me" name="remember">
                                            <label class="form-check-label text-muted fw-normal cursor-pointer" for="rember-me">
                                                {{ __('module.auth.remember_password') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12 d-flex justify-content-center">
                                    <button type="submit"
                                        class="btn btn-sm btn-primary">{{ __('module.auth.sign_in') }}</button>
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
    @include('admin.validations.auth.login')
@endpush