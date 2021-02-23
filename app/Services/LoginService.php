<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use App\Repositories\DtbMemberRepository;
use App\Repositories\DtbCustomerRepository;

class LoginService
{
    public function __construct()
    {
        $this->dtb_member_repository = new DtbMemberRepository();
        $this->dtb_customer_repository = new DtbCustomerRepository();
    }

    public function getAccount($email, $password)
    {
        return $this->dtb_member_repository->getByEmailAndPassword(
            $email, crypt($password, 'tomishiro256')
        );
    }

    public function getCustomer()
    {
        return $this->dtb_customer_repository->getAll();
    }
}