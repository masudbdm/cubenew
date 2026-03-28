@extends('layouts.auth')

@section('title', __('Login'))

@section('content')
    <a href="{{ url('/') }}" class="auth-back">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 18l-6-6 6-6"/></svg>
        {{ __('Back to site') }}
    </a>

    <h2>{{ __('Welcome back') }}</h2>
    <p class="auth-sub">{{ __('Enter your credentials to access your account.') }}</p>

    @if (session('status'))
        <div class="alert alert-success alert-auth" role="alert">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}" novalidate>
        @csrf

        <div class="auth-field">
            <label for="email">{{ __('Email') }}</label>
            <div class="auth-input-wrap">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
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

        <div class="auth-field">
            <label for="password">{{ __('Password') }}</label>
            <div class="auth-input-wrap">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                <input
                    id="password"
                    type="password"
                    name="password"
                    placeholder="••••••••"
                    required
                    autocomplete="current-password"
                    class="@error('password') is-invalid @enderror"
                    aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}"
                >
            </div>
            @error('password')
                <span class="invalid-feedback text-danger" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <div class="auth-remember">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">{{ __('Remember me') }}</label>
            </div>
            @if (Route::has('password.request'))
                <a class="auth-forgot" href="{{ route('password.request') }}">{{ __('Forgot password?') }}</a>
            @endif
        </div>

        <button type="submit" class="auth-submit">{{ __('Sign in') }}</button>
    </form>

    @if (Route::has('register'))
        <div class="auth-footer">
            {{ __('No account?') }}
            <a href="{{ route('register') }}">{{ __('Create one') }}</a>
        </div>
    @endif
@endsection
