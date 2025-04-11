<?php

use App\Livewire\Admin\Role\Create;
use App\Livewire\Admin\Role\Index;
use App\Livewire\Admin\Role\Edit;
use Illuminate\Support\Facades\Route;

Route::get('/', Index::class)->name('role.index');
Route::get('/create', Create::class)->name('role.create');
Route::get('/{id}/edit', Edit::class)->name('role.edit');
