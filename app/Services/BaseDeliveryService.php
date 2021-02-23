<?php

namespace App\Services;

use App\Repositories\DtbOrderRepository;
use App\Repositories\DtbOrderItemRepository;
use App\Repositories\DtbShippingRepository;
use App\Repositories\MtbPrefRepository;
use App\Repositories\YayoiSalesRepository;

class BaseDeliveryService
{
    public $dtb_order_repository;
    public $dtb_order_item_repository;
    public $dtb_shipping_repository;
    public $mtb_pref_repository;
    public $yayoi_sales_repository;
    
    public function __construct()
    {
        $this->dtb_order_repository = new DtbOrderRepository();
        $this->dtb_order_item_repository = new DtbOrderItemRepository();
        $this->dtb_shipping_repository = new DtbShippingRepository();
        $this->mtb_pref_repository = new MtbPrefRepository();
        $this->yayoi_sales_repository = new YayoiSalesRepository();
    }
}