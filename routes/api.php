<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\VoucherController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function() {
    Route::apiResource('/vouchers', VoucherController::class);

    Route::post('/users', [UserController::class, 'store']);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
