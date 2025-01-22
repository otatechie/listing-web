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
use App\Http\Controllers\ContactRequestController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\MobileDeviceController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PhoneVariantController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserAccountController;
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


// Public Routes
Route::controller(PageController::class)
    ->withoutMiddleware(HandleInertiaRequests::class)
    ->name('public.')
    ->group(function () {
        Route::get('help', 'help')->name('help');
    });

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('phone-variant/{slug}', [PhoneVariantController::class, 'index'])->name('phone.variant.index');
Route::resource('contact-request', ContactRequestController::class)->except(['create', 'edit']);
Route::get('user/profile/{user}', [UserAccountController::class, 'userProfile'])->name('user.profile');
Route::get('mobile-device', [MobileDeviceController::class, 'index'])->name('mobile-device.index');
Route::get('mobile-device/{mobile_device}', [MobileDeviceController::class, 'show'])->name('mobile-device.show');
Route::get('/search/live', [SearchController::class, 'search'])->name('search.live');
Route::get('/search', [SearchController::class, 'index'])->name('search.index');


// Authenticated Routes
Route::middleware(['web', 'auth'])->group(function () {
    // User Account Routes
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('account', [UserAccountController::class, 'index'])->name('index');
        Route::get('two-factor-authentication', [UserAccountController::class, 'twoFactorAuthentication'])->name('two.factor');
        Route::get('listing', [UserAccountController::class, 'userListing'])->name('listing');
        Route::get('favorites', [UserAccountController::class, 'userFavorites'])->name('favorites');
    });

    // Discussion Routes
    Route::post('discussion', [DiscussionController::class, 'store'])->name('discussion.store');
    Route::put('discussion/{discussion}', [DiscussionController::class, 'update'])->name('discussion.update');

    // Admin Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('setting', [AdminSettingController::class, 'index'])->name('setting.index');
        Route::get('audits', [AdminAuditController::class, 'index'])->name('audit');
        Route::get('users', [AdminUserController::class, 'index'])->name('user');
        Route::get('permissions-roles', [AdminPermissionRoleController::class, 'index'])->name('permission.role');
        Route::resource('role', AdminRoleController::class)->except('show');
        Route::resource('permission', AdminPermissionController::class)->except('show');
        Route::resource('category', AdminCategoryController::class);
    });

    // Backup Routes
    Route::controller(AdminBackupController::class)->prefix('backup')->name('backup.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/run', 'runBackup')->name('run');
        Route::get('/download/{path}', 'downloadBackup')->where('path', '.*')->name('download');
        Route::delete('/delete/{path}', 'deleteBackup')->where('path', '.*')->name('delete');
    });

    // Media Library Route
    Route::mediaLibrary();

    // Authentication Routes
    Route::post('logout', [LogoutController::class, 'destroy'])->name('logout');

    // Favorite Routes
    Route::post('favorites/{mobileDevice}', [FavoriteController::class, 'favorite'])->name('favorite.store');

    // Mobile Device Routes
    Route::resource('mobile-device', MobileDeviceController::class)->except(['index', 'show']);
    Route::post('mobile-device/validate-step/{step}', [MobileDeviceController::class, 'validateStep'])->name('mobile-device.validate-step');

    // Conversation and Message Routes
    Route::prefix('messages')->name('conversations.')->group(function () {
        Route::get('/', [ConversationController::class, 'index'])->name('index');
        Route::get('/{conversation}', [ConversationController::class, 'show'])->name('show');
        Route::post('/', [ConversationController::class, 'store'])->name('store');
        Route::post('/{conversation}/reply', [MessageController::class, 'store'])->name('messages.store');
        Route::post('/{conversation}/read', [MessageController::class, 'markAsRead'])->name('messages.read');
    });
});
