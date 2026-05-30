@extends('layouts.app')

@section('title', 'Dịch vụ kế toán, thuế và kiểm soát nội bộ - THM')

@section('content')
    <section class="page-banner">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-8">
                    <div class="eyebrow text-warning mb-2">Danh mục dịch vụ</div>
                    <h1 class="display-5 fw-bold mb-3">Dịch vụ kế toán, thuế và quản trị cho hộ kinh doanh, doanh nghiệp.</h1>
                    <p class="lead text-white-50 mb-0">THM hỗ trợ từ tư vấn ban đầu, triển khai hồ sơ đến theo dõi định kỳ và làm việc với cơ quan quản lý.</p>
                </div>
                <div class="col-lg-4">
                    <div class="banner-logo-card glass-card p-4 text-center">
                        <div class="d-flex flex-column align-items-center gap-3">
                            <img class="banner-logo" src="{{ asset('images/thm-logo.png') }}" alt="THM logo">
                            <div>
                                <div class="fw-black text-dark fs-4">THM Consulting</div>
                                <div class="section-copy small">Chuẩn mực kế toán | Trọn vẹn niềm tin</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-pad bg-white">
        <div class="container">
            <div class="row g-4">
                @foreach($services as $index => $service)
                    <div class="col-12">
                        <article class="service-card premium-card p-4 p-lg-5">
                            <div class="row g-4 align-items-start">
                                <div class="col-lg-2">
                                    <div class="service-icon fs-3">
                                        @if($service->slug === 'tu-van-thue')
                                            <i class="bi bi-calculator"></i>
                                        @elseif($service->slug === 'ke-toan-tron-goi')
                                            <i class="bi bi-journal-text"></i>
                                        @elseif($service->slug === 'kiem-toan-noi-bo')
                                            <i class="bi bi-shield-check"></i>
                                        @else
                                            <i class="bi bi-diagram-3"></i>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-10">
                                    <div class="d-flex flex-column flex-md-row justify-content-md-between gap-3 mb-3">
                                        <div>
                                            <div class="eyebrow mb-2">Dịch vụ {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</div>
                                            <h2 class="h3 fw-bold mb-0">{{ $service->name }}</h2>
                                        </div>
                                        <a href="{{ route('contact') }}" class="btn btn-soft align-self-md-start">Tư vấn dịch vụ này</a>
                                    </div>
                                    <p class="section-copy fs-6 mb-4">{{ $service->description }}</p>
                                    <div class="row g-3">
                                        <div class="col-md-6 col-xl-3"><i class="bi bi-check-circle-fill text-success me-2"></i>Rà soát hồ sơ</div>
                                        <div class="col-md-6 col-xl-3"><i class="bi bi-check-circle-fill text-success me-2"></i>Báo cáo đúng hạn</div>
                                        <div class="col-md-6 col-xl-3"><i class="bi bi-check-circle-fill text-success me-2"></i>Tư vấn rõ ràng</div>
                                        <div class="col-md-6 col-xl-3"><i class="bi bi-check-circle-fill text-success me-2"></i>Đồng hành định kỳ</div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-pad contact-band">
        <div class="container text-center text-white">
            <div class="eyebrow gold mb-2">Cần tư vấn nhanh?</div>
            <h2 class="display-6 fw-black mb-3">Gửi thông tin để THM đề xuất phương án phù hợp.</h2>
            <p class="lead text-white-50 mb-4">Bạn chỉ cần mô tả ngắn tình trạng hiện tại, phần còn lại THM sẽ hỗ trợ rà soát và hướng dẫn.</p>
            <a href="{{ route('contact') }}" class="btn btn-light btn-lg fw-bold rounded-2"><i class="bi bi-chat-dots me-2"></i>Nhận tư vấn miễn phí</a>
        </div>
    </section>
@endsection
