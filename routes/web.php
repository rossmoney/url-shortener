<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;

Route::get('/', [LinkController::class, 'encoder']);
Route::get('/decoder', [LinkController::class, 'decoder']);