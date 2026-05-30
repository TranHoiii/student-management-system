@extends('layouts.app')

@section('title', 'Liên hệ THM - Đăng ký tư vấn kế toán và thuế')

@section('content')
    <section class="page-banner">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-8">
                    <div class="eyebrow text-warning mb-2">Liên hệ và đăng ký</div>
                    <h1 class="display-5 fw-bold mb-3">Trao đổi với THM về hồ sơ kế toán, thuế và quản trị.</h1>
                    <p class="lead text-white-50 mb-0">Gửi thông tin qua form hoặc liên hệ trực tiếp qua hotline, email, Zalo để được phản hồi nhanh.</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <div class="logo-showcase">
                        <img src="{{ asset('images/thm-logo.png') }}" alt="Logo THM">
                        <div class="logo-showcase-caption">Chuẩn mực kế toán | Trọn vẹn niềm tin</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-pad bg-white">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-5">
                    <div class="eyebrow mb-2">Thông tin pháp lý</div>
                    <h2 class="section-title h1 mb-4">Hộ kinh doanh THM</h2>
                    <div class="info-card p-4 mb-4">
                        <div class="mb-3">
                            <div class="small text-muted">Tên hộ kinh doanh</div>
                            <div class="fw-bold">{{ \App\Models\SystemSetting::getValue('company_name', config('company.name')) }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="small text-muted">Mã số thuế / HKD</div>
                            <div class="fw-bold">{{ \App\Models\SystemSetting::getValue('tax_code', config('company.tax_code')) }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="small text-muted">Đại diện pháp luật</div>
                            <div class="fw-bold">{{ \App\Models\SystemSetting::getValue('representative', config('company.representative')) }}</div>
                        </div>
                        <div>
                            <div class="small text-muted">Địa chỉ</div>
                            <div>{{ \App\Models\SystemSetting::getValue('address', config('company.address')) }}</div>
                        </div>
                    </div>

                    <div class="info-card p-4">
                        <div class="d-flex gap-3 mb-4">
                            <div class="contact-icon"><i class="bi bi-telephone-fill"></i></div>
                            <div>
                                <div class="small text-muted">Hotline</div>
                                <a class="h5 fw-bold text-decoration-none" href="tel:{{ \App\Models\SystemSetting::getValue('hotline', config('company.hotline')) }}">{{ \App\Models\SystemSetting::getValue('hotline', config('company.hotline')) }}</a>
                            </div>
                        </div>
                        <div class="d-flex gap-3 mb-4">
                            <div class="contact-icon"><i class="bi bi-envelope-fill"></i></div>
                            <div>
                                <div class="small text-muted">Email</div>
                                <a class="fw-bold text-decoration-none" href="mailto:{{ \App\Models\SystemSetting::getValue('email', config('company.email')) }}">{{ \App\Models\SystemSetting::getValue('email', config('company.email')) }}</a>
                            </div>
                        </div>
                        <a class="btn btn-soft w-100" href="{{ \App\Models\SystemSetting::getValue('zalo_url', config('company.zalo_url')) }}" target="_blank" rel="noopener">
                            <i class="bi bi-chat-dots me-2"></i>Nhắn Zalo ngay
                        </a>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="info-card p-4 p-lg-5">
                        <div class="mb-4">
                            <div class="eyebrow mb-2">Form tư vấn</div>
                            <h2 class="section-title h1 mb-2">Gửi yêu cầu tư vấn</h2>
                            <p class="section-copy mb-0">THM sẽ tiếp nhận thông tin và phản hồi qua số điện thoại hoặc email bạn cung cấp.</p>
                        </div>
                        @include('partials.consultation-form', ['idPrefix' => 'contact', 'variant' => 'white'])
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
