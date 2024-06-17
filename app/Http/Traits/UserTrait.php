<?php

namespace App\Http\Traits;

use App\Models\Repositories\UserRepository;
use App\Models\User;
use App\Http\Resources\UserResource;
use App\Http\Resources\VoucherResource;
use App\Http\Requests\StoreUserRequest;
use App\Events\UserRegistered;
// use App\Http\Requests\Request;

/**
 * Trait UserTrait
 *
 * This trait is responsible for handling all validation and conditions
 * that will be used as parameter to retrieve data in a repository
 */
trait UserTrait
{
    public function store(StoreUserRequest $request)
    {
        $user = $this->userRepository->save($request);
        // return $user;
        $token = $user->createToken('api-token')->plainTextToken;

        $code = $this->generateCode($this->voucherRepository, $user);
        event(new UserRegistered($user, $code));
        return (new UserResource($user))->additional([
            'voucher' => [
                'code' => $code,
                'token' => $token
            ],
        ]);
        // return UserResource::make($user);
    }

    public function userVouchers($user_id)
    {
        $user = $this->userRepository->getById($user_id);

        if (!$user) {
            return response()->json(['message' => 'User ID Invalid. User detail not found'], 302);
        }
        $userVouchers = $this->voucherRepository->getByUserId($user->id);

        return VoucherResource::collection($userVouchers);
    }

    public function storeUserVouchers($user_id)
    {
        $user = $this->userRepository->getById($user_id);

        if (!$user) {
            return response()->json(['message' => 'User ID Invalid. User detail not found'], 302);
        }
        $vouchers = $this->voucherRepository->getVouchers($user->id);
        if ($vouchers->count() >= 10) {
            return response()->json(['message' => 'Reached max limit of allowed number of voucher'], 302);
        }

        $voucher = $this->createVoucher($this->voucherRepository, $user);

        return VoucherResource::make($voucher);
    }

    public function destroyUserVouchers($user_id, $voucher_id)
    {
        $user = $this->userRepository->getById($user_id);

        if (!$user) {
            return response()->json(['message' => 'User ID Invalid. User detail not found'], 302);
        }

        $voucher = $this->voucherRepository->getUserVoucherById($user->id, $voucher_id);

        if (!$voucher) {
            return response()->json(['message' => 'Voucher not found for the specified user id'], 302);
        }

        $this->voucherRepository->destroy($voucher);

        return response()->json(['message' => 'Voucher deleted successfully!'], 200);
    }
}
