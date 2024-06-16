<?php

namespace App\Http\Traits;

use App\Repositories\VoucherRepository;
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
     * @param PlayerRepository $repository
     * @return Array
     */
    public function getAll(PlayerRepository $repository)
    {
        return $repository->getAll();
    }

	/**
     * Get individual Player record
     *
     * @param PlayerRepository $repository
     * @param String $code
     * @return Array
     */
    public function get(PlayerRepository $repository, $code)
    {
    	return $repository->get($code);
    }
}
