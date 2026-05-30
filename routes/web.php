<?php

use App\Http\Controllers\Admin\AdminConsultationController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Guest Front-end Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/services', [HomeController::class, 'services'])->name('services.index');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/consultations', [ConsultationController::class, 'store'])->name('consultations.store');

// Admin Guest Routes (Authentication)
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Admin Protected Routes
Route::middleware(['admin.auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.consultations.index');
    });
    
    Route::get('/consultations', [AdminConsultationController::class, 'index'])->name('consultations.index');
    Route::get('/consultations/{id}', [AdminConsultationController::class, 'show'])->name('consultations.show');
    Route::post('/consultations/{id}/status', [AdminConsultationController::class, 'updateStatus'])->name('consultations.updateStatus');
});
