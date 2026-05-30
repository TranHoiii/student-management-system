@extends('layouts.app')

@section('title', 'Quản Lý Yêu Cầu Tư Vấn - THM Consulting Portal')

@section('content')
    <!-- Banner Dashboard -->
    <section class="page-banner py-4 mb-4">
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                <div>
                    <h1 class="h2 fw-bold mb-1 text-white"><i class="bi bi-speedometer2 me-2"></i>Bảng Điều Khiển Quản Trị</h1>
                    <p class="mb-0 text-white-50 small">Quản lý và tiếp nhận các yêu cầu tư vấn kế toán, thuế của khách hàng</p>
                </div>
                <div class="mt-3 mt-md-0 d-flex gap-2">
                    <span class="btn btn-outline-light disabled border-0 text-white"><i class="bi bi-person-circle me-1"></i> Admin</span>
                    <form action="{{ route('admin.logout') }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn đăng xuất tài khoản?');">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm rounded-pill px-3 py-2">
                            <i class="bi bi-box-arrow-right me-1"></i> Đăng xuất
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Dashboard Section -->
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

            <!-- Stats summary counts -->
            <div class="row g-3 mb-4">
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm rounded-3 p-3 bg-white text-center">
                        <h6 class="text-muted small text-uppercase mb-1">Tổng yêu cầu</h6>
                        <h3 class="fw-bold mb-0 text-dark">{{ \App\Models\ConsultationRequest::count() }}</h3>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm rounded-3 p-3 bg-warning-subtle text-center">
                        <h6 class="text-warning-emphasis small text-uppercase mb-1">Đang chờ xử lý</h6>
                        <h3 class="fw-bold mb-0 text-warning-emphasis">{{ \App\Models\ConsultationRequest::where('status', 'pending')->count() }}</h3>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm rounded-3 p-3 bg-primary-subtle text-center">
                        <h6 class="text-primary-emphasis small text-uppercase mb-1">Đang thực hiện</h6>
                        <h3 class="fw-bold mb-0 text-primary-emphasis">{{ \App\Models\ConsultationRequest::where('status', 'processing')->count() }}</h3>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm rounded-3 p-3 bg-success-subtle text-center">
                        <h6 class="text-success-emphasis small text-uppercase mb-1">Đã hoàn thành</h6>
                        <h3 class="fw-bold mb-0 text-success-emphasis">{{ \App\Models\ConsultationRequest::where('status', 'completed')->count() }}</h3>
                    </div>
                </div>
            </div>

            <!-- Filter Status Bar -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-3">
                    <div class="d-flex flex-wrap gap-2 align-items-center">
                        <span class="text-muted small fw-semibold me-2"><i class="bi bi-filter-left me-1"></i> Bộ lọc trạng thái:</span>
                        <a href="{{ route('admin.consultations.index') }}" class="btn btn-sm rounded-pill {{ !$status ? 'btn-primary' : 'btn-light' }}">
                            Tất cả
                        </a>
                        <a href="{{ route('admin.consultations.index', ['status' => 'pending']) }}" class="btn btn-sm rounded-pill {{ $status === 'pending' ? 'btn-warning text-dark' : 'btn-light' }}">
                            Chờ xử lý ({{ \App\Models\ConsultationRequest::where('status', 'pending')->count() }})
                        </a>
                        <a href="{{ route('admin.consultations.index', ['status' => 'processing']) }}" class="btn btn-sm rounded-pill {{ $status === 'processing' ? 'btn-primary' : 'btn-light' }}">
                            Đang xử lý ({{ \App\Models\ConsultationRequest::where('status', 'processing')->count() }})
                        </a>
                        <a href="{{ route('admin.consultations.index', ['status' => 'completed']) }}" class="btn btn-sm rounded-pill {{ $status === 'completed' ? 'btn-success' : 'btn-light' }}">
                            Đã hoàn thành ({{ \App\Models\ConsultationRequest::where('status', 'completed')->count() }})
                        </a>
                        <a href="{{ route('admin.consultations.index', ['status' => 'cancelled']) }}" class="btn btn-sm rounded-pill {{ $status === 'cancelled' ? 'btn-danger' : 'btn-light' }}">
                            Đã hủy ({{ \App\Models\ConsultationRequest::where('status', 'cancelled')->count() }})
                        </a>
                    </div>
                </div>
            </div>

            <!-- Requests Table Card -->
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="fw-bold mb-0 text-dark"><i class="bi bi-list-task me-2 text-primary"></i>Danh Sách Yêu Cầu Gửi Đến</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light text-muted uppercase small">
                                <tr>
                                    <th class="ps-4">Họ và Tên</th>
                                    <th>Số Điện Thoại</th>
                                    <th>Doanh nghiệp</th>
                                    <th>Dịch Vụ Cần Tư Vấn</th>
                                    <th>Trạng Thái</th>
                                    <th>Ngày Tạo</th>
                                    <th class="text-end pe-4">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($consultations as $item)
                                    <tr>
                                        <!-- Khách hàng -->
                                        <td class="ps-4">
                                            <div class="fw-bold text-dark">{{ $item->full_name }}</div>
                                            @if($item->email)
                                                <div class="text-muted small" style="font-size: 0.8rem;"><i class="bi bi-envelope me-1"></i>{{ $item->email }}</div>
                                            @endif
                                        </td>
                                        <!-- Điện thoại -->
                                        <td>
                                            <a href="tel:{{ $item->phone }}" class="text-decoration-none text-dark fw-semibold">
                                                <i class="bi bi-telephone me-1 text-primary-light"></i>{{ $item->phone }}
                                            </a>
                                        </td>
                                        <!-- Doanh nghiệp -->
                                        <td class="text-muted small">
                                            {{ $item->company_name ?: '-' }}
                                        </td>
                                        <!-- Dịch vụ -->
                                        <td>
                                            <span class="badge bg-secondary-subtle text-secondary-emphasis">
                                                {{ $item->service->name }}
                                            </span>
                                        </td>
                                        <!-- Trạng thái -->
                                        <td>
                                            @if($item->status === 'pending')
                                                <span class="badge bg-warning text-dark"><i class="bi bi-hourglass-split me-1"></i>Chờ xử lý</span>
                                            @elseif($item->status === 'processing')
                                                <span class="badge bg-primary"><i class="bi bi-arrow-repeat me-1"></i>Đang xử lý</span>
                                            @elseif($item->status === 'completed')
                                                <span class="badge bg-success"><i class="bi bi-check-lg me-1"></i>Đã hoàn thành</span>
                                            @elseif($item->status === 'cancelled')
                                                <span class="badge bg-danger"><i class="bi bi-x-circle me-1"></i>Đã hủy</span>
                                            @endif
                                        </td>
                                        <!-- Ngày tạo -->
                                        <td class="text-muted small" style="font-size: 0.85rem;">
                                            {{ $item->created_at->format('H:i d/m/Y') }}
                                        </td>
                                        <!-- Nút Thao tác -->
                                        <td class="text-end pe-4">
                                            <a href="{{ route('admin.consultations.show', $item->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 me-1">
                                                <i class="bi bi-eye-fill"></i> Chi tiết
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5 text-muted">
                                            <i class="bi bi-inbox fs-1 d-block mb-3 opacity-25"></i>
                                            Không có yêu cầu tư vấn nào được tìm thấy.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Pagination footer link -->
                @if($consultations->hasPages())
                    <div class="card-footer bg-white border-top py-3">
                        <div class="d-flex justify-content-center">
                            {!! $consultations->links() !!}
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </section>
@endsection
