<?php

namespace App\Repositories;

class DtbMemberRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct('dtb_member');
    }

    public function getAll()
    {
        return $this->table
        ->get();
    }

    public function getByEmailAndPassword($email, $password)
    {
        return $this->table
        ->where('login_id', $email)
        ->where('password', $password)
        ->first();
    }
}