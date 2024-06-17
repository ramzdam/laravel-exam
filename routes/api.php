<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\VoucherController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\MailController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function() {
    Route::middleware('auth:sanctum')->apiResource('/vouchers', VoucherController::class);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{user_id}/vouchers', [UserController::class, 'userVouchers']);
    Route::post('/users/{user_id}/vouchers', [UserController::class, 'storeUserVouchers']);
    Route::delete('/users/{user_id}/vouchers/{voucher_id}', [UserController::class, 'destroyUserVouchers']);

    Route::get('/send-mail', [MailController::class, 'sendMail']);
});

