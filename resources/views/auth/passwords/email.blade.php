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
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <p class="h5 fw-semibold mb-2 text-center">{{ __('module.auth.reset_password') }}</p>
                        <form action="{{ route('password.email') }}" method="POST">
                            @csrf
                            <div class="row gy-3">
                                <div class="col-xl-12">
                                    <label for="signin-email" class="form-label text-default">
                                        {{ __('module.auth.email') }}
                                    </label>
                                    <input type="text" class="form-control form-control-lg" id="signin-email"
                                        name="email" placeholder="{{ __('module.auth.email_placeholder') }}">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-xl-12 d-flex justify-content-between">
                                    <a href="{{ route('login') }}"
                                        class="btn btn-sm btn-dark">{{ __('module.auth.back') }}</a>
                                    <button type="submit"
                                        class="btn btn-sm btn-primary">{{ __('module.auth.send_reset_password_link') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
