<?php

namespace App\Http\Traits;

use App\Models\Repositories\VoucherRepository;
use App\Models\User;
use App\Models\Voucher;

/**
 * Trait PlayerTrait
 *
 * This trait is responsible for handling all validation and conditions
 * that will be used as parameter to retrieve data in a repository
 */
trait VoucherTrait
{

	/**
     * Get all record
     *
     * @param VoucherRepository $repository
     * @return Array
     */
    public function getAll(VoucherRepository $repository)
    {
        return $repository->getAll();
    }
    /**
     * Generate a unique voucher code
     *
     * @param VoucherRepository $repository - Contain voucher repository instance to access voucher model
     * @param User $user - Contain user model
     * @return String
     */
    public function generateCode(VoucherRepository $repository, User $user)
    {
        $model = $repository->getModel();
        $uniqueCode = generateUniqueString($model::class, 'code');
        $voucher = $repository->save($uniqueCode, $user->id);
        return $voucher->code;
    }

	/**
     * Get individual Voucher record
     *
     * @param VoucherRepository $repository
     * @param String $code
     * @return Array
     */
    public function get(VoucherRepository $repository, $code)
    {
    	return $repository->get($code);
    }

    /**
     * Create new Voucher for the user
     *
     * @param VoucherRepository $repository - Contain voucher repository instance to access voucher model
     * @param User $user - Contain user model
     * @return Voucher $voucher
     */
    public function createVoucher(VoucherRepository $repository, User $user)
    {
        $model = $repository->getModel();
        $uniqueCode = generateUniqueString($model::class, 'code');
        $voucher = $repository->save($uniqueCode, $user->id);
        return $voucher;
    }
}
