<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\VoucherController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\MailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

Route::prefix('v1')->group(function() {
    Route::middleware(['auth:sanctum'])->apiResource('/vouchers', VoucherController::class);
    Route::middleware(['auth:sanctum'])->post('/users', [UserController::class, 'store']);
    Route::middleware(['auth:sanctum'])->get('/users/vouchers', [UserController::class, 'userVouchers']);
    Route::middleware(['auth:sanctum'])->post('/users/vouchers', [UserController::class, 'storeUserVouchers']);
    Route::middleware(['auth:sanctum'])->delete('/users/vouchers/{voucher_id}', [UserController::class, 'destroyUserVouchers']);

    Route::get('/send-mail', [MailController::class, 'sendMail']);
    Route::post('/login',  [LoginController::class, 'login'])->middleware('guest:sanctum');
});


