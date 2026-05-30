<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'THM - Dịch vụ kế toán, thuế và quản trị')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #073763;
            --primary-2: #0d5c75;
            --accent: #27a38a;
            --gold: #f2a900;
            --ink: #142033;
            --muted: #667085;
            --line: #dbe5ee;
            --surface: #f6f9fc;
            --white: #ffffff;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: 'Inter', sans-serif;
            color: var(--ink);
            background: var(--surface);
            overflow-x: hidden;
        }

        main {
            flex: 1;
        }

        a {
            color: var(--primary-2);
        }

        .site-topbar {
            background: #071b2f;
            color: rgba(255, 255, 255, 0.82);
            font-size: 0.875rem;
        }

        .site-topbar a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
        }

        .navbar-custom {
            position: sticky;
            top: 0;
            z-index: 1030;
            background: rgba(255, 255, 255, 0.94);
            backdrop-filter: blur(14px);
            border-bottom: 1px solid rgba(219, 229, 238, 0.85);
        }

        .logo-tile {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            border: 1px solid rgba(7, 55, 99, 0.16);
            border-radius: 8px;
            box-shadow: 0 8px 18px rgba(7, 55, 99, 0.12);
            padding: 4px;
        }

        .brand-logo {
            height: 56px;
            width: auto;
            display: block;
            border-radius: 6px;
        }

        .brand-title {
            display: grid;
            line-height: 1.15;
        }

        .brand-title strong {
            color: var(--primary);
            font-size: 1.18rem;
            letter-spacing: 0;
        }

        .brand-title span {
            color: var(--muted);
            font-size: 0.72rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .brand-slogan {
            color: var(--primary-2);
            font-size: 0.78rem;
            font-weight: 800;
            letter-spacing: 0;
        }

        .logo-showcase {
            display: inline-block;
            background: #fff;
            border: 1px solid rgba(255, 255, 255, 0.72);
            border-radius: 8px;
            box-shadow: 0 24px 52px rgba(0, 0, 0, 0.22);
            padding: 10px;
        }

        .logo-showcase img {
            display: block;
            width: min(100%, 300px);
            height: auto;
            border-radius: 6px;
        }

        .logo-showcase-caption {
            margin-top: 10px;
            color: var(--primary);
            font-size: 0.9rem;
            font-weight: 800;
            text-align: center;
        }

        .nav-link-custom {
            color: var(--ink);
            font-weight: 600;
            padding: 0.65rem 0.9rem !important;
            border-radius: 8px;
        }

        .nav-link-custom:hover,
        .nav-link-custom.active {
            color: var(--primary);
            background: rgba(39, 163, 138, 0.1);
        }

        .btn-cta {
            border: 0;
            border-radius: 8px;
            background: linear-gradient(135deg, var(--primary), var(--primary-2));
            color: #fff !important;
            font-weight: 700;
            padding: 0.78rem 1.15rem;
            box-shadow: 0 12px 26px rgba(7, 55, 99, 0.22);
        }

        .btn-cta:hover {
            transform: translateY(-1px);
            box-shadow: 0 16px 30px rgba(7, 55, 99, 0.28);
        }

        .btn-soft {
            border: 1px solid var(--line);
            border-radius: 8px;
            background: #fff;
            color: var(--ink);
            font-weight: 700;
            padding: 0.78rem 1.15rem;
        }

        .section-pad {
            padding: 84px 0;
        }

        .eyebrow {
            color: var(--primary-2);
            font-size: 0.78rem;
            font-weight: 800;
            letter-spacing: 0;
            text-transform: uppercase;
        }

        .section-title {
            font-weight: 800;
            letter-spacing: 0;
            color: var(--ink);
        }

        .section-copy {
            color: var(--muted);
            line-height: 1.75;
        }

        .hero {
            position: relative;
            background: linear-gradient(120deg, rgba(7, 55, 99, 0.96), rgba(13, 92, 117, 0.9));
            color: #fff;
            padding: 96px 0 72px;
        }

        .hero::after {
            content: '';
            position: absolute;
            inset: auto 0 0 0;
            height: 1px;
            background: rgba(255, 255, 255, 0.18);
        }

        .hero .container {
            position: relative;
            z-index: 1;
        }

        .hero-card {
            background: rgba(255, 255, 255, 0.96);
            color: var(--ink);
            border: 1px solid rgba(255, 255, 255, 0.45);
            border-radius: 8px;
            box-shadow: 0 24px 60px rgba(0, 0, 0, 0.18);
        }

        .metric {
            border-left: 3px solid var(--accent);
            padding-left: 14px;
        }

        .metric strong {
            display: block;
            color: var(--primary);
            font-size: 1.35rem;
            font-weight: 800;
        }

        .service-card,
        .info-card {
            border: 1px solid var(--line);
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 12px 28px rgba(20, 32, 51, 0.06);
        }

        .service-icon,
        .contact-icon {
            width: 52px;
            height: 52px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            flex: 0 0 auto;
        }

        .feature-row {
            border-top: 1px solid var(--line);
        }

        .process-step {
            border-left: 3px solid var(--accent);
            padding-left: 18px;
        }

        .page-banner {
            background: linear-gradient(135deg, var(--primary), var(--primary-2));
            color: #fff;
            padding: 72px 0;
        }

        .consultation-form .form-label {
            color: var(--ink);
            font-weight: 700;
            font-size: 0.88rem;
        }

        .consultation-form .form-control,
        .consultation-form .form-select,
        .consultation-form .input-group-text {
            border-color: #d8e2ea;
            border-radius: 8px;
            min-height: 48px;
        }

        .consultation-form .input-group-text {
            color: var(--primary-2);
            background: #eef6f7;
        }

        .custom-alert {
            border: 0;
            border-radius: 8px;
        }

        .footer-custom {
            background: #071b2f;
            color: rgba(255, 255, 255, 0.76);
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
            font-weight: 800;
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
            font-size: 0.95rem;
            font-weight: 800;
            box-shadow: 0 10px 24px rgba(0, 104, 255, 0.35);
        }

        .zalo-floating-button:hover {
            color: #ffffff;
            filter: brightness(1.06);
        }

        @media (max-width: 991.98px) {
            .hero {
                padding: 72px 0 56px;
                background: linear-gradient(120deg, rgba(7, 55, 99, 0.96), rgba(13, 92, 117, 0.92));
            }

            .section-pad {
                padding: 64px 0;
            }
        }

        @media (max-width: 575.98px) {
            .brand-logo {
                height: 48px;
            }

            .hero {
                padding: 56px 0 44px;
            }

            .zalo-floating-button {
                right: 16px;
                bottom: 18px;
                width: 54px;
                height: 54px;
            }
        }
    </style>
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
                    <strong>THM</strong>
                    <span>Kế toán và thuế</span>
                    <small class="brand-slogan">Chuẩn mực kế toán | Trọn vẹn niềm tin</small>
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
                        <li><a href="{{ route('services.index') }}">Kiểm toán nội bộ</a></li>
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
</body>
</html>
