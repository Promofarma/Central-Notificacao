<?php

use App\Livewire\Admin\Team\Create;
use App\Livewire\Admin\Team\Index;
use App\Livewire\Admin\Team\Edit;
use Illuminate\Support\Facades\Route;

Route::get('/', Index::class)->name('team.index');
Route::get('/create', Create::class)->name('team.create');
Route::get('/{id}/edit', Edit::class)->name('team.edit');
