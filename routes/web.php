<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ContactMessageController as AdminContactMessageController;
use App\Http\Controllers\Admin\ContactSettingController as AdminContactSettingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Frontend
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Global /login route (redirects to or shows the admin login screen)
Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AdminAuthController::class, 'login']);

// Admin Management Group
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    // Protected Admin Routes
    Route::middleware('auth')->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Contact Messages Management
        Route::get('/messages', [AdminContactMessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/export', [AdminContactMessageController::class, 'export'])->name('messages.export');
        Route::get('/messages/{message}', [AdminContactMessageController::class, 'show'])->name('messages.show');
        Route::patch('/messages/{message}/status', [AdminContactMessageController::class, 'updateStatus'])->name('messages.status');
        Route::patch('/messages/{message}/note', [AdminContactMessageController::class, 'updateNote'])->name('messages.note');
        Route::delete('/messages/{message}', [AdminContactMessageController::class, 'destroy'])->name('messages.destroy');

        // Estate Contact Settings
        Route::get('/settings', [AdminContactSettingController::class, 'index'])->name('settings.index');
        Route::put('/settings', [AdminContactSettingController::class, 'update'])->name('settings.update');
    });
});
