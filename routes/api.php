<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\LinkController;

Route::post('/encode', [LinkController::class, 'encode'])->name('link.encode');
Route::post('/decode', [LinkController::class, 'decode'])->name('link.decode');

Route::get('/links', [LinkController::class, 'index'])->name('links.index');
Route::get('/links/{link}', [LinkController::class, 'show'])->name('links.show');