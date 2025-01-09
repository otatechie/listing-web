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
use App\Http\Controllers\BeatController;
use App\Http\Controllers\BeatStatsController;
use App\Http\Controllers\BookmarkFollowController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PhoneMobileDeviceController;
use App\Http\Controllers\ProducerProfileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReactionController;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\UserBeatController;
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
        Route::get('welcome', 'welcome')->name('welcome');
        Route::get('beats/new', 'newBeat')->name('new.beat');
    });
Route::post('/user/{userId}/follow', [BookmarkFollowController::class, 'follow'])->name('user.follow');
Route::get('/beat/{beat}/', [BeatController::class, 'index'])->name('beat.public.index');


// Authenticated Routes
Route::middleware(['web','auth', 'profile.setup'])->group(function () {
    // Home Route
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // User Account Routes
    Route::name('user.')->group(function () {
        Route::get('user/account', [UserAccountController::class, 'index'])
            ->name('index')->withoutMiddleware('profile.setup');
        Route::get('user/two-factor-authentication', [UserAccountController::class, 'twoFactorAuthentication'])
            ->name('two.factor');
        Route::post('switch-role', [UserAccountController::class, 'switchRole'])
            ->name('switch.role');
    });

    Route::post('add-reaction', [ReactionController::class, 'addOrUpdateReaction'])->name('reaction.add');

    // Profile Management Routes
    Route::resource('profile', ProfileController::class);
    Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function () {
        Route::put('/update/{profile}', 'updateProfile')->name('updateProfile');
        Route::put('/social-media/update/{profile}', 'updateSocialMedia')->name('updateSocialMedia');
    });

    // Beat Management Routes
    Route::resource('user/beat', UserBeatController::class);
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

Route::resource('phone-mobile-device', PhoneMobileDeviceController::class);

Route::post('phone-mobile-device/validate-step/{step}', [PhoneMobileDeviceController::class, 'validateStep'])
    ->name('phone-mobile-device.validate-step');

Route::get('producer/{id}', [ProducerProfileController::class, 'show'])->name('producer.show');
Route::post('beats/{beat}/record-play', [BeatStatsController::class, 'recordPlay'])->name('beats.record.play');
Route::post('beats/{beat}/record-recent-play', [BeatStatsController::class, 'recordRecentPlay'])->name('beats.record.recent.play');
Route::get('user/followers', [BeatStatsController::class, 'getFollowers'])->name('beats.followers');

