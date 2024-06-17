<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Voucher;
use App\Http\Controllers\Controller;
use App\Http\Resources\VoucherResource;
use Illuminate\Http\Request;
use App\Http\Traits\UserTrait;
use App\Http\Traits\VoucherTrait;
use App\Models\Repositories\UserRepository;
use App\Models\Repositories\VoucherRepository;

class VoucherController extends Controller
{
    use UserTrait, VoucherTrait;

    public function __construct(UserRepository $userRepository, VoucherRepository $voucherRepository)
    {
    	$this->userRepository = $userRepository;
        $this->voucherRepository = $voucherRepository;
    }
    //
    public function index(Request $request)
    {

        // return VoucherResource::collection(Voucher::all());
    }

    public function show(Voucher $voucher)
    {
        return VoucherResource::make($voucher);
    }
}
