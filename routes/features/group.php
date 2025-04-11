<?php

use App\Livewire\Group\Create;
use App\Livewire\Group\Index;
use App\Livewire\Group\Edit;
use Illuminate\Support\Facades\Route;

Route::get('/', Index::class)->name('group.index');
Route::get('/create', Create::class)->name('group.create');
Route::get('/{id}/edit', Edit::class)->name('group.edit');
