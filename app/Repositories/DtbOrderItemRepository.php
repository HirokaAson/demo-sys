<?php

namespace App\Repositories;

class DtbOrderItemRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct('dtb_order_item');
    }

    public function getAll()
    {
        return $this->table
        ->get();
    }

    public function getByOrderId($order_id)
    {
        return $this->table
        ->where('order_id', $order_id)
        ->get();
    }

    public function getByOrderIdNotProductId($order_id)
    {
        return $this->table
        ->where('order_id', $order_id)
        ->whereNotNull('product_id')
        ->get();
    }
}