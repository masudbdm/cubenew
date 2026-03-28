@extends('layouts.auth')

@section('title', __('Confirm password'))

@section('auth_brand_text')
    {{ __('For your security, please confirm your password before continuing.') }}
@endsection

@section('content')
    <a href="{{ url('/') }}" class="auth-back">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 18l-6-6 6-6"/></svg>
        {{ __('Back to site') }}
    </a>

    <h2>{{ __('Confirm password') }}</h2>
    <p class="auth-intro">{{ __('Please enter your password to continue to this protected area.') }}</p>

    <form method="POST" action="{{ route('password.confirm') }}" novalidate>
        @csrf

        <div class="auth-field auth-field--bottom-gap">
            <label for="password">{{ __('Password') }}</label>
            <div class="auth-input-wrap auth-input-wrap--password">
                <svg class="auth-input-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                <input
                    id="password"
                    type="password"
                    name="password"
                    placeholder="••••••••"
                    required
                    autocomplete="current-password"
                    autofocus
                    class="@error('password') is-invalid @enderror"
                    aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}"
                >
                @include('auth.partials.password-toggle')
            </div>
            @error('password')
                <span class="invalid-feedback text-danger" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="auth-submit">{{ __('Confirm') }}</button>
    </form>

    @if (Route::has('password.request'))
        <div class="auth-footer">
            <a href="{{ route('password.request') }}">{{ __('Forgot password?') }}</a>
        </div>
    @endif
@endsection
