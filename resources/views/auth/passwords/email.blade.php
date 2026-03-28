@extends('layouts.auth')

@section('title', __('Reset password'))

@section('auth_brand_text')
    {{ __('Forgot your password? We will send you a secure link to choose a new one.') }}
@endsection

@section('content')
    <a href="{{ route('login') }}" class="auth-back">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 18l-6-6 6-6"/></svg>
        {{ __('Back to sign in') }}
    </a>

    <h2>{{ __('Reset password') }}</h2>
    <p class="auth-sub">{{ __('Enter your email address and we will send you a link to set a new password.') }}</p>

    @if (session('status'))
        <div class="alert alert-success alert-auth" role="alert">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" novalidate>
        @csrf

        <div class="auth-field auth-field--bottom-gap">
            <label for="email">{{ __('Email') }}</label>
            <div class="auth-input-wrap">
                <svg class="auth-input-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="you@example.com"
                    required
                    autocomplete="email"
                    autofocus
                    class="@error('email') is-invalid @enderror"
                    aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}"
                >
            </div>
            @error('email')
                <span class="invalid-feedback text-danger" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="auth-submit">{{ __('Send reset link') }}</button>
    </form>

    <div class="auth-footer">
        {{ __('Remember your password?') }}
        <a href="{{ route('login') }}">{{ __('Sign in') }}</a>
    </div>
@endsection
