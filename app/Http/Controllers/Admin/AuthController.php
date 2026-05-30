<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Show the admin login form.
     */
    public function showLoginForm()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect()->route('admin.consultations.index');
        }
        return view('admin.login');
    }

    /**
     * Handle admin login request.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Định dạng email không hợp lệ.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            // Check if the authenticated user is an administrator
            if (Auth::user()->role === 'admin') {
                $request->session()->regenerate();
                return redirect()->intended(route('admin.consultations.index'))
                    ->with('success', 'Đăng nhập trang Quản trị thành công. Chào mừng quay trở lại!');
            }

            // If logged in user is not admin, log them out and reject access
            Auth::logout();
            return redirect()->back()
                ->withInput($request->only('email', 'remember'))
                ->with('error', 'Bạn không có quyền truy cập trang quản trị này.');
        }

        return redirect()->back()
            ->withInput($request->only('email', 'remember'))
            ->with('error', 'Tài khoản hoặc mật khẩu không chính xác.');
    }

    /**
     * Handle logout request.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Đã đăng xuất tài khoản thành công.');
    }
}
