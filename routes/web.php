<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingDashboardController;
use App\Http\Controllers\Admin\BookingAdminController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\UserNotificationController;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/make-admin', function () {
    $user = User::where('email', 'putingbuhok1@gmail.com')->first();
    if ($user) {
        $user->role = 'admin';
        $user->save();
        return 'User is now admin';
    }
    return 'User not found';
});

// ✅ Dashboard
Route::get('/dashboard', [BookingDashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    // ✅ Bookings index (used in sidebar)
    Route::get('/bookings', [BookingDashboardController::class, 'bookingsIndex'])
        ->name('bookings.index');

    // ✅ Manual Booking (via form not calendar)
    Route::get('/bookings/manual', [BookingDashboardController::class, 'createManual'])
        ->name('bookings.manual');
    Route::post('/bookings/manual', [BookingDashboardController::class, 'storeManual'])
        ->name('bookings.manual.store');

    // ✅ Booking Create / Edit / Update / Delete
    Route::post('/bookings', [BookingDashboardController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{booking}/edit', [BookingDashboardController::class, 'edit'])->name('bookings.edit');
    Route::put('/bookings/{booking}', [BookingDashboardController::class, 'update'])->name('bookings.update');
    Route::delete('/bookings/{booking}', [BookingDashboardController::class, 'destroy'])->name('bookings.destroy');

    // ✅ Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ✅ Admin Panel
    Route::middleware('can:viewAny,App\Models\Booking')->group(function () {
        // Booking Management
        Route::get('/admin/bookings', [BookingAdminController::class, 'index'])->name('admin.bookings.index');
        Route::delete('/admin/bookings/{booking}', [BookingAdminController::class, 'destroy'])->name('admin.bookings.destroy');

        // ✅ User Management
        Route::get('/admin/users', [UserAdminController::class, 'index'])->name('admin.users.index');
        Route::delete('/admin/users/{user}', [UserAdminController::class, 'destroy'])->name('admin.users.destroy');
    });

    // ✅ Notifications
    Route::get('/notifications', [UserNotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/mark-all-read', [UserNotificationController::class, 'markAllRead'])->name('notifications.markAllRead');
});

require __DIR__.'/auth.php';
