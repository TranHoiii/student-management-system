@php
    $formVariant = $variant ?? 'light';
    $inputClass = $formVariant === 'white' ? 'bg-white' : 'bg-light';
@endphp

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

<form action="{{ route('consultations.store') }}" method="POST" class="consultation-form">
    @csrf

    <div class="row g-3">
        <div class="col-md-6">
            <label for="{{ $idPrefix ?? 'main' }}_full_name" class="form-label">Họ và tên <span class="text-danger">*</span></label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person"></i></span>
                <input type="text" class="form-control {{ $inputClass }} @error('full_name') is-invalid @enderror" id="{{ $idPrefix ?? 'main' }}_full_name" name="full_name" value="{{ old('full_name') }}" placeholder="Nguyễn Văn A" required>
                @error('full_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <label for="{{ $idPrefix ?? 'main' }}_phone" class="form-label">Số điện thoại <span class="text-danger">*</span></label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                <input type="tel" class="form-control {{ $inputClass }} @error('phone') is-invalid @enderror" id="{{ $idPrefix ?? 'main' }}_phone" name="phone" value="{{ old('phone') }}" placeholder="0986039287" required>
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <label for="{{ $idPrefix ?? 'main' }}_email" class="form-label">Email</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                <input type="email" class="form-control {{ $inputClass }} @error('email') is-invalid @enderror" id="{{ $idPrefix ?? 'main' }}_email" name="email" value="{{ old('email') }}" placeholder="email@example.com">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <label for="{{ $idPrefix ?? 'main' }}_company_name" class="form-label">Doanh nghiệp / Hộ kinh doanh</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-building"></i></span>
                <input type="text" class="form-control {{ $inputClass }} @error('company_name') is-invalid @enderror" id="{{ $idPrefix ?? 'main' }}_company_name" name="company_name" value="{{ old('company_name') }}" placeholder="HKD hoặc công ty của bạn">
                @error('company_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-12">
            <label for="{{ $idPrefix ?? 'main' }}_service_id" class="form-label">Dịch vụ cần tư vấn <span class="text-danger">*</span></label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-briefcase"></i></span>
                <select class="form-select {{ $inputClass }} @error('service_id') is-invalid @enderror" id="{{ $idPrefix ?? 'main' }}_service_id" name="service_id" required>
                    <option value="" disabled {{ old('service_id') ? '' : 'selected' }}>Chọn dịch vụ phù hợp</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>{{ $service->name }}</option>
                    @endforeach
                </select>
                @error('service_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-12">
            <label for="{{ $idPrefix ?? 'main' }}_message" class="form-label">Nội dung yêu cầu <span class="text-danger">*</span></label>
            <textarea class="form-control {{ $inputClass }} @error('message') is-invalid @enderror" id="{{ $idPrefix ?? 'main' }}_message" name="message" rows="5" placeholder="Mô tả ngắn nhu cầu kế toán, thuế hoặc vấn đề cần hỗ trợ..." required>{{ old('message') }}</textarea>
            @error('message')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-cta btn-lg w-100">
                <i class="bi bi-send-fill me-2"></i>Gửi yêu cầu tư vấn
            </button>
        </div>
    </div>
</form>
