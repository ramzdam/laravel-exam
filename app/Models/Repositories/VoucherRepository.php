<?php
namespace App\Models\Repositories;

use App\Models\Voucher;
use App\Http\Traits\ModelTrait;

/**
 * Class VoucherRepository
 */
class VoucherRepository
{
    use ModelTrait;

    public function __construct(Voucher $model)
    {
        $this->setModel($model);
    }

    /**
     * Save new voucher entry
     *
     * @param string $code - Contains the new voucher code
     * @param string $user_id - User public key
     * @return Voucher
     */
    public function save($code, $user_id)
    {
        $model = $this->getModel();
        $voucher = $model::create([
            'code' => $code,
            'user_id' => $user_id,
        ]);
        return $voucher;
    }

    /**
     * Get Voucher by user id
     *
     * @param string $user_id - User public key
     * @return Voucher
     */
    public function getByUserId($user_id)
    {
        $model = $this->getModel();
        $vouchers = $model::where('user_id', $user_id)->get();
        return $vouchers;
    }

    /**
     * Get specific voucher by user
     *
     * @param string $user_id - User public key
     * @param string $voucher_id - The target voucher id
     * @return Voucher
     */
    public function getUserVoucherById($user_id, $voucher_id)
    {
        $model = $this->getModel();
        $voucher = $model::where('user_id', $user_id)
                        ->where('id', $voucher_id)
                        ->first();
        return $voucher;
    }


    /**
     * Delete the voucherr
     *
     * @param Voucher $voucher - The voucher instance
     * @return null
     */
    public function destroy($voucher)
    {
        $delete = $voucher->delete();
        return $delete;
    }
    /**
     * Get the users voucher list
     *
     * @param string $user_id - The user id
     * @return null
     */
    public function getVouchers($user_id)
    {
        $model = $this->getModel();
        $vouchers = $model::where('user_id', $user_id)->get();
        return $vouchers;
    }
}
