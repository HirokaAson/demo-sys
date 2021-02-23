<?php

namespace App\Services;

use Carbon\Carbon;

class YuPackService extends BaseDeliveryService implements IDeliveryService
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getShipmentList($order_id)
    {
        return [
            'header' => $this->header(),
            'body' => $this->body($order_id),
            'filename' => $this->filename(),
        ];
    }

    private function header()
    {
        return ['header1', 'header2'];
    }

    private function body($order_id)
    {
        // get order data.
        $order = $this->dtb_order_repository->find($order_id);
        // get order_item data.
        $order_items = $this->dtb_order_item_repository->getByOrderId($order_id);
        // get shipping data.
        $shipping = $this->dtb_shipping_repository->findByOrderId($order_id);


        return [
            ['おはよう', 'おやすみ'],
            ['こんにちは', 'さようなら'],
        ];
    }

    private function filename()
    {
        $dt = Carbon::now()->format('YmdHis');
        return "yu_pack_{$dt}";
    }
}