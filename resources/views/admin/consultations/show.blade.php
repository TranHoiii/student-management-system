@extends('layouts.app')

@section('title', 'Chi Tiết Yêu Cầu Tư Vấn - THM Consulting Portal')

@section('content')
    <!-- Banner Dashboard -->
    <section class="page-banner py-4 mb-4">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 fw-bold mb-1 text-white"><i class="bi bi-file-text me-2"></i>Chi Tiết Yêu Cầu Tư Vấn</h1>
                    <p class="mb-0 text-white-50 small">Quản lý nội dung chi tiết và cập nhật trạng thái xử lý hồ sơ khách hàng</p>
                </div>
                <div>
                    <a href="{{ route('admin.consultations.index') }}" class="btn btn-outline-light rounded-pill btn-sm px-3">
                        <i class="bi bi-arrow-left me-1"></i> Quay về danh sách
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Content Detail -->
    <section class="pb-5">
        <div class="container">
            
            <!-- System Notifications -->
            @if(session('success'))
                <div class="alert alert-success custom-alert d-flex align-items-center mb-4" role="alert">
                    <i class="bi bi-check-circle-fill fs-4 me-3"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger custom-alert d-flex align-items-center mb-4" role="alert">
                    <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i>
                    <div>{{ session('error') }}</div>
                </div>
            @endif

            <div class="row g-4">
                
                <!-- Left column: Client details -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-header bg-white border-bottom py-3">
                            <h5 class="fw-bold mb-0 text-dark"><i class="bi bi-person-lines-fill text-primary me-2"></i>Thông Tin Khách Hàng</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <h6 class="text-muted small mb-1">Họ và tên khách hàng:</h6>
                                    <p class="fw-bold text-dark fs-5 mb-0">{{ $consultation->full_name }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-muted small mb-1">Số điện thoại liên hệ:</h6>
                                    <p class="fw-bold text-dark fs-5 mb-0">
                                        <a href="tel:{{ $consultation->phone }}" class="text-decoration-none text-primary">
                                            {{ $consultation->phone }}
                                        </a>
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-muted small mb-1">Địa chỉ Email:</h6>
                                    <p class="text-dark mb-0">{{ $consultation->email ?: 'Không cung cấp' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-muted small mb-1">Doanh nghiệp / Hộ kinh doanh:</h6>
                                    <p class="text-dark mb-0 fw-semibold">{{ $consultation->company_name ?: 'Hộ kinh doanh cá thể/Cá nhân' }}</p>
                                </div>
                                <hr class="my-4 text-muted opacity-25">
                                <div class="col-12">
                                    <h6 class="text-muted small mb-2">Dịch vụ đăng ký:</h6>
                                    <span class="badge bg-primary fs-6 px-3 py-2 rounded-pill mb-3">
                                        {{ $consultation->service->name }}
                                    </span>
                                </div>
                                <div class="col-12">
                                    <h6 class="text-muted small mb-2">Nội dung tin nhắn yêu cầu tư vấn:</h6>
                                    <div class="bg-light p-4 rounded-3 border text-dark" style="white-space: pre-line; line-height: 1.6;">
                                        {{ $consultation->message }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right column: Status update panel -->
                <div class="col-lg-4">
                    <!-- Status panel -->
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-header bg-white border-bottom py-3">
                            <h5 class="fw-bold mb-0 text-dark"><i class="bi bi-gear-fill text-primary me-2"></i>Trạng Thái Yêu Cầu</h5>
                        </div>
                        <div class="card-body p-4">
                            <!-- Current status badge -->
                            <div class="mb-4 text-center">
                                <h6 class="text-muted small mb-2">Trạng thái hiện tại:</h6>
                                @if($consultation->status === 'pending')
                                    <span class="badge bg-warning text-dark fs-6 px-4 py-2"><i class="bi bi-hourglass-split me-1"></i>Chờ xử lý</span>
                                @elseif($consultation->status === 'processing')
                                    <span class="badge bg-primary fs-6 px-4 py-2"><i class="bi bi-arrow-repeat me-1"></i>Đang xử lý</span>
                                @elseif($consultation->status === 'completed')
                                    <span class="badge bg-success fs-6 px-4 py-2"><i class="bi bi-check-lg me-1"></i>Đã hoàn thành</span>
                                @elseif($consultation->status === 'cancelled')
                                    <span class="badge bg-danger fs-6 px-4 py-2"><i class="bi bi-x-circle me-1"></i>Đã hủy</span>
                                @endif
                            </div>

                            <hr class="my-3 text-muted opacity-25">

                            <!-- Status Change Form -->
                            <form action="{{ route('admin.consultations.updateStatus', $consultation->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="status" class="form-label fw-semibold text-dark small">Cập nhật trạng thái mới:</label>
                                    <select class="form-select bg-light" id="status" name="status">
                                        <option value="pending" {{ $consultation->status === 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                                        <option value="processing" {{ $consultation->status === 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                                        <option value="completed" {{ $consultation->status === 'completed' ? 'selected' : '' }}>Đã hoàn thành</option>
                                        <option value="cancelled" {{ $consultation->status === 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 rounded-pill py-2">
                                    <i class="bi bi-floppy-fill me-1"></i> Lưu thay đổi
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Request Log Info panel -->
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body p-4 small">
                            <h6 class="fw-bold mb-3 text-dark"><i class="bi bi-info-circle me-1 text-primary"></i>Thông tin nhật ký</h6>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Ngày gửi yêu cầu:</span>
                                <span class="fw-semibold">{{ $consultation->created_at->format('H:i d/m/Y') }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Lần cập nhật cuối:</span>
                                <span class="fw-semibold">{{ $consultation->updated_at->format('H:i d/m/Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
