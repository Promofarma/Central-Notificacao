<?php

use App\Livewire\Admin\Recipient\Create;
use App\Livewire\Admin\Recipient\Index;
use App\Livewire\Admin\Recipient\Edit;
use Illuminate\Support\Facades\Route;

Route::get('/', Index::class)->name('recipient.index');
Route::get('/create', Create::class)->name('recipient.create');
Route::get('/{id}/edit', Edit::class)->name('recipient.edit');
