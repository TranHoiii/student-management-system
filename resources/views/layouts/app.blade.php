<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'THM Consulting - Kế toán, thuế và tư vấn quản trị')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --navy: #071b2f;
            --navy-2: #0b2d4d;
            --blue: #155e8a;
            --gold: #c9a45c;
            --gold-soft: #f2dfb5;
            --ink: #111827;
            --muted: #667085;
            --line: #dbe4ee;
            --surface: #f6f8fb;
            --white: #ffffff;
            --glass: rgba(255, 255, 255, 0.72);
            --shadow: 0 24px 70px rgba(7, 27, 47, 0.12);
        }

        * {
            letter-spacing: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            color: var(--ink);
            background:
                radial-gradient(circle at 14% 8%, rgba(201, 164, 92, 0.13), transparent 28rem),
                radial-gradient(circle at 88% 6%, rgba(21, 94, 138, 0.13), transparent 30rem),
                var(--surface);
            overflow-x: hidden;
        }

        main {
            flex: 1;
        }

        a {
            color: var(--blue);
        }

        .site-topbar {
            background: var(--navy);
            color: rgba(255, 255, 255, 0.78);
            font-size: 0.84rem;
        }

        .site-topbar a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
        }

        .navbar-custom {
            position: sticky;
            top: 0;
            z-index: 1030;
            background: rgba(255, 255, 255, 0.82);
            backdrop-filter: blur(22px);
            border-bottom: 1px solid rgba(219, 228, 238, 0.76);
            box-shadow: 0 10px 34px rgba(7, 27, 47, 0.05);
        }

        .logo-tile {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            border: 1px solid rgba(7, 27, 47, 0.12);
            border-radius: 8px;
            box-shadow: 0 10px 28px rgba(7, 27, 47, 0.1);
            padding: 4px;
        }

        .brand-logo {
            height: 52px;
            width: auto;
            display: block;
            border-radius: 6px;
        }

        .brand-title {
            display: grid;
            line-height: 1.15;
        }

        .brand-title strong {
            color: var(--navy);
            font-size: 1.14rem;
            font-weight: 900;
        }

        .brand-title span,
        .brand-title small {
            color: var(--muted);
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .brand-title small {
            color: var(--blue);
            text-transform: none;
        }

        .nav-link-custom {
            color: #263244;
            font-weight: 700;
            padding: 0.65rem 0.85rem !important;
            border-radius: 8px;
            transition: color 220ms ease, background 220ms ease;
        }

        .nav-link-custom:hover,
        .nav-link-custom.active {
            color: var(--navy);
            background: rgba(21, 94, 138, 0.08);
        }

        .btn-cta,
        .btn-soft,
        .btn-ghost-premium {
            border-radius: 8px;
            font-weight: 800;
            padding: 0.82rem 1.15rem;
            transition: transform 260ms ease, box-shadow 260ms ease, border-color 260ms ease, background 260ms ease;
        }

        .btn-cta {
            border: 1px solid rgba(201, 164, 92, 0.42);
            background: linear-gradient(135deg, var(--navy), var(--blue));
            color: #fff !important;
            box-shadow: 0 14px 32px rgba(7, 27, 47, 0.2);
            position: relative;
            overflow: hidden;
        }

        .btn-cta::after {
            content: '';
            position: absolute;
            inset: -120% auto -120% -40%;
            width: 34%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.28), transparent);
            transform: rotate(18deg);
            animation: reflection 4.8s ease-in-out infinite;
        }

        .btn-cta:hover,
        .btn-soft:hover,
        .btn-ghost-premium:hover {
            transform: translateY(-2px);
            box-shadow: 0 18px 42px rgba(7, 27, 47, 0.16);
        }

        .btn-soft {
            border: 1px solid rgba(7, 27, 47, 0.12);
            background: #fff;
            color: var(--navy);
        }

        .btn-ghost-premium {
            border: 1px solid rgba(255, 255, 255, 0.22);
            color: #fff;
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(14px);
        }

        .section-pad {
            padding: 96px 0;
        }

        .eyebrow {
            color: var(--blue);
            font-size: 0.76rem;
            font-weight: 900;
            text-transform: uppercase;
        }

        .eyebrow.gold {
            color: var(--gold-soft);
        }

        .section-title {
            font-weight: 900;
            color: var(--ink);
        }

        .fw-black {
            font-weight: 900;
        }

        .section-copy {
            color: var(--muted);
            line-height: 1.75;
        }

        .glass-card,
        .service-card,
        .info-card {
            border: 1px solid rgba(219, 228, 238, 0.9);
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.86);
            box-shadow: var(--shadow);
            backdrop-filter: blur(18px);
        }

        .service-card,
        .info-card {
            background: #fff;
            box-shadow: 0 16px 42px rgba(7, 27, 47, 0.07);
        }

        .premium-card {
            transition: transform 320ms ease, box-shadow 320ms ease, border-color 320ms ease;
        }

        .premium-card:hover {
            transform: translateY(-6px);
            border-color: rgba(201, 164, 92, 0.36);
            box-shadow: 0 26px 70px rgba(7, 27, 47, 0.13);
        }

        .service-icon,
        .contact-icon,
        .icon-tile {
            width: 52px;
            height: 52px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            background: linear-gradient(135deg, var(--navy), var(--blue));
            box-shadow: 0 14px 30px rgba(21, 94, 138, 0.22);
            flex: 0 0 auto;
        }

        .icon-tile.gold {
            color: var(--navy);
            background: linear-gradient(135deg, #fff6df, var(--gold));
        }

        .page-banner {
            background:
                linear-gradient(135deg, rgba(7, 27, 47, 0.96), rgba(11, 45, 77, 0.92)),
                radial-gradient(circle at 80% 10%, rgba(201, 164, 92, 0.28), transparent 24rem);
            color: #fff;
            padding: 78px 0;
        }

        .banner-logo-card {
            border: 1px solid rgba(255, 255, 255, 0.22);
            background: rgba(255, 255, 255, 0.92);
            box-shadow: 0 28px 70px rgba(0, 0, 0, 0.2);
        }

        .banner-logo {
            width: min(100%, 180px);
            height: auto;
            display: block;
            border-radius: 8px;
            box-shadow: 0 18px 42px rgba(7, 27, 47, 0.18);
        }

        .contact-band {
            background:
                radial-gradient(circle at 18% 12%, rgba(201, 164, 92, 0.18), transparent 26rem),
                linear-gradient(135deg, #071b2f, #0b2d4d);
            color: #fff;
            overflow: hidden;
            position: relative;
        }

        .contact-band::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255, 255, 255, 0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.04) 1px, transparent 1px);
            background-size: 48px 48px;
            pointer-events: none;
        }

        .contact-band .container {
            position: relative;
            z-index: 1;
        }

        .consultation-form .form-label {
            color: var(--ink);
            font-weight: 800;
            font-size: 0.88rem;
        }

        .consultation-form .form-control,
        .consultation-form .form-select,
        .consultation-form .input-group-text {
            border-color: #d8e2ea;
            border-radius: 8px;
            min-height: 50px;
        }

        .consultation-form .form-control:focus,
        .consultation-form .form-select:focus {
            border-color: rgba(21, 94, 138, 0.55);
            box-shadow: 0 0 0 0.22rem rgba(21, 94, 138, 0.1);
        }

        .consultation-form .input-group-text {
            color: var(--blue);
            background: #eef5f9;
        }

        .custom-alert {
            border: 0;
            border-radius: 8px;
        }

        .footer-custom {
            background:
                radial-gradient(circle at 84% 0%, rgba(201, 164, 92, 0.16), transparent 26rem),
                var(--navy);
            color: rgba(255, 255, 255, 0.72);
            padding-top: 64px;
        }

        .footer-custom a {
            color: rgba(255, 255, 255, 0.82);
            text-decoration: none;
        }

        .footer-custom a:hover {
            color: #fff;
        }

        .footer-title {
            color: #fff;
            font-weight: 900;
            margin-bottom: 18px;
        }

        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links li {
            margin-bottom: 11px;
        }

        .footer-bottom {
            margin-top: 48px;
            padding: 20px 0;
            background: rgba(0, 0, 0, 0.18);
            color: rgba(255, 255, 255, 0.58);
            font-size: 0.9rem;
        }

        .zalo-floating-button {
            position: fixed;
            right: 20px;
            bottom: 24px;
            z-index: 1040;
            width: 58px;
            height: 58px;
            border-radius: 50%;
            background: #0068ff;
            color: #ffffff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-size: 0.92rem;
            font-weight: 900;
            box-shadow: 0 14px 34px rgba(0, 104, 255, 0.35);
        }

        .reveal {
            opacity: 0;
            transform: translateY(34px);
            transition: opacity 780ms cubic-bezier(0.2, 0.8, 0.2, 1), transform 780ms cubic-bezier(0.2, 0.8, 0.2, 1);
        }

        .reveal.is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        [data-parallax] {
            transform: translate3d(0, var(--parallax-y, 0), 0);
            transition: transform 80ms linear;
        }

        @keyframes reflection {
            0%, 48% { left: -44%; }
            68%, 100% { left: 124%; }
        }

        @media (prefers-reduced-motion: reduce) {
            html {
                scroll-behavior: auto;
            }

            *,
            *::before,
            *::after {
                animation: none !important;
                transition: none !important;
            }

            .reveal {
                opacity: 1;
                transform: none;
            }
        }

        @media (max-width: 991.98px) {
            .section-pad {
                padding: 72px 0;
            }
        }

        @media (max-width: 575.98px) {
            .brand-logo {
                height: 46px;
            }

            .brand-title small {
                display: none;
            }

            .banner-logo {
                width: 132px;
            }

            .section-pad {
                padding: 58px 0;
            }

            .zalo-floating-button {
                right: 16px;
                bottom: 18px;
                width: 54px;
                height: 54px;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="site-topbar py-2">
        <div class="container d-flex flex-column flex-lg-row gap-2 justify-content-between align-items-center">
            <div class="d-flex flex-wrap justify-content-center justify-content-lg-start gap-3">
                <span><i class="bi bi-clock me-1 text-warning"></i>8:00 - 17:30, Thứ 2 - Thứ 7</span>
                <span><i class="bi bi-geo-alt me-1 text-warning"></i>Yên Thành, Nghệ An</span>
            </div>
            <div class="d-flex flex-wrap justify-content-center justify-content-lg-end gap-3">
                <a href="tel:{{ \App\Models\SystemSetting::getValue('hotline', config('company.hotline')) }}"><i class="bi bi-telephone-fill me-1 text-warning"></i>{{ \App\Models\SystemSetting::getValue('hotline', config('company.hotline')) }}</a>
                <a href="mailto:{{ \App\Models\SystemSetting::getValue('email', config('company.email')) }}"><i class="bi bi-envelope-fill me-1 text-warning"></i>{{ \App\Models\SystemSetting::getValue('email', config('company.email')) }}</a>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-custom py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
                <span class="logo-tile">
                    <img class="brand-logo" src="{{ asset('images/thm-logo.png') }}" alt="THM logo">
                </span>
                <span class="brand-title">
                    <strong>THM Consulting</strong>
                    <span>Kế toán và thuế</span>
                    <small>Chuẩn mực kế toán | Trọn vẹn niềm tin</small>
                </span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Mở menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
                    <li class="nav-item"><a class="nav-link nav-link-custom {{ Request::routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Trang chủ</a></li>
                    <li class="nav-item"><a class="nav-link nav-link-custom {{ Request::routeIs('services.index') ? 'active' : '' }}" href="{{ route('services.index') }}">Dịch vụ</a></li>
                    <li class="nav-item"><a class="nav-link nav-link-custom {{ Request::routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Liên hệ</a></li>
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <li class="nav-item"><a class="nav-link nav-link-custom text-danger" href="{{ route('admin.consultations.index') }}"><i class="bi bi-speedometer2 me-1"></i>Quản trị</a></li>
                        @endif
                    @endauth
                    <li class="nav-item ms-lg-2 mt-3 mt-lg-0">
                        <a class="btn btn-cta" href="{{ Request::routeIs('home') ? '#consultation-form' : route('contact') }}">
                            <i class="bi bi-calendar2-check me-2"></i>Đặt lịch tư vấn
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <a class="zalo-floating-button" href="{{ \App\Models\SystemSetting::getValue('zalo_url', config('company.zalo_url')) }}" target="_blank" rel="noopener" aria-label="Chat Zalo">Zalo</a>

    <footer class="footer-custom">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <span class="logo-tile">
                            <img class="brand-logo" src="{{ asset('images/thm-logo.png') }}" alt="THM logo">
                        </span>
                        <div>
                            <h5 class="footer-title mb-1">THM Consulting</h5>
                            <div class="small">{{ \App\Models\SystemSetting::getValue('slogan', config('company.slogan')) }}</div>
                        </div>
                    </div>
                    <p class="mb-2">Đồng hành cùng hộ kinh doanh và doanh nghiệp trong kế toán, thuế, kiểm soát nội bộ và quản trị tài chính.</p>
                    <p class="small mb-0">Mã số HKD: <strong>{{ \App\Models\SystemSetting::getValue('tax_code', config('company.tax_code')) }}</strong></p>
                </div>
                <div class="col-lg-2 col-md-4">
                    <h6 class="footer-title">Liên kết</h6>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}">Trang chủ</a></li>
                        <li><a href="{{ route('services.index') }}">Dịch vụ</a></li>
                        <li><a href="{{ route('contact') }}">Liên hệ</a></li>
                        <li><a href="{{ route('admin.login') }}">Quản trị</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4">
                    <h6 class="footer-title">Dịch vụ chính</h6>
                    <ul class="footer-links">
                        <li><a href="{{ route('services.index') }}">Tư vấn thuế</a></li>
                        <li><a href="{{ route('services.index') }}">Kế toán trọn gói</a></li>
                        <li><a href="{{ route('services.index') }}">Kiểm soát nội bộ</a></li>
                        <li><a href="{{ route('services.index') }}">Tư vấn quản lý</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4">
                    <h6 class="footer-title">Thông tin liên hệ</h6>
                    <p class="mb-2"><i class="bi bi-geo-alt-fill me-2 text-warning"></i>{{ \App\Models\SystemSetting::getValue('address', config('company.address')) }}</p>
                    <p class="mb-2"><i class="bi bi-telephone-fill me-2 text-warning"></i><a href="tel:{{ \App\Models\SystemSetting::getValue('hotline', config('company.hotline')) }}">{{ \App\Models\SystemSetting::getValue('hotline', config('company.hotline')) }}</a></p>
                    <p class="mb-0"><i class="bi bi-envelope-fill me-2 text-warning"></i><a href="mailto:{{ \App\Models\SystemSetting::getValue('email', config('company.email')) }}">{{ \App\Models\SystemSetting::getValue('email', config('company.email')) }}</a></p>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container d-flex flex-column flex-md-row justify-content-between gap-2 text-center text-md-start">
                <span>&copy; {{ date('Y') }} {{ \App\Models\SystemSetting::getValue('company_name', config('company.name')) }}.</span>
                <span>Chuẩn mực kế toán | Trọn vẹn niềm tin</span>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (() => {
            const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            const revealItems = document.querySelectorAll('.reveal');

            if (!reducedMotion && revealItems.length) {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('is-visible');
                            observer.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.14, rootMargin: '0px 0px -8% 0px' });

                revealItems.forEach((item, index) => {
                    item.style.transitionDelay = `${Math.min(index % 6, 4) * 70}ms`;
                    observer.observe(item);
                });
            } else {
                revealItems.forEach((item) => item.classList.add('is-visible'));
            }

            const counters = document.querySelectorAll('[data-counter]');
            if (counters.length) {
                const counterObserver = new IntersectionObserver((entries) => {
                    entries.forEach((entry) => {
                        if (!entry.isIntersecting) return;
                        const el = entry.target;
                        const target = Number(el.dataset.counter || 0);
                        const suffix = el.dataset.suffix || '';
                        const duration = reducedMotion ? 1 : 1200;
                        const start = performance.now();

                        const tick = (now) => {
                            const progress = Math.min((now - start) / duration, 1);
                            const value = Math.floor(target * (1 - Math.pow(1 - progress, 3)));
                            el.textContent = `${value}${suffix}`;
                            if (progress < 1) requestAnimationFrame(tick);
                        };

                        requestAnimationFrame(tick);
                        counterObserver.unobserve(el);
                    });
                }, { threshold: 0.4 });

                counters.forEach((counter) => counterObserver.observe(counter));
            }

            const parallaxItems = document.querySelectorAll('[data-parallax]');
            if (!reducedMotion && parallaxItems.length) {
                let ticking = false;
                const update = () => {
                    parallaxItems.forEach((item) => {
                        const speed = Number(item.dataset.parallax || 0.08);
                        const rect = item.getBoundingClientRect();
                        const offset = (window.innerHeight / 2 - rect.top) * speed;
                        item.style.setProperty('--parallax-y', `${offset.toFixed(1)}px`);
                    });
                    ticking = false;
                };

                window.addEventListener('scroll', () => {
                    if (!ticking) {
                        requestAnimationFrame(update);
                        ticking = true;
                    }
                }, { passive: true });
                update();
            }
        })();
    </script>
    @stack('scripts')
</body>
</html>
