<footer class="site-footer">
    <style>
        .site-footer{
            --page-bg: #f0f2f5;
            --footer-bg: #efe6d8;
            background: linear-gradient(
                180deg,
                var(--page-bg) 0%,
                var(--footer-bg) 24%,
                var(--footer-bg) 100%
            );
            color: #1b1b1b;
            padding: 26px 0 18px;
        }
        .site-footer a{ color: inherit; }
        .footer-top{
            display:flex;
            gap: 22px;
            align-items: flex-start;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .footer-brand{
            display:flex;
            gap: 14px;
            align-items: flex-start;
            min-width: 280px;
        }
        .footer-brand__logo{
            width: 44px;
            height: 44px;
            object-fit: contain;
            flex: 0 0 44px;
        }
        .footer-meta{
            line-height: 1.55;
            font-size: 14px;
        }
        .footer-meta .footer-meta__item{
            margin: 0;
            display:flex;
            gap: 8px;
            align-items: baseline;
            flex-wrap: wrap;
        }
        .footer-meta .footer-meta__label{
            font-weight: 600;
            opacity: .9;
            min-width: 62px;
        }
        .footer-address{
            max-width: 520px;
            margin-left: auto;
            text-align: right;
            font-size: 14px;
            line-height: 1.55;
            opacity: .95;
        }
        .footer-divider{
            height: 1px;
            background: rgba(0,0,0,.08);
            margin: 16px 0 14px;
        }
        .footer-bottom{
            display:flex;
            align-items:center;
            justify-content: space-between;
            gap: 14px;
            flex-wrap: wrap;
        }
        .footer-copy{
            font-size: 13px;
            margin: 0;
            opacity: .9;
        }
        .footer-copy .sep{ opacity: .5; padding: 0 10px; }
        .footer-social{
            display:flex;
            gap: 10px;
            align-items:center;
            justify-content: flex-end;
        }
        .footer-social__link{
            width: 34px;
            height: 34px;
            border-radius: 999px;
            border: 1px solid rgba(0,0,0,.12);
            display:inline-flex;
            align-items:center;
            justify-content:center;
            text-decoration:none;
            transition: transform .15s ease, background .15s ease, border-color .15s ease;
        }
        .footer-social__link:hover{
            transform: translateY(-1px);
            background: rgba(255,255,255,.45);
            border-color: rgba(0,0,0,.18);
        }
        .footer-social__link i{ font-size: 14px; opacity: .85; }
        @media (max-width: 768px){
            .footer-address{ text-align: left; margin-left: 0; }
            .footer-brand{ min-width: 100%; }
            .footer-bottom{ justify-content: center; }
            .footer-social{ justify-content: center; width: 100%; }
            .footer-copy{ text-align: center; width: 100%; }
        }
    </style>

    <div class="container">
        <div class="footer-top">
            <div class="footer-brand">
                <a href="{{ url('/') }}" aria-label="Home">
                    <img class="footer-brand__logo" src="{{ asset($websiteParameter->logo()) }}" alt="{{ $websiteParameter->logo_alt ?? $websiteParameter->h1 }}">
                </a>

                <div class="footer-meta">
                    @if(!empty($websiteParameter->contact_mobile))
                        <p class="footer-meta__item">
                            <span class="footer-meta__label">Hotline</span>
                            <span>: <a href="tel:{{ $websiteParameter->contact_mobile }}">{{ $websiteParameter->contact_mobile }}</a></span>
                        </p>
                    @endif

                    @if(!empty($websiteParameter->whatsapp_number))
                        <p class="footer-meta__item">
                            <span class="footer-meta__label">Sales</span>
                            <span>: <a href="https://api.whatsapp.com/send?phone={{ $websiteParameter->whatsapp_number }}&text=Hello%21%20." target="_blank" rel="noopener noreferrer">{{ $websiteParameter->whatsapp_number }}</a></span>
                        </p>
                    @endif

                    @if(!empty($websiteParameter->contact_email))
                        <p class="footer-meta__item">
                            <span class="footer-meta__label">Email</span>
                            <span>: <a href="mailto:{{ $websiteParameter->contact_email }}">{{ $websiteParameter->contact_email }}</a></span>
                        </p>
                    @endif
                </div>
            </div>

            @if(!empty($websiteParameter->footer_address))
                <div class="footer-address">
                    <div class="fw-semibold mb-1">Address</div>
                    <div style="white-space: pre-wrap;">{!! $websiteParameter->footer_address !!}</div>
                </div>
            @endif
        </div>

        <div class="footer-divider"></div>

        <div class="footer-bottom">
            <p class="footer-copy">
                © {{ date('Y') }} {{ $websiteParameter->h1 }}. All Rights Reserved.
                <span class="sep">|</span>
                Made by <a href="{{ url('https://multisoftbd.com') }}" target="_blank" rel="noopener noreferrer">Multisoft</a>
            </p>

            <div class="footer-social" aria-label="Social links">
                @if(!empty($websiteParameter->fb_page_link))
                    <a class="footer-social__link" href="{{ url($websiteParameter->fb_page_link) }}" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                @endif
                @if(!empty($websiteParameter->twitter_url))
                    <a class="footer-social__link" href="{{ url($websiteParameter->twitter_url) }}" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                @endif
                @if(!empty($websiteParameter->youtube_url))
                    <a class="footer-social__link" href="{{ url($websiteParameter->youtube_url) }}" target="_blank" rel="noopener noreferrer" aria-label="YouTube">
                        <i class="fab fa-youtube"></i>
                    </a>
                @endif
                @if(!empty($websiteParameter->instagram_url))
                    <a class="footer-social__link" href="{{ url($websiteParameter->instagram_url) }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                @endif
            </div>
        </div>
    </div>
</footer>