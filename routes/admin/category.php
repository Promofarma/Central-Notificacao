<?php

use App\Livewire\Admin\Category\Create;
use App\Livewire\Admin\Category\Index;
use App\Livewire\Admin\Category\Edit;
use Illuminate\Support\Facades\Route;

Route::get('/', Index::class)->name('category.index');
Route::get('/create', Create::class)->name('category.create');
Route::get('/{id}/edit', Edit::class)->name('category.edit');
