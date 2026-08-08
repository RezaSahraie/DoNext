<?php

use App\Livewire\Dashboard;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', Dashboard::class)->name('dashboard');

// UI-only pages. Backend logic will be added later.
Route::view('/tasks', 'tasks')->name('tasks');
Route::view('/calendar', 'calendar')->name('calendar');
Route::view('/categories', 'categories')->name('categories');
Route::view('/statistics', 'statistics')->name('statistics');
Route::view('/task-details', 'task-details')->name('task-details');
Route::view('/profile', 'profile')->name('profile');
Route::view('/settings', 'settings')->name('settings');
Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');