@extends('layouts.auth')

@section('title', __('Set new password'))

@section('auth_brand_text')
    {{ __('Choose a strong password to keep your account safe.') }}
@endsection

@section('content')
    <a href="{{ route('login') }}" class="auth-back">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 18l-6-6 6-6"/></svg>
        {{ __('Back to sign in') }}
    </a>

    <h2>{{ __('Set new password') }}</h2>
    <p class="auth-sub">{{ __('Enter a new password for your account.') }}</p>

    <form method="POST" action="{{ route('password.update') }}" novalidate>
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="auth-field">
            <label for="email">{{ __('Email') }}</label>
            <div class="auth-input-wrap">
                <svg class="auth-input-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ $email ?? old('email') }}"
                    required
                    autocomplete="email"
                    @if (! empty($email ?? old('email'))) readonly @endif
                    class="@error('email') is-invalid @enderror"
                    aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}"
                >
            </div>
            @error('email')
                <span class="invalid-feedback text-danger" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <div class="auth-field">
            <label for="password">{{ __('New password') }}</label>
            <div class="auth-input-wrap auth-input-wrap--password">
                <svg class="auth-input-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                <input
                    id="password"
                    type="password"
                    name="password"
                    placeholder="••••••••"
                    required
                    autocomplete="new-password"
                    class="@error('password') is-invalid @enderror"
                    aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}"
                >
                @include('auth.partials.password-toggle')
            </div>
            @error('password')
                <span class="invalid-feedback text-danger" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <div class="auth-field auth-field--bottom-gap">
            <label for="password-confirm">{{ __('Confirm new password') }}</label>
            <div class="auth-input-wrap auth-input-wrap--password">
                <svg class="auth-input-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                <input
                    id="password-confirm"
                    type="password"
                    name="password_confirmation"
                    placeholder="••••••••"
                    required
                    autocomplete="new-password"
                >
                @include('auth.partials.password-toggle')
            </div>
        </div>

        <button type="submit" class="auth-submit">{{ __('Update password') }}</button>
    </form>

    <div class="auth-footer">
        <a href="{{ route('login') }}">{{ __('Back to sign in') }}</a>
    </div>
@endsection
