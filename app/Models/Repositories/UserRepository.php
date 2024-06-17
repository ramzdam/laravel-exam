<?php

namespace App\Models\Repositories;

use App\Models\User;
use App\Http\Traits\ModelTrait;
use App\Http\Traits\VoucherTrait;
use App\Http\Requests\StoreUserRequest;
// use App\Http\Interfaces\RecordInterface;
// use Illuminate\Support\Facades\Log;

/**
 * Class UserRepository
 */
class UserRepository
{
    use ModelTrait, VoucherTrait;

    public function __construct(User $model)
    {
        $this->setModel($model);
    }

    /**
     * Save the record in User table
     *
     * @param Array $records
     * @return Boolean
     */
    public function save(StoreUserRequest $request)
    {
        $model = $this->getModel();
        $user = $model::create($request->validated());
        return $user;
    }

    /**
     * Get user detail by user pkey or public key
     *
     * @param string $user_id - User public key
     * @return array
     */
    public function getById($user_id)
    {
        $model = $this->getModel();
        $user = $model::where('pkey', $user_id)->first();

        if(!$user) {
            return [];
        }

        return $user;
    }
}
