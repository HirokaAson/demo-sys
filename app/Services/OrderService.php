<?php

namespace App\Services;

class OrderService extends BaseDeliveryService
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getOrderAll()
    {
        return $this->dtb_order_repository->getAll();
    }

    public function getByOrderStatusId($search_param)
    {
        return $this->dtb_order_repository->getByStatusWithPageinate($search_param);
    }

    public function getOrderAndShipping($order_id)
    {
        $order = $this->dtb_order_repository->find($order_id);
        $shipping = $this->dtb_shipping_repository->findByOrderId($order_id);
        return [
            'order' => $order,
            'order_item' => $this->dtb_order_item_repository->getByOrderIdNotProductId($order_id),
            'shipping' => $shipping,
            'order_pref' => $this->pref($order->pref_id),
            'shipping_pref' => $this->pref($shipping->pref_id),
        ];
    }

    private function pref($pref_id)
    {
        return $pref_id ? $this->mtb_pref_repository->find($pref_id)->name : '';
    }
}