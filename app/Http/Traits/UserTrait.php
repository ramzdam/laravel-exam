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
    /**
     * Create new user
     *
     * @param StoreUserRequest $request - Contains the request for storing new user
     * @return array
     */
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
    }

    /**
     * Retrieve the vouchers of the user
     *
     * @param String $user_id - the unique id of the user
     * @return Collection array
     */
    public function userVouchers()
    {
        $user_id = auth()->user()->pkey;
        $user = $this->userRepository->getById($user_id);

        if (!$user) {
            return response()->json(['message' => 'User ID Invalid. User detail not found'], 302);
        }
        $userVouchers = $this->voucherRepository->getByUserId($user->id);

        return VoucherResource::collection($userVouchers);
    }

    /**
     * Create a new voucher for the user
     *
     * @param String $user_id - the unique id of the user
     * @return json|array
     */
    public function storeUserVouchers()
    {
        $user_id = auth()->user()->pkey;
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
    /**
     * Delete user voucher
     *
     * @param String $user_id - the unique id of the user
     * @param String $voucher_id - the unique identifier of the voucher
     * @return Collection array
     */
    public function destroyUserVouchers($voucher_id)
    {
        $user_id = auth()->user()->pkey;
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
