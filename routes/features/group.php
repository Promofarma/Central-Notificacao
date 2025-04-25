<?php

declare(strict_types=1);

use App\Livewire\Group\Create;
use App\Livewire\Group\Index;
use Illuminate\Support\Facades\Route;

Route::get('/', Index::class)->name('group.index');
Route::get('/create', Create::class)->name('group.create');
