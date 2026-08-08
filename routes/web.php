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