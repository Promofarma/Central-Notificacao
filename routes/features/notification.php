<?php

use App\Livewire\Notification\Index;
use App\Livewire\Notification\Show;
use App\Livewire\Notification\Create;
use App\Livewire\Notification\Edit;
use Illuminate\Support\Facades\Route;

Route::get('/', Index::class)->name('notification.index');
Route::get('/create', Create::class)->name('notification.create');
Route::get('/{notification}', Show::class)->name('notification.show');
Route::get('/{id}/edit', Edit::class)->name('notification.edit');
