<?php

use App\Models\Room;
use Livewire\Volt\Volt;
use App\Livewire\Admin\Rooms\Index;
use App\Livewire\Admin\Rooms\Create;
use App\Livewire\Admin\Rooms\Edit;

use App\Livewire\Admin\Users\Userindex;
use App\Livewire\Admin\Users\Usercreate;
use App\Livewire\Admin\Users\Useredit;

use App\Livewire\Admin\Booking\BookingManagement;

use App\Livewire\UserBooking;

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\AdminDashboard;

// Route for the home page
Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

// Route for the user dashboard (requires authentication and email verification)
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Group of routes that require authentication
Route::middleware(['auth'])->group(function () {
    // Redirect /settings to /settings/profile
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

// Group of routes that require authentication and admin privileges
Route::middleware(['auth', 'admin'])->group(function () {
    // Route for the admin dashboard
    Route::get('/admin/dashboard', AdminDashboard::class)->name('admin.dashboard');
    // Route for the admin rooms management
    Route::get('/rooms', Index::class)->name('admin.rooms.index');
    Route::get('/rooms/create', Create::class)->name('admin.rooms.create');
    Route::get('/rooms/{id}/edit', Edit::class)->name('admin.rooms.edit');
    // Route for the admin user management
    Route::get('/admin/users', Userindex::class)->name('admin.users.userindex');
    Route::get('/admin/users/create', Usercreate::class)->name('admin.users.usercreate');
    Route::get('/admin/users/{user}/edit', Useredit::class)->name('admin.users.useredit');

    // Route for the admin booking management
    Route::get('/admin/bookings', BookingManagement::class)->name('admin.booking');
});

// Group of routes that require authentication and user privileges
Route::middleware(['auth'])->group(function () {
    // Route for the user booking form
    Route::get('my-booking', UserBooking::class)->name('user.booking');

});



// Include authentication-related routes
require __DIR__.'/auth.php';
