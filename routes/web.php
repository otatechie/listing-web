<?php

use App\Http\Controllers\AdminAuditController;
use App\Http\Controllers\AdminBackupController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminPermissionController;
use App\Http\Controllers\AdminPermissionRoleController;
use App\Http\Controllers\AdminRoleController;
use App\Http\Controllers\AdminSettingController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MobileDeviceController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PhoneVariantController;
use App\Http\Controllers\ReactionController;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\UserBeatFileController;
use App\Http\Middleware\HandleInertiaRequests;
use Illuminate\Support\Facades\Route;







/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public Routes (No Authentication Required)
Route::controller(PageController::class)
    ->withoutMiddleware(HandleInertiaRequests::class)
    ->name('public.')
    ->group(function () {
        Route::get('help', 'help')->name('help');
    });

// Authenticated Routes
Route::middleware(['web','auth'])->group(function () {
    // Home Route
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // User Account Routes
    Route::name('user.')->group(function () {
        Route::get('user/account', [UserAccountController::class, 'index'])
            ->name('index');
        Route::get('user/two-factor-authentication', [UserAccountController::class, 'twoFactorAuthentication'])
            ->name('two.factor');
        Route::get('user/listing', [UserAccountController::class, 'userListing'])
            ->name('listing');
    });

    Route::post('add-reaction', [ReactionController::class, 'addOrUpdateReaction'])->name('reaction.add');


    // Beat Management Routes
    Route::resource('upload-beat', UserBeatFileController::class)->except(['create']);

    // Admin Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('setting', [AdminSettingController::class, 'index'])->name('setting.index');
        Route::get('audits', [AdminAuditController::class, 'index'])->name('audit');
        Route::get('users', [AdminUserController::class, 'index'])->name('user');
        Route::get('permissions-roles', [AdminPermissionRoleController::class, 'index'])->name('permission.role');
        Route::resource('role', AdminRoleController::class)->except('show');
        Route::resource('permission', AdminPermissionController::class)->except('show');
    });

    // Backup Routes
    Route::controller(AdminBackupController::class)->prefix('backup')->name('backup.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/run', 'runBackup')->name('run');
        Route::get('/download/{path}', 'downloadBackup')->where('path', '.*')->name('download');
        Route::delete('/delete/{path}', 'deleteBackup')->where('path', '.*')->name('delete');
    });

    Route::mediaLibrary();

    // Authentication Routes
    Route::post('logout', [LogoutController::class, 'destroy'])
        ->name('logout');
});






Route::resource('admin/category', AdminCategoryController::class);

Route::resource('mobile-device', MobileDeviceController::class);
Route::post('mobile-device/validate-step/{step}', [MobileDeviceController::class, 'validateStep'])
    ->name('mobile-device.validate-step');
Route::get('phone-variant/{slug}', [PhoneVariantController::class, 'index'])->name('phone.variant.index');

