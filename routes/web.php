<?php

use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\WelcomeController;

use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome.index');
Route::get('/cosmic/{slug}', [EpisodeController::class, 'index'])->name('episode.index');
Route::get('/cosmic/{slug}/{episode}', [PictureController::class, 'index'])->name('picture.index');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    //
});
