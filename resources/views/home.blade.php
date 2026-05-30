@extends('layouts.app')

@section('title', 'THM - Kế toán, thuế và tư vấn quản trị cho doanh nghiệp')

@section('content')
    <section class="hero">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-7">
                    <div class="eyebrow text-warning mb-3">THM Consulting</div>
                    <h1 class="display-4 fw-bold mb-4">Chuẩn hóa kế toán, kiểm soát thuế và quản trị tài chính cho doanh nghiệp.</h1>
                    <p class="lead mb-4 text-white-75" style="max-width: 680px;">
                        {{ \App\Models\SystemSetting::getValue('slogan', config('company.slogan')) }}. Chúng tôi hỗ trợ hộ kinh doanh và doanh nghiệp vận hành sổ sách minh bạch, đúng hạn và giảm rủi ro khi làm việc với cơ quan quản lý.
                    </p>
                    <div class="d-flex flex-column flex-sm-row gap-3">
                        <a href="#consultation-form" class="btn btn-cta btn-lg"><i class="bi bi-chat-square-text me-2"></i>Nhận tư vấn miễn phí</a>
                        <a href="{{ route('services.index') }}" class="btn btn-light btn-lg fw-bold rounded-2"><i class="bi bi-grid-1x2 me-2"></i>Xem dịch vụ</a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="hero-card p-4 p-lg-5">
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <span class="logo-showcase p-2">
                                <img src="{{ asset('images/thm-logo.png') }}" alt="Logo THM" style="width: 150px;">
                            </span>
                            <div>
                                <h2 class="h4 fw-bold mb-1">THM Consulting</h2>
                                <p class="text-muted mb-0">Kế toán, thuế và kiểm soát nội bộ</p>
                                <div class="brand-slogan mt-1">Chuẩn mực kế toán | Trọn vẹn niềm tin</div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-6">
                                <div class="metric">
                                    <strong>24h</strong>
                                    <span class="small text-muted">Tiếp nhận hồ sơ</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="metric">
                                    <strong>4+</strong>
                                    <span class="small text-muted">Nhóm dịch vụ</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="feature-row pt-4 mt-2">
                                    <div class="d-flex gap-3 mb-3"><i class="bi bi-check-circle-fill text-success"></i><span>Rà soát chứng từ, sổ sách và nghĩa vụ thuế định kỳ.</span></div>
                                    <div class="d-flex gap-3 mb-3"><i class="bi bi-check-circle-fill text-success"></i><span>Đại diện chuẩn bị hồ sơ, báo cáo và giải trình khi cần.</span></div>
                                    <div class="d-flex gap-3"><i class="bi bi-check-circle-fill text-success"></i><span>Bảo mật thông tin tài chính và dữ liệu khách hàng.</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-pad bg-white">
        <div class="container">
            <div class="row align-items-end mb-5">
                <div class="col-lg-7">
                    <div class="eyebrow mb-2">Dịch vụ trọng tâm</div>
                    <h2 class="section-title display-6 mb-3">Giải pháp kế toán và thuế theo đúng nhu cầu vận hành.</h2>
                    <p class="section-copy mb-0">Từ hồ sơ ban đầu đến báo cáo định kỳ, THM tập trung vào tính đúng, đủ, kịp thời và dễ kiểm soát cho chủ hộ kinh doanh, kế toán nội bộ và ban quản lý.</p>
                </div>
                <div class="col-lg-5 text-lg-end mt-4 mt-lg-0">
                    <a href="{{ route('services.index') }}" class="btn btn-soft">Xem chi tiết dịch vụ <i class="bi bi-arrow-right ms-2"></i></a>
                </div>
            </div>

            <div class="row g-4">
                @foreach($services as $service)
                    <div class="col-md-6 col-xl-3">
                        <div class="service-card h-100 p-4">
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
                            <p class="section-copy small mb-0">{{ $service->short_description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-pad">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-5">
                    <div class="eyebrow mb-2">Cách THM làm việc</div>
                    <h2 class="section-title display-6 mb-3">Rõ đầu việc, rõ thời hạn, rõ trách nhiệm.</h2>
                    <p class="section-copy">Quy trình được thiết kế để khách hàng dễ theo dõi tiến độ và chủ động chuẩn bị chứng từ cần thiết.</p>
                </div>
                <div class="col-lg-7">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="process-step">
                                <div class="eyebrow mb-2">01</div>
                                <h3 class="h5 fw-bold">Tiếp nhận nhu cầu</h3>
                                <p class="section-copy small mb-0">Ghi nhận thông tin, ngành nghề, tình trạng hồ sơ và thời hạn cần xử lý.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="process-step">
                                <div class="eyebrow mb-2">02</div>
                                <h3 class="h5 fw-bold">Rà soát hồ sơ</h3>
                                <p class="section-copy small mb-0">Kiểm tra chứng từ, sổ sách, hóa đơn, báo cáo và các rủi ro cần ưu tiên.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="process-step">
                                <div class="eyebrow mb-2">03</div>
                                <h3 class="h5 fw-bold">Đề xuất phương án</h3>
                                <p class="section-copy small mb-0">Thống nhất phạm vi công việc, lịch bàn giao và chi phí triển khai.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="process-step">
                                <div class="eyebrow mb-2">04</div>
                                <h3 class="h5 fw-bold">Theo dõi định kỳ</h3>
                                <p class="section-copy small mb-0">Cập nhật tiến độ, nhắc hạn và hỗ trợ giải trình khi phát sinh yêu cầu.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="consultation-form" class="section-pad bg-white">
        <div class="container">
            <div class="row g-5 align-items-start">
                <div class="col-lg-5">
                    <div class="eyebrow mb-2">Đăng ký tư vấn</div>
                    <h2 class="section-title display-6 mb-3">Gửi yêu cầu, THM sẽ liên hệ lại sớm.</h2>
                    <p class="section-copy">Bạn có thể gửi form, gọi hotline hoặc nhắn Zalo để trao đổi trực tiếp hơn về hồ sơ kế toán và thuế.</p>
                    <div class="info-card p-4 mt-4">
                        <div class="d-flex gap-3 mb-3">
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
                    <div class="info-card p-4 p-lg-5">
                        @include('partials.consultation-form', ['idPrefix' => 'home', 'variant' => 'light'])
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
