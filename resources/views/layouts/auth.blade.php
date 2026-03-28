<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', __('Login')) — {{ config('app.name', 'Laravel') }}</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        :root {
            --auth-bg-1: #0f172a;
            --auth-bg-2: #1e293b;
            --auth-accent: #38bdf8;
            --auth-accent-2: #818cf8;
            --auth-card: rgba(255, 255, 255, 0.98);
            --auth-muted: #64748b;
            --auth-input-bg: #f8fafc;
            --auth-radius: 1rem;
            --auth-radius-sm: 0.75rem;
        }
        .auth-page {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            min-height: 100dvh;
            min-height: -webkit-fill-available;
            display: flex;
            flex-direction: column;
            background: var(--auth-bg-1);
            background-image:
                radial-gradient(ellipse 120% 80% at 100% 0%, rgba(56, 189, 248, 0.18) 0%, transparent 50%),
                radial-gradient(ellipse 100% 60% at 0% 100%, rgba(129, 140, 248, 0.2) 0%, transparent 45%),
                linear-gradient(165deg, var(--auth-bg-1) 0%, var(--auth-bg-2) 100%);
            color: #e2e8f0;
            padding: max(1rem, env(safe-area-inset-top)) max(1rem, env(safe-area-inset-right)) max(1rem, env(safe-area-inset-bottom)) max(1rem, env(safe-area-inset-left));
        }
        .auth-shell {
            flex: 1;
            display: flex;
            flex-direction: column;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }
        @media (min-width: 992px) {
            .auth-shell {
                flex-direction: row;
                align-items: stretch;
                gap: 0;
                border-radius: var(--auth-radius);
                overflow: hidden;
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.45);
                min-height: min(640px, calc(100dvh - 2rem));
            }
        }
        .auth-brand {
            display: none;
            flex: 1;
            padding: 3rem;
            flex-direction: column;
            justify-content: center;
            background: linear-gradient(145deg, rgba(15, 23, 42, 0.6) 0%, rgba(30, 41, 59, 0.4) 100%);
            border-right: 1px solid rgba(148, 163, 184, 0.12);
        }
        @media (min-width: 992px) {
            .auth-brand {
                display: flex;
            }
        }
        .auth-brand h1 {
            font-size: clamp(1.75rem, 3vw, 2.25rem);
            font-weight: 700;
            letter-spacing: -0.02em;
            line-height: 1.2;
            margin-bottom: 0.75rem;
        }
        .auth-brand p {
            color: #94a3b8;
            font-size: 1rem;
            line-height: 1.6;
            max-width: 28ch;
        }
        .auth-brand-dots {
            display: flex;
            gap: 0.5rem;
            margin-top: 2rem;
        }
        .auth-brand-dots span {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--auth-accent);
            opacity: 0.6;
        }
        .auth-brand-dots span:nth-child(2) { background: var(--auth-accent-2); opacity: 0.8; }
        .auth-brand-dots span:nth-child(3) { background: #c4b5fd; opacity: 0.5; }
        .auth-panel {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 0;
        }
        @media (min-width: 992px) {
            .auth-panel {
                background: var(--auth-card);
                padding: 2.5rem 3rem;
            }
        }
        .auth-card {
            width: 100%;
            max-width: 400px;
            background: var(--auth-card);
            border-radius: var(--auth-radius);
            padding: 1.75rem 1.5rem;
            box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.35);
        }
        @media (min-width: 992px) {
            .auth-card {
                background: transparent;
                box-shadow: none;
                padding: 0;
                max-width: 360px;
            }
        }
        .auth-card h2 {
            font-size: 1.375rem;
            font-weight: 700;
            color: #0f172a;
            letter-spacing: -0.02em;
            margin-bottom: 0.35rem;
        }
        .auth-card .auth-sub {
            color: var(--auth-muted);
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
        }
        .auth-field {
            margin-bottom: 1rem;
        }
        .auth-field--bottom-gap {
            margin-bottom: 1.35rem;
        }
        .auth-field label {
            display: block;
            font-size: 0.8125rem;
            font-weight: 600;
            color: #334155;
            margin-bottom: 0.4rem;
        }
        .auth-input-wrap {
            position: relative;
        }
        .auth-input-wrap .auth-input-icon {
            position: absolute;
            left: 0.875rem;
            top: 50%;
            transform: translateY(-50%);
            width: 1.125rem;
            height: 1.125rem;
            color: #94a3b8;
            pointer-events: none;
        }
        .auth-input-wrap input {
            width: 100%;
            padding: 0.7rem 0.875rem 0.7rem 2.65rem;
            font-size: 1rem;
            border: 1px solid #e2e8f0;
            border-radius: var(--auth-radius-sm);
            background: var(--auth-input-bg);
            color: #0f172a;
            transition: border-color 0.15s ease, box-shadow 0.15s ease;
        }
        .auth-input-wrap--password input {
            padding-right: 2.75rem;
        }
        .auth-toggle-password {
            position: absolute;
            right: 0.35rem;
            top: 50%;
            transform: translateY(-50%);
            width: 2.35rem;
            height: 2.35rem;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            border: none;
            background: transparent;
            border-radius: 0.5rem;
            color: #64748b;
            cursor: pointer;
            transition: background 0.15s ease, color 0.15s ease;
        }
        .auth-toggle-password:hover {
            background: #f1f5f9;
            color: #0f172a;
        }
        .auth-toggle-password:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(56, 189, 248, 0.45);
        }
        .auth-toggle-password svg {
            width: 1.2rem;
            height: 1.2rem;
            flex-shrink: 0;
        }
        .auth-toggle-password .auth-toggle-hide {
            display: none;
        }
        .auth-toggle-password.is-visible .auth-toggle-show {
            display: none;
        }
        .auth-toggle-password.is-visible .auth-toggle-hide {
            display: block;
        }
        .auth-input-wrap input:focus {
            outline: none;
            border-color: var(--auth-accent);
            box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.25);
            background: #fff;
        }
        .auth-input-wrap input::placeholder {
            color: #94a3b8;
        }
        .auth-input-wrap input[readonly] {
            background: #f1f5f9;
            color: #475569;
            cursor: default;
        }
        .auth-intro {
            color: var(--auth-muted);
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 1.25rem;
        }
        .auth-forgot-row {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 1.25rem;
        }
        .auth-forgot {
            font-size: 0.875rem;
            font-weight: 500;
            color: #0284c7;
            text-decoration: none;
        }
        .auth-forgot:hover {
            color: #0369a1;
            text-decoration: underline;
        }
        .auth-submit {
            width: 100%;
            padding: 0.8rem 1.25rem;
            font-size: 1rem;
            font-weight: 600;
            border: none;
            border-radius: var(--auth-radius-sm);
            background: linear-gradient(135deg, #0ea5e9 0%, #6366f1 100%);
            color: #fff;
            cursor: pointer;
            transition: transform 0.12s ease, box-shadow 0.12s ease;
            box-shadow: 0 4px 14px -3px rgba(14, 165, 233, 0.45);
        }
        .auth-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px -4px rgba(14, 165, 233, 0.5);
        }
        .auth-submit:active {
            transform: translateY(0);
        }
        @media (prefers-reduced-motion: reduce) {
            .auth-submit:hover,
            .auth-submit:active {
                transform: none;
            }
        }
        .auth-footer {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.25rem;
            border-top: 1px solid #f1f5f9;
            font-size: 0.875rem;
            color: var(--auth-muted);
        }
        .auth-footer a {
            color: #0284c7;
            font-weight: 600;
            text-decoration: none;
        }
        .auth-footer a:hover {
            text-decoration: underline;
        }
        .auth-back {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: #64748b;
            text-decoration: none;
            margin-bottom: 1.25rem;
        }
        .auth-back:hover {
            color: #0f172a;
        }
        .invalid-feedback {
            display: block;
            margin-top: 0.35rem;
            font-size: 0.8125rem;
        }
        .alert-auth {
            border-radius: var(--auth-radius-sm);
            font-size: 0.875rem;
            margin-bottom: 1rem;
        }
    </style>
    @stack('styles')
</head>
<body class="auth-page">
    <div class="auth-shell">
        <aside class="auth-brand" aria-hidden="true">
            <h1>{{ config('app.name', 'Laravel') }}</h1>
            @hasSection('auth_brand_text')
                <p>@yield('auth_brand_text')</p>
            @else
                <p>{{ __('Sign in to continue. Your session stays secure on every device.') }}</p>
            @endif
            <div class="auth-brand-dots"><span></span><span></span><span></span></div>
        </aside>
        <div class="auth-panel">
            <div class="auth-card">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script>
    document.querySelectorAll('[data-auth-toggle-password]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var wrap = btn.closest('.auth-input-wrap');
            var input = wrap && wrap.querySelector('input');
            if (!input || input.type === 'hidden') return;
            var show = input.type !== 'text';
            input.type = show ? 'text' : 'password';
            btn.classList.toggle('is-visible', show);
            btn.setAttribute('aria-pressed', show ? 'true' : 'false');
            btn.setAttribute('aria-label', show ? btn.getAttribute('data-label-hide') : btn.getAttribute('data-label-show'));
        });
    });
    </script>
    @stack('scripts')
</body>
</html>
