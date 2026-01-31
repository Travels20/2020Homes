<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\LogController;
use App\Http\Controllers\Vendor\PropertyController as VendorPropertyController;

use App\Http\Controllers\PageController;

// Public Routes
Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/properties', [PageController::class, 'properties'])->name('front.properties');
Route::get('/about', [PageController::class, 'about'])->name('front.about');
Route::get('/contact', [PageController::class, 'contact'])->name('front.contact');
Route::get('/nri-property', [PageController::class, 'nriProperty'])->name('front.nri-property');
Route::post('/nri-property/submit', [PageController::class, 'submitNriForm'])->name('nri.submit');
Route::get('/property/{slug}', [PageController::class, 'show'])->name('property.show');
Route::post('/appointment', [PageController::class, 'storeAppointment'])->name('appointment.store');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Vendor/Partner Routes
Route::get('/post-property-free', [AuthController::class, 'showVendorLogin'])->name('vendor.register.page');
Route::post('/send-otp', [AuthController::class, 'sendOTP'])->name('otp.send');
Route::post('/verify-otp', [AuthController::class, 'verifyOTP'])->name('otp.verify');

// Dashboard Routes (Protected)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Admin + Staff Routes
    Route::middleware('role:admin,superadmin,staff')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

            // Enquiries list (admin + staff)
            Route::get('/enquiries', [DashboardController::class, 'enquiries'])->name('enquiries.index');

        // Walk-in Enquiry (admin + staff)
        Route::get('/enquiries/walk-in', [DashboardController::class, 'walkInForm'])->name('enquiries.walk-in');
        Route::post('/enquiries/walk-in', [DashboardController::class, 'storeWalkIn'])->name('enquiries.store-walk-in');

        // Users list (admin + staff)
        Route::get('/users', [DashboardController::class, 'users'])->name('users.index');

        // Staff can only see their own properties here
        Route::get('/my-properties', [\App\Http\Controllers\Admin\PropertyController::class, 'myProperties'])
            ->name('my-properties');

        // Create/Edit/View allowed for admin/superadmin/staff
        Route::resource('properties', \App\Http\Controllers\Admin\PropertyController::class)
            ->except(['index', 'destroy']);

        // Admin-only routes (global list + delete + settings/logs)
        Route::middleware('role:admin,superadmin')->group(function () {
            Route::get('/properties', [\App\Http\Controllers\Admin\PropertyController::class, 'index'])->name('properties.index');
            Route::delete('/properties/{property}', [\App\Http\Controllers\Admin\PropertyController::class, 'destroy'])->name('properties.destroy');

            // Site Settings
            Route::get('/settings', [\App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('settings.index');
            Route::post('/settings/update', [\App\Http\Controllers\Admin\SettingsController::class, 'update'])->name('settings.update');

            // Logs
            Route::get('/logs', [LogController::class, 'index'])->name('logs.index');
        });
    });

    // Vendor Routes
    Route::middleware('role:vendor')->prefix('vendor')->name('vendor.')->group(function () {
        Route::get('/', function () {
            return view('dashboards.vendor.index');
        })->name('dashboard');

        // Vendor properties: create + edit only (no delete)
        Route::resource('properties', VendorPropertyController::class)->only(['index', 'create', 'store', 'edit', 'update']);
    });
});
