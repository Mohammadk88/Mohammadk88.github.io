<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ in_array(app()->getLocale(), ['ar', 'ku']) ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', \App\Models\Setting::get('meta_title_' . app()->getLocale(), 'Grand Start Real Estate'))</title>
    <meta name="description" content="@yield('description', \App\Models\Setting::get('meta_description_' . app()->getLocale(), ''))">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&family=Tajawal:wght@300;400;500;700&family=Playfair+Display:wght@400;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 RTL/LTR -->
    @if(in_array(app()->getLocale(), ['ar', 'ku']))
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    @else
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    @endif

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">

    <!-- AOS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @stack('styles')
</head>
<body class="{{ in_array(app()->getLocale(), ['ar', 'ku']) ? 'rtl-body' : 'ltr-body' }}">

    <!-- Top Bar -->
    <div class="top-bar">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center py-2">
                <div class="top-contact d-none d-md-flex gap-3">
                    @php
                        $isIraq = request()->get('visitor_country') === 'IQ';
                        $topPhone = $isIraq
                            ? \App\Models\Setting::get('phone_iraq')
                            : \App\Models\Setting::get('phone_default');
                        $topEmail = $isIraq
                            ? \App\Models\Setting::get('email_iraq')
                            : \App\Models\Setting::get('email_default');
                    @endphp
                    @if($topPhone)
                    <a href="tel:{{ $topPhone }}" class="top-link">
                        <i class="fas fa-phone-alt"></i> {{ $topPhone }}
                    </a>
                    @endif
                    @if($topEmail)
                    <a href="mailto:{{ $topEmail }}" class="top-link">
                        <i class="fas fa-envelope"></i> {{ $topEmail }}
                    </a>
                    @endif
                </div>
                <div class="lang-switcher d-flex gap-2 align-items-center">
                    @foreach(['ar' => 'العربية', 'en' => 'English', 'ku' => 'کوردی'] as $locale => $label)
                        <a href="{{ route('lang.switch', $locale) }}"
                           class="lang-btn {{ app()->getLocale() === $locale ? 'active' : '' }}">
                            {{ $label }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg main-navbar sticky-top" id="mainNav">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/logo-transparent.png') }}" alt="Grand Start Real Estate" class="navbar-logo">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav {{ in_array(app()->getLocale(), ['ar', 'ku']) ? 'me-auto' : 'ms-auto' }} align-items-lg-center gap-lg-1">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            {{ __('app.home') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('projects.*') ? 'active' : '' }}" href="{{ route('projects.index') }}">
                            {{ __('app.projects') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
                            {{ __('app.about') }}
                        </a>
                    </li>
                    <li class="nav-item ms-lg-2">
                        <a class="btn btn-gold" href="{{ route('contact') }}">
                            <i class="fas fa-phone-alt me-1"></i> {{ __('app.contact') }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="footer-top">
            <div class="container">
                <div class="row g-4">
                    <!-- Brand -->
                    <div class="col-lg-4 col-md-6">
                        <div class="footer-brand">
                            <img src="{{ asset('images/logo-transparent.png') }}" alt="Grand Start" class="footer-logo mb-3">
                            <p class="footer-desc">
                                {{ \App\Models\Setting::get('company_tagline_' . app()->getLocale(), \App\Models\Setting::get('company_tagline_ar')) }}
                            </p>
                            <div class="social-links mt-3">
                                @if(\App\Models\Setting::get('facebook_url'))
                                <a href="{{ \App\Models\Setting::get('facebook_url') }}" target="_blank" class="social-link"><i class="fab fa-facebook-f"></i></a>
                                @endif
                                @if(\App\Models\Setting::get('instagram_url'))
                                <a href="{{ \App\Models\Setting::get('instagram_url') }}" target="_blank" class="social-link"><i class="fab fa-instagram"></i></a>
                                @endif
                                @if(\App\Models\Setting::get('twitter_url'))
                                <a href="{{ \App\Models\Setting::get('twitter_url') }}" target="_blank" class="social-link"><i class="fab fa-twitter"></i></a>
                                @endif
                                @if(\App\Models\Setting::get('youtube_url'))
                                <a href="{{ \App\Models\Setting::get('youtube_url') }}" target="_blank" class="social-link"><i class="fab fa-youtube"></i></a>
                                @endif
                                @if(\App\Models\Setting::get('tiktok_url'))
                                <a href="{{ \App\Models\Setting::get('tiktok_url') }}" target="_blank" class="social-link"><i class="fab fa-tiktok"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="col-lg-2 col-md-6 col-6">
                        <h5 class="footer-title">{{ __('app.quick_links') }}</h5>
                        <ul class="footer-links">
                            <li><a href="{{ route('home') }}">{{ __('app.home') }}</a></li>
                            <li><a href="{{ route('projects.index') }}">{{ __('app.projects') }}</a></li>
                            <li><a href="{{ route('about') }}">{{ __('app.about') }}</a></li>
                            <li><a href="{{ route('contact') }}">{{ __('app.contact') }}</a></li>
                        </ul>
                    </div>

                    <!-- Contact Info -->
                    <div class="col-lg-3 col-md-6">
                        <h5 class="footer-title">{{ __('app.contact_us') }}</h5>
                        <ul class="footer-contact-list">
                            @php
                                $isIraq = request()->get('visitor_country') === 'IQ';
                                $footerPhone = $isIraq ? \App\Models\Setting::get('phone_iraq') : \App\Models\Setting::get('phone_default');
                                $footerEmail = $isIraq ? \App\Models\Setting::get('email_iraq') : \App\Models\Setting::get('email_default');
                                $footerAddress = $isIraq
                                    ? \App\Models\Setting::get('address_iraq_' . app()->getLocale(), \App\Models\Setting::get('address_iraq_ar'))
                                    : \App\Models\Setting::get('address_default_' . app()->getLocale(), \App\Models\Setting::get('address_default_ar'));
                            @endphp
                            @if($footerPhone)
                            <li><i class="fas fa-phone-alt"></i> <a href="tel:{{ $footerPhone }}">{{ $footerPhone }}</a></li>
                            @endif
                            @if($footerEmail)
                            <li><i class="fas fa-envelope"></i> <a href="mailto:{{ $footerEmail }}">{{ $footerEmail }}</a></li>
                            @endif
                            @if($footerAddress)
                            <li><i class="fas fa-map-marker-alt"></i> {{ $footerAddress }}</li>
                            @endif
                        </ul>
                    </div>

                    <!-- Newsletter -->
                    <div class="col-lg-3 col-md-6">
                        <h5 class="footer-title">{{ __('app.newsletter') }}</h5>
                        <p class="footer-desc small">{{ __('app.newsletter_text') }}</p>
                        <form class="newsletter-form" onsubmit="return false;">
                            <div class="input-group">
                                <input type="email" class="form-control" placeholder="{{ __('app.your_email') }}">
                                <button class="btn btn-gold" type="submit">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                    <p class="mb-0">
                        &copy; {{ date('Y') }}
                        {{ \App\Models\Setting::get('company_name_' . app()->getLocale(), 'Grand Start Real Estate') }} -
                        {{ __('app.all_rights') }}
                    </p>
                    <a href="{{ route('admin.login') }}" class="footer-admin-link">
                        <i class="fas fa-lock"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- WhatsApp Floating Button -->
    @php
        $isIraqWa = request()->get('visitor_country') === 'IQ';
        $waNumber = $isIraqWa
            ? \App\Models\Setting::get('whatsapp_iraq', env('WHATSAPP_IRAQ'))
            : \App\Models\Setting::get('whatsapp_default', env('WHATSAPP_DEFAULT'));
        $waNumber = preg_replace('/[^0-9]/', '', $waNumber);
    @endphp
    @if($waNumber)
    <a href="https://wa.me/{{ $waNumber }}?text={{ urlencode(__('app.chat_whatsapp')) }}"
       class="whatsapp-float"
       target="_blank"
       title="{{ __('app.whatsapp') }}">
        <i class="fab fa-whatsapp"></i>
        <span class="whatsapp-pulse"></span>
    </a>
    @endif

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

    <!-- AOS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- Custom JS -->
    <script src="{{ asset('js/app.js') }}"></script>

    @stack('scripts')
</body>
</html>
