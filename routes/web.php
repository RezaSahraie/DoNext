<?php

use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Categories;
use App\Livewire\Dashboard;
use App\Livewire\Profile;
use App\Livewire\Tasks;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    // UI-only pages. Backend logic will be added later.
    Route::get('/tasks', Tasks::class)->name('tasks');
    Route::view('/calendar', 'calendar')->name('calendar');
    Route::get('/categories', Categories::class)->name('categories');
    Route::view('/statistics', 'statistics')->name('statistics');
    Route::view('/task-details', 'task-details')->name('task-details');
    Route::get('/profile', Profile::class)->name('profile');
    Route::view('/settings', 'settings')->name('settings');
});


Route::get('/login', Login::class)->middleware('guest')->name('login');
Route::get('/register', Register::class)->name('register');


Route::post('/logout', function() {
    Auth::logout();

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect()->route('login');
})->middleware('auth')->name('logout');


Route::get('/forgot-password', ForgotPassword::class)->middleware('guest')->name('password.request');

Route::get('/forgot-password/{token}', ResetPassword::class)->middleware('guest')->name('password.reset');