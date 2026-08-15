<?php

use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Dashboard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    // UI-only pages. Backend logic will be added later.
    Route::view('/tasks', 'tasks')->name('tasks');
    Route::view('/calendar', 'calendar')->name('calendar');
    Route::view('/categories', 'categories')->name('categories');
    Route::view('/statistics', 'statistics')->name('statistics');
    Route::view('/task-details', 'task-details')->name('task-details');
    Route::view('/profile', 'profile')->name('profile');
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