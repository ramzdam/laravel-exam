<?php

namespace App\Http\Traits;

use App\Models\Repositories\UserRepository;
use App\Models\User;
use App\Http\Resources\UserResource;
use App\Http\Requests\StoreUserRequest;

/**
 * Trait UserTrait
 *
 * This trait is responsible for handling all validation and conditions
 * that will be used as parameter to retrieve data in a repository
 */
trait UserTrait
{

	// /**
    //  * Get all record
    //  *
    //  * @param UserRepository $repository
    //  * @return Array
    //  */
    // public function getAll(UserRepository $repository)
    // {
    //     return $repository->getAll();
    // }

	// /**
    //  * Get individual User record
    //  *
    //  * @param UserRepository $repository
    //  * @param String $code
    //  * @return Array
    //  */
    // public function get(UserRepository $repository, $code)
    // {
    // 	return $repository->get($code);
    // }

    //
    public function store(StoreUserRequest $request)
    {
        $user = $this->userRepository->save($request);
        // return $user;
        $token = $user->createToken('api-token')->plainTextToken;

        $code = $this->generateCode($this->voucherRepository, $user);
        return (new UserResource($user))->additional([
            'voucher' => [
                'code' => $code,
                'token' => $token
            ],
        ]);
        // return UserResource::make($user);
    }
}
