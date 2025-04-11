<?php

use App\Livewire\Admin\User\Create;
use App\Livewire\Admin\User\Edit;
use App\Livewire\Admin\User\Index;
use Illuminate\Support\Facades\Route;

Route::get('/', Index::class)->name('user.index');
Route::get('/create', Create::class)->name('user.create');
Route::get('/{id}/edit', Edit::class)->name('user.edit');
