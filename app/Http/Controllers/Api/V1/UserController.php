<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\UserTrait;
use App\Http\Traits\VoucherTrait;
use App\Models\Repositories\UserRepository;
use App\Models\Repositories\VoucherRepository;

class UserController extends Controller
{
    use UserTrait, VoucherTrait;

    public function __construct(UserRepository $userRepository, VoucherRepository $voucherRepository)
    {
    	$this->userRepository = $userRepository;
        $this->voucherRepository = $voucherRepository;
    }
}
