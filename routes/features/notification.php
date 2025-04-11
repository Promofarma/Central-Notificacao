<?php

use App\Livewire\Notification\Create;
use App\Livewire\Notification\Index;
use App\Livewire\Notification\Show;
use Illuminate\Support\Facades\Route;

Route::get('/', Index::class)->name('notification.index');
Route::get('/create', Create::class)->name('notification.create');
Route::get('/{notification}', Show::class)->name('notification.show');
