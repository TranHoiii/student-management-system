@extends('layouts.app')

@section('title', 'THM Consulting - Tư vấn kế toán và thuế hiện đại')

@push('styles')
    <style>
        .premium-hero {
            position: relative;
            min-height: 760px;
            display: flex;
            align-items: center;
            color: #fff;
            overflow: hidden;
            background:
                linear-gradient(120deg, rgba(7, 27, 47, 0.96), rgba(11, 45, 77, 0.86)),
                url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=2200&q=80') center/cover;
        }

        .premium-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255, 255, 255, 0.055) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.055) 1px, transparent 1px);
            background-size: 56px 56px;
            mask-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.82), transparent 88%);
        }

        .premium-hero::after {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 24% 22%, rgba(201, 164, 92, 0.2), transparent 24rem),
                radial-gradient(circle at 78% 26%, rgba(90, 162, 207, 0.18), transparent 26rem);
            animation: ambientShift 12s ease-in-out infinite alternate;
        }

        .hero-particle {
            position: absolute;
            width: 3px;
            height: 3px;
            border-radius: 50%;
            background: rgba(242, 223, 181, 0.64);
            box-shadow: 0 0 18px rgba(242, 223, 181, 0.5);
            animation: floatParticle 8s ease-in-out infinite;
        }

        .hero-particle:nth-child(1) { left: 12%; top: 24%; animation-delay: 0s; }
        .hero-particle:nth-child(2) { left: 38%; top: 18%; animation-delay: 1.4s; }
        .hero-particle:nth-child(3) { left: 68%; top: 34%; animation-delay: 2.2s; }
        .hero-particle:nth-child(4) { left: 84%; top: 20%; animation-delay: 3.5s; }
        .hero-particle:nth-child(5) { left: 74%; top: 68%; animation-delay: 0.8s; }

        .hero-content {
            position: relative;
            z-index: 2;
            padding: 76px 0 92px;
        }

        .hero-kicker {
            display: inline-flex;
            align-items: center;
            gap: 0.65rem;
            padding: 0.5rem 0.7rem;
            border: 1px solid rgba(242, 223, 181, 0.28);
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.09);
            backdrop-filter: blur(16px);
            color: rgba(255, 255, 255, 0.88);
            font-size: 0.82rem;
            font-weight: 800;
        }

        .hero-title {
            max-width: 980px;
            font-size: clamp(2.55rem, 6vw, 5.75rem);
            line-height: 0.98;
            font-weight: 900;
            margin: 1.35rem 0 1.35rem;
        }

        .hero-copy {
            max-width: 720px;
            color: rgba(255, 255, 255, 0.76);
            font-size: clamp(1.04rem, 1.6vw, 1.28rem);
            line-height: 1.75;
        }

        .hero-panel {
            position: relative;
            z-index: 2;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.22);
            border-radius: 8px;
            backdrop-filter: blur(22px);
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.24);
            overflow: hidden;
        }

        .hero-panel::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.18), transparent 42%);
            pointer-events: none;
        }

        .hero-stat {
            border-top: 1px solid rgba(255, 255, 255, 0.14);
            padding-top: 1rem;
        }

        .hero-stat strong {
            display: block;
            color: #fff;
            font-size: 2rem;
            font-weight: 900;
        }

        .hero-stat span {
            color: rgba(255, 255, 255, 0.66);
            font-size: 0.88rem;
        }

        .trust-strip {
            margin-top: -38px;
            position: relative;
            z-index: 4;
        }

        .trust-card {
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(219, 228, 238, 0.86);
            border-radius: 8px;
            box-shadow: 0 26px 70px rgba(7, 27, 47, 0.12);
            backdrop-filter: blur(18px);
        }

        .finance-visual {
            min-height: 430px;
            position: relative;
            overflow: hidden;
            background:
                linear-gradient(145deg, rgba(7, 27, 47, 0.97), rgba(21, 94, 138, 0.84)),
                radial-gradient(circle at 20% 20%, rgba(201, 164, 92, 0.24), transparent 18rem);
        }

        .finance-visual .line {
            position: absolute;
            left: 10%;
            right: 10%;
            height: 1px;
            background: rgba(255, 255, 255, 0.12);
        }

        .finance-visual .line:nth-child(1) { top: 24%; }
        .finance-visual .line:nth-child(2) { top: 46%; }
        .finance-visual .line:nth-child(3) { top: 68%; }

        .chart-path {
            position: absolute;
            left: 9%;
            right: 9%;
            top: 24%;
            height: 210px;
            border-bottom: 2px solid rgba(242, 223, 181, 0.72);
            clip-path: polygon(0 80%, 16% 66%, 30% 71%, 44% 42%, 58% 50%, 74% 20%, 100% 8%, 100% 100%, 0 100%);
            background: linear-gradient(to top, rgba(201, 164, 92, 0.24), transparent);
            animation: chartGlow 4.8s ease-in-out infinite alternate;
        }

        .floating-note {
            position: absolute;
            width: min(230px, 44%);
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.12);
            color: #fff;
            backdrop-filter: blur(18px);
            box-shadow: 0 20px 52px rgba(0, 0, 0, 0.22);
            animation: softFloat 6s ease-in-out infinite;
        }

        .floating-note.one { left: 8%; top: 9%; }
        .floating-note.two { right: 7%; bottom: 10%; animation-delay: 1.2s; }

        .number-badge {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            color: var(--navy);
            box-shadow: 0 12px 30px rgba(7, 27, 47, 0.1);
            font-weight: 900;
        }

        .process-line {
            position: relative;
        }

        .process-line::before {
            content: '';
            position: absolute;
            top: 31px;
            left: 8%;
            right: 8%;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(21, 94, 138, 0.32), transparent);
        }

        .logo-pill {
            border: 1px solid rgba(7, 27, 47, 0.08);
            border-radius: 8px;
            background: #fff;
            color: #4b5563;
            min-height: 86px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            box-shadow: 0 12px 34px rgba(7, 27, 47, 0.05);
        }

        .testimonial-quote {
            font-size: 1.04rem;
            line-height: 1.75;
            color: #344054;
        }

        .team-avatar {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #e9f1f6, #fff7e4);
            color: var(--navy);
            font-weight: 900;
            font-size: 1.2rem;
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
        }

        .contact-band .container {
            position: relative;
            z-index: 1;
        }

        @keyframes ambientShift {
            from { transform: translate3d(-1%, -1%, 0) scale(1); }
            to { transform: translate3d(1%, 1%, 0) scale(1.03); }
        }

        @keyframes floatParticle {
            0%, 100% { transform: translateY(0); opacity: 0.24; }
            50% { transform: translateY(-22px); opacity: 0.8; }
        }

        @keyframes softFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-14px); }
        }

        @keyframes chartGlow {
            from { filter: drop-shadow(0 0 4px rgba(242, 223, 181, 0.28)); }
            to { filter: drop-shadow(0 0 18px rgba(242, 223, 181, 0.55)); }
        }

        @media (max-width: 991.98px) {
            .premium-hero {
                min-height: auto;
            }

            .hero-content {
                padding: 64px 0 84px;
            }

            .process-line::before {
                display: none;
            }
        }
    </style>
@endpush

@section('content')
    <section class="premium-hero">
        <span class="hero-particle"></span>
        <span class="hero-particle"></span>
        <span class="hero-particle"></span>
        <span class="hero-particle"></span>
        <span class="hero-particle"></span>

        <div class="container hero-content">
            <div class="row g-5 align-items-center">
                <div class="col-xl-8">
                    <div class="hero-kicker reveal">
                        <i class="bi bi-shield-check text-warning"></i>
                        Tư vấn kế toán và thuế cho doanh nghiệp hiện đại
                    </div>
                    <h1 class="hero-title reveal">Chuẩn hóa tài chính. Kiểm soát thuế. Dẫn dắt tăng trưởng.</h1>
                    <p class="hero-copy reveal">
                        THM Consulting đồng hành cùng hộ kinh doanh và doanh nghiệp trong kế toán, thuế, kiểm soát nội bộ và quản trị tài chính với quy trình rõ ràng, bảo mật và chuẩn mực.
                    </p>
                    <div class="d-flex flex-column flex-sm-row gap-3 mt-4 reveal">
                        <a href="#consultation-form" class="btn btn-cta btn-lg"><i class="bi bi-calendar2-check me-2"></i>Đặt lịch tư vấn</a>
                        <a href="#services" class="btn btn-ghost-premium btn-lg"><i class="bi bi-grid-1x2 me-2"></i>Xem năng lực</a>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="hero-panel p-4 p-lg-5 reveal" data-parallax="0.04">
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <span class="logo-tile">
                                <img class="brand-logo" src="{{ asset('images/thm-logo.png') }}" alt="THM logo">
                            </span>
                            <div>
                                <div class="fw-bold fs-5">THM Consulting</div>
                                <div class="text-white-50 small">Accounting | Tax | Advisory</div>
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col-6">
                                <div class="hero-stat">
                                    <strong><span data-counter="24" data-suffix="h">0h</span></strong>
                                    <span>Tiếp nhận hồ sơ</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="hero-stat">
                                    <strong><span data-counter="4" data-suffix="+">0+</span></strong>
                                    <span>Nhóm dịch vụ</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="hero-stat">
                                    <strong><span data-counter="100" data-suffix="%">0%</span></strong>
                                    <span>Bảo mật dữ liệu</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="hero-stat">
                                    <strong><span data-counter="1" data-suffix=":1">0:1</span></strong>
                                    <span>Đầu mối chuyên trách</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="trust-strip">
        <div class="container">
            <div class="trust-card p-4">
                <div class="row g-4 align-items-center text-center text-lg-start">
                    <div class="col-lg-3">
                        <div class="eyebrow mb-1">Trust indicators</div>
                        <div class="fw-bold">Dịch vụ thiết kế cho sự an tâm dài hạn.</div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="fw-black fs-3 text-dark"><span data-counter="98" data-suffix="%">0%</span></div>
                        <div class="section-copy small">Hồ sơ được rà soát theo checklist</div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="fw-black fs-3 text-dark"><span data-counter="12" data-suffix="+">0+</span></div>
                        <div class="section-copy small">Mốc kiểm soát thuế trong năm</div>
                    </div>
                    <div class="col-lg-3">
                        <div class="d-flex justify-content-center justify-content-lg-end gap-2">
                            <span class="badge text-bg-light border px-3 py-2">Bảo mật</span>
                            <span class="badge text-bg-light border px-3 py-2">Đúng hạn</span>
                            <span class="badge text-bg-light border px-3 py-2">Minh bạch</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-pad">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <div class="finance-visual glass-card reveal" data-parallax="0.035">
                        <span class="line"></span>
                        <span class="line"></span>
                        <span class="line"></span>
                        <div class="chart-path"></div>
                        <div class="floating-note one p-3">
                            <div class="small text-white-50">Tax review</div>
                            <div class="fw-bold">Rủi ro được nhận diện sớm</div>
                        </div>
                        <div class="floating-note two p-3">
                            <div class="small text-white-50">Monthly closing</div>
                            <div class="fw-bold">Sổ sách rõ ràng, dễ kiểm soát</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="eyebrow mb-2 reveal">Giới thiệu công ty</div>
                    <h2 class="section-title display-6 mb-3 reveal">Một đối tác tư vấn tài chính vận hành như bộ phận kế toán chuyên nghiệp của bạn.</h2>
                    <p class="section-copy reveal">
                        THM tập trung vào chất lượng hồ sơ, khả năng giải trình và tính kịp thời. Mỗi khách hàng được tiếp cận bằng quy trình rõ đầu việc, rõ thời hạn, rõ trách nhiệm để chủ doanh nghiệp có thể ra quyết định tự tin hơn.
                    </p>
                    <div class="row g-3 mt-3">
                        <div class="col-sm-6 reveal">
                            <div class="glass-card premium-card p-4 h-100">
                                <div class="icon-tile gold mb-3"><i class="bi bi-lock-fill"></i></div>
                                <h3 class="h5 fw-bold">Bảo mật hồ sơ</h3>
                                <p class="section-copy small mb-0">Kiểm soát dữ liệu tài chính, chứng từ và thông tin khách hàng theo nguyên tắc cần biết.</p>
                            </div>
                        </div>
                        <div class="col-sm-6 reveal">
                            <div class="glass-card premium-card p-4 h-100">
                                <div class="icon-tile mb-3"><i class="bi bi-clipboard2-check-fill"></i></div>
                                <h3 class="h5 fw-bold">Chuẩn hóa quy trình</h3>
                                <p class="section-copy small mb-0">Checklist theo kỳ giúp hạn chế bỏ sót nghĩa vụ thuế và thời hạn báo cáo.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="services" class="section-pad bg-white">
        <div class="container">
            <div class="row align-items-end mb-5">
                <div class="col-lg-7">
                    <div class="eyebrow mb-2 reveal">Dịch vụ kế toán & tư vấn thuế</div>
                    <h2 class="section-title display-6 mb-0 reveal">Giải pháp tinh gọn cho từng giai đoạn vận hành.</h2>
                </div>
                <div class="col-lg-5 mt-3 mt-lg-0">
                    <p class="section-copy mb-0 reveal">Từ thiết lập ban đầu, kê khai định kỳ đến rà soát rủi ro và tư vấn quản trị, THM xây dựng phạm vi dịch vụ theo đúng nhu cầu thực tế.</p>
                </div>
            </div>
            <div class="row g-4">
                @foreach($services as $service)
                    <div class="col-md-6 col-xl-3 reveal">
                        <article class="service-card premium-card h-100 p-4">
                            <div class="service-icon mb-4">
                                @if($service->slug === 'tu-van-thue')
                                    <i class="bi bi-calculator fs-4"></i>
                                @elseif($service->slug === 'ke-toan-tron-goi')
                                    <i class="bi bi-journal-text fs-4"></i>
                                @elseif($service->slug === 'kiem-toan-noi-bo')
                                    <i class="bi bi-shield-check fs-4"></i>
                                @else
                                    <i class="bi bi-diagram-3 fs-4"></i>
                                @endif
                            </div>
                            <h3 class="h5 fw-bold mb-3">{{ $service->name }}</h3>
                            <p class="section-copy small mb-4">{{ $service->short_description }}</p>
                            <a href="{{ route('services.index') }}" class="fw-bold text-decoration-none">Chi tiết <i class="bi bi-arrow-right ms-1"></i></a>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-pad">
        <div class="container">
            <div class="text-center mb-5">
                <div class="eyebrow mb-2 reveal">Vì sao chọn chúng tôi</div>
                <h2 class="section-title display-6 mb-3 reveal">Chuyên môn cao, giao tiếp rõ ràng, trải nghiệm làm việc cao cấp.</h2>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3 reveal">
                    <div class="glass-card premium-card p-4 h-100">
                        <div class="icon-tile gold mb-4"><i class="bi bi-award-fill"></i></div>
                        <h3 class="h5 fw-bold">Chuẩn mực nghề nghiệp</h3>
                        <p class="section-copy small mb-0">Ưu tiên tính đúng, đủ, kịp thời và khả năng giải trình của từng hồ sơ.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 reveal">
                    <div class="glass-card premium-card p-4 h-100">
                        <div class="icon-tile mb-4"><i class="bi bi-graph-up-arrow"></i></div>
                        <h3 class="h5 fw-bold">Tư duy quản trị</h3>
                        <p class="section-copy small mb-0">Không chỉ ghi nhận số liệu, chúng tôi giúp bạn nhìn thấy rủi ro và điểm cần tối ưu.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 reveal">
                    <div class="glass-card premium-card p-4 h-100">
                        <div class="icon-tile mb-4"><i class="bi bi-clock-history"></i></div>
                        <h3 class="h5 fw-bold">Theo dõi đúng hạn</h3>
                        <p class="section-copy small mb-0">Nhắc hạn, cập nhật tiến độ và chuẩn bị hồ sơ theo lịch làm việc thống nhất.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 reveal">
                    <div class="glass-card premium-card p-4 h-100">
                        <div class="icon-tile gold mb-4"><i class="bi bi-person-check-fill"></i></div>
                        <h3 class="h5 fw-bold">Đầu mối chuyên trách</h3>
                        <p class="section-copy small mb-0">Một kênh trao đổi rõ ràng giúp giảm nhiễu và tăng tốc xử lý công việc.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-pad bg-white">
        <div class="container">
            <div class="row g-5 align-items-start">
                <div class="col-lg-4">
                    <div class="eyebrow mb-2 reveal">Quy trình làm việc</div>
                    <h2 class="section-title display-6 mb-3 reveal">Mượt, minh bạch và kiểm soát được.</h2>
                    <p class="section-copy reveal">Quy trình được thiết kế để khách hàng dễ nắm tiến độ và biết chính xác cần chuẩn bị gì ở từng mốc.</p>
                </div>
                <div class="col-lg-8">
                    <div class="row g-4 process-line">
                        @foreach([
                            ['01', 'Khảo sát', 'Ghi nhận ngành nghề, tình trạng hồ sơ, thời hạn và nhu cầu ưu tiên.'],
                            ['02', 'Rà soát', 'Kiểm tra chứng từ, sổ sách, hóa đơn, báo cáo và các rủi ro cần xử lý.'],
                            ['03', 'Đề xuất', 'Thống nhất phạm vi, lịch bàn giao, đầu mối phụ trách và chi phí triển khai.'],
                            ['04', 'Đồng hành', 'Theo dõi định kỳ, nhắc hạn và hỗ trợ giải trình khi phát sinh yêu cầu.'],
                        ] as [$number, $title, $copy])
                            <div class="col-md-6 col-xl-3 reveal">
                                <div class="position-relative text-center text-md-start">
                                    <span class="number-badge mb-3">{{ $number }}</span>
                                    <h3 class="h5 fw-bold">{{ $title }}</h3>
                                    <p class="section-copy small mb-0">{{ $copy }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-pad">
        <div class="container">
            <div class="row align-items-center g-4 mb-5">
                <div class="col-lg-6">
                    <div class="eyebrow mb-2 reveal">Khách hàng / đối tác</div>
                    <h2 class="section-title display-6 mb-0 reveal">Đồng hành với nhiều mô hình kinh doanh cần sự chắc chắn về tài chính.</h2>
                </div>
                <div class="col-lg-6">
                    <p class="section-copy mb-0 reveal">THM phù hợp với hộ kinh doanh, doanh nghiệp dịch vụ, thương mại, sản xuất nhỏ và đội ngũ quản lý cần số liệu kế toán đáng tin cậy.</p>
                </div>
            </div>
            <div class="row g-3">
                @foreach(['Retail Group', 'Service Co.', 'Local Business', 'Trading Hub', 'Family Office', 'Growth SME'] as $partner)
                    <div class="col-6 col-lg-2 reveal">
                        <div class="logo-pill">{{ $partner }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-pad bg-white">
        <div class="container">
            <div class="text-center mb-5">
                <div class="eyebrow mb-2 reveal">Testimonials</div>
                <h2 class="section-title display-6 reveal">Khách hàng đánh giá cao sự rõ ràng và ổn định.</h2>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 reveal">
                    <div class="service-card premium-card p-4 h-100">
                        <p class="testimonial-quote">“THM giúp chúng tôi nắm được tình trạng hồ sơ từng tháng, không còn bị động khi đến hạn báo cáo.”</p>
                        <div class="fw-bold mt-4">Chủ hộ kinh doanh thương mại</div>
                        <div class="section-copy small">Yên Thành, Nghệ An</div>
                    </div>
                </div>
                <div class="col-lg-4 reveal">
                    <div class="service-card premium-card p-4 h-100">
                        <p class="testimonial-quote">“Cách làm việc rất rõ ràng: đầu việc, thời hạn và chứng từ cần chuẩn bị đều được thống nhất trước.”</p>
                        <div class="fw-bold mt-4">Giám đốc doanh nghiệp dịch vụ</div>
                        <div class="section-copy small">Nghệ An</div>
                    </div>
                </div>
                <div class="col-lg-4 reveal">
                    <div class="service-card premium-card p-4 h-100">
                        <p class="testimonial-quote">“Điểm chúng tôi đánh giá cao là khả năng cảnh báo rủi ro thuế sớm, trước khi vấn đề trở nên phức tạp.”</p>
                        <div class="fw-bold mt-4">Quản lý vận hành SME</div>
                        <div class="section-copy small">Khu vực Bắc Trung Bộ</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-pad">
        <div class="container">
            <div class="row g-5 align-items-end mb-5">
                <div class="col-lg-7">
                    <div class="eyebrow mb-2 reveal">Team chuyên gia</div>
                    <h2 class="section-title display-6 mb-0 reveal">Đội ngũ tập trung vào sự chính xác và trách nhiệm nghề nghiệp.</h2>
                </div>
                <div class="col-lg-5">
                    <p class="section-copy mb-0 reveal">Mỗi vai trò phụ trách một lớp kiểm soát: chứng từ, kê khai, rà soát thuế và tư vấn quản trị.</p>
                </div>
            </div>
            <div class="row g-4">
                @foreach([
                    ['TA', 'Tax Advisor', 'Tư vấn cấu trúc thuế, nghĩa vụ kê khai và rủi ro cần lưu ý.'],
                    ['AC', 'Accounting Lead', 'Thiết lập sổ sách, kiểm tra chứng từ và chuẩn hóa báo cáo.'],
                    ['IC', 'Internal Control', 'Rà soát quy trình, đối chiếu số liệu và kiểm soát nội bộ.'],
                ] as [$initials, $role, $copy])
                    <div class="col-md-4 reveal">
                        <div class="glass-card premium-card p-4 h-100">
                            <div class="team-avatar mb-4">{{ $initials }}</div>
                            <h3 class="h5 fw-bold">{{ $role }}</h3>
                            <p class="section-copy small mb-0">{{ $copy }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="consultation-form" class="section-pad contact-band">
        <div class="container">
            <div class="row g-5 align-items-start">
                <div class="col-lg-5">
                    <div class="eyebrow gold mb-2 reveal">Booking consultation</div>
                    <h2 class="display-6 fw-black mb-3 reveal">Đặt lịch tư vấn để rà soát hồ sơ và định hướng phương án phù hợp.</h2>
                    <p class="text-white-50 mb-4 reveal">Gửi thông tin cơ bản, THM sẽ liên hệ lại qua số điện thoại hoặc email bạn cung cấp để trao đổi chi tiết hơn.</p>
                    <div class="glass-card p-4 reveal">
                        <div class="d-flex gap-3 mb-4">
                            <div class="contact-icon"><i class="bi bi-telephone-fill"></i></div>
                            <div>
                                <div class="small text-muted">Hotline</div>
                                <a class="h5 fw-bold text-decoration-none" href="tel:{{ \App\Models\SystemSetting::getValue('hotline', config('company.hotline')) }}">{{ \App\Models\SystemSetting::getValue('hotline', config('company.hotline')) }}</a>
                            </div>
                        </div>
                        <div class="d-flex gap-3">
                            <div class="contact-icon"><i class="bi bi-envelope-fill"></i></div>
                            <div>
                                <div class="small text-muted">Email</div>
                                <a class="fw-bold text-decoration-none" href="mailto:{{ \App\Models\SystemSetting::getValue('email', config('company.email')) }}">{{ \App\Models\SystemSetting::getValue('email', config('company.email')) }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="info-card p-4 p-lg-5 reveal">
                        @include('partials.consultation-form', ['idPrefix' => 'home', 'variant' => 'light'])
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
