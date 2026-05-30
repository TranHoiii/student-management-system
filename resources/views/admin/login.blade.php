<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập Quản Trị - THM Consulting</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@600;800&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #f8fafc;
        }
        .login-card {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
            max-width: 420px;
            width: 100%;
            padding: 40px 30px;
        }
        .brand-logo {
            font-family: 'Outfit', sans-serif;
            font-weight: 800;
            font-size: 1.8rem;
            color: #38bdf8;
            letter-spacing: -0.5px;
            text-align: center;
            margin-bottom: 30px;
        }
        .brand-logo span {
            color: #fb923c;
        }
        .form-control-custom {
            background-color: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #f8fafc;
            border-radius: 10px;
            padding: 12px 16px;
            transition: all 0.3s;
        }
        .form-control-custom:focus {
            background-color: rgba(15, 23, 42, 0.8);
            border-color: #38bdf8;
            color: #f8fafc;
            box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.2);
        }
        .btn-login {
            background: linear-gradient(135deg, #0284c7 0%, #0ea5e9 100%);
            color: #ffffff;
            border: none;
            font-weight: 600;
            padding: 12px;
            border-radius: 10px;
            transition: all 0.3s;
        }
        .btn-login:hover {
            filter: brightness(1.1);
            transform: translateY(-1px);
        }
        .custom-alert {
            background-color: rgba(239, 68, 68, 0.2);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
            border-radius: 10px;
        }
        .custom-alert-success {
            background-color: rgba(34, 197, 94, 0.2);
            border: 1px solid rgba(34, 197, 94, 0.3);
            color: #86efac;
            border-radius: 10px;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="brand-logo">
            <i class="bi bi-shield-lock-fill me-2"></i>THM<span>.PORTAL</span>
        </div>
        
        <h4 class="text-center fw-bold mb-4">Đăng Nhập Hệ Thống</h4>

        <!-- Alerts -->
        @if(session('error'))
            <div class="alert custom-alert d-flex align-items-center mb-4" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <div class="small">{{ session('error') }}</div>
            </div>
        @endif

        @if(session('success'))
            <div class="alert custom-alert-success d-flex align-items-center mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                <div class="small">{{ session('success') }}</div>
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf

            <!-- Email Address -->
            <div class="mb-3">
                <label for="email" class="form-label small fw-semibold text-white-50">Tài khoản Email</label>
                <input type="email" class="form-control form-control-custom @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="admin@thm.vn" required autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <div class="d-flex justify-content-between">
                    <label for="password" class="form-label small fw-semibold text-white-50">Mật khẩu bảo mật</label>
                </div>
                <input type="password" class="form-control form-control-custom @error('password') is-invalid @enderror" id="password" name="password" placeholder="••••••••" required>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Remember me checkbox -->
            <div class="form-check mb-4">
                <input class="form-check-input bg-transparent border-secondary" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label small text-white-50" for="remember">
                    Duy trì đăng nhập trên thiết bị này
                </label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-login w-100 mb-3">
                <i class="bi bi-box-arrow-in-right me-2"></i>Xác Nhận Đăng Nhập
            </button>
            
            <div class="text-center">
                <a href="{{ route('home') }}" class="text-decoration-none text-white-50 small"><i class="bi bi-arrow-left me-1"></i> Quay về Trang chủ</a>
            </div>
        </form>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
