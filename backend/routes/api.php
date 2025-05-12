<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserEventController;
use App\Http\Controllers\Api\EventController;
//Route::middleware(['api', 'auth.basic'])->group(function () {
    Route::apiResource('events', EventController::class);
    Route::apiResource('user_events', UserEventController::class)->except(['index']);
    Route::get('events/{event}/user_events', [UserEventController::class, 'index']);
//});
