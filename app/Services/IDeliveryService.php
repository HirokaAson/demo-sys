<?php

namespace App\Services;

interface IDeliveryService
{
    public function getShipmentList($order_id);
}