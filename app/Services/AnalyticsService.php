<?php

namespace App\Services;

class AnalyticsService extends BaseDeliveryService
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getSales($format, $limit)
    {
        return $this->dtb_order_repository->getSales($format, $limit);
    }

    public function getYearlySales()
    {
        return $this->dtb_order_repository->getSales('%Y年');
    }

    public function getMonthlySales()
    {
        $list = $this->dtb_order_repository->getSales('%Y年%m月');
        $tmp = [];
        foreach($list as $item) {
            preg_match('/([0-9]{4})(\/|-|年)/', $item->order_date, $date_match);

            $tmp[$date_match[1]][$item->order_date] = $item->payment_total;
        }

        return $tmp;
    }

    public function getSalesProduct()
    {
        return $this->dtb_order_repository->getSalesProduct();
    }

    public function getSalesPref()
    {
        return $this->dtb_order_repository->getSalesPref();
    }
}