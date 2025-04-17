<?php declare(strict_types=1);

use App\Livewire\Notification\Index;
use App\Livewire\Notification\Create;
use Illuminate\Support\Facades\Route;

Route::get('/', Index::class)->name('notification.index');
Route::get('/create', Create::class)->name('notification.create');
