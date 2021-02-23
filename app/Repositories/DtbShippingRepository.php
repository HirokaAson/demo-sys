<?php

namespace App\Repositories;

class DtbShippingRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct('dtb_shipping');
    }

    public function getAll()
    {
        return $this->table
        ->get();
    }

    public function findByOrderId($order_id)
    {
        return $this->table
        ->where('order_id', $order_id)
        ->first();
    }
}