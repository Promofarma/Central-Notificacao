<?php

use App\Livewire\Admin\Permission\Create;
use App\Livewire\Admin\Permission\Index;
use App\Livewire\Admin\Permission\Edit;
use Illuminate\Support\Facades\Route;

Route::get('/', Index::class)->name('permission.index');
Route::get('/create', Create::class)->name('permission.create');
Route::get('/{id}/edit', Edit::class)->name('permission.edit');
