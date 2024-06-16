<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Voucher;
use App\Http\Controllers\Controller;
use App\Http\Resources\VoucherResource;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    //
    public function index()
    {
        return VoucherResource::collection(Voucher::all());
    }

    public function show(Voucher $voucher)
    {
        return VoucherResource::make($voucher);
    }
}
