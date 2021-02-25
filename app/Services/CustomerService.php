<?php

namespace App\Services;

use App\Repositories\DtbCustomerRepository;
use App\Repositories\YayoiSalesRepository;
use App\Repositories\PriceTypeRepository;
use App\Repositories\TaxPassThroughTypeRepository;
use App\Repositories\CollectMoneyCycleTypeRepository;
use App\Repositories\ClassificationOneTypeRepository;
use App\Repositories\ClassificationTwoTypeRepository;
use App\Repositories\ClassificationThreeTypeRepository;
use App\Repositories\ReferenceDisplayTypeRepository;
use App\Repositories\MtbRoundingTypeRepository;
use App\Repositories\ClosingGroupRepository;

class CustomerService
{
    private $dtbCustomerRepository;

    public function __construct()
    {
        $this->dtb_customer_repository = new DtbCustomerRepository();
        $this->yayoi_sales_repository = new YayoiSalesRepository();
        $this->price_type_repository = new PriceTypeRepository();
        $this->tax_pass_through_type_repository = new TaxPassThroughTypeRepository();
        $this->collect_money_cycle_type_repository = new CollectMoneyCycleTypeRepository();
        $this->classification_one_type_repository = new ClassificationOneTypeRepository();
        $this->classification_two_type_repository = new ClassificationTwoTypeRepository();
        $this->classification_three_type_repository = new ClassificationThreeTypeRepository();
        $this->reference_display_type_repository = new ReferenceDisplayTypeRepository();
        $this->mtb_rounding_type_repository = new MtbRoundingTypeRepository();
        $this->closing_group_repository = new ClosingGroupRepository();
        
    }

    public function getById($customer_id)
    {
        return $this->dtb_customer_repository->find($customer_id);
    }

    public function getCustomer($search_param)
    {
        return $this->dtb_customer_repository->getAllWithYayoiSalesPaginate($search_param);
    }

    public function getYayoiSalesByCustomerId($customer_id)
    {
        return $this->yayoi_sales_repository->getByCustomerId($customer_id);
    }


    // import作業が終わったら削除する
    public function getAllCustomer()
    {
        return $this->dtb_customer_repository->getAll();
    }

    public function getYayoiIntegrationItem()
    {
        return [
            'price_type' => $this->price_type_repository->getAll(),
            'tax_pass_through_type' => $this->tax_pass_through_type_repository->getAll(),
            'collect_money_cycle_type' => $this->collect_money_cycle_type_repository->getAll(),
            'classification_one_type' => $this->classification_one_type_repository->getAll(),
            'classification_two_type' => $this->classification_two_type_repository->getAll(),
            'classification_three_type' => $this->classification_three_type_repository->getAll(),
            'reference_display_type' => $this->reference_display_type_repository->getAll(),
            'amount_rouding_type' => $this->mtb_rounding_type_repository->getAll(),
            'tax_rouding_type' => $this->mtb_rounding_type_repository->getAll(),
            'closing_group' => $this->closing_group_repository->getAll(),
        ];
    }

    public function getYayoiIntegration(
        $price_type_name,
        $tax_pass_through_type_name,
        $collect_money_cycle_type_name,
        $classification_one_type_name,
        $classification_two_type_name,
        $classification_three_name,
        $reference_display_type_name,
        $amount_rouding_type_name,
        $tax_rouding_type_name
    ) {
        return [
            'price_type' => $this->price_type_repository->findByName($price_type_name),
            'tax_pass_through_type' => $this->tax_pass_through_type_repository->findByName($tax_pass_through_type_name),
            'collect_money_cycle_type' => $this->collect_money_cycle_type_repository->findByName($collect_money_cycle_type_name),
            'classification_one_type' => $this->classification_one_type_repository->findByName($classification_one_type_name),
            'classification_two_type' => $this->classification_two_type_repository->findByName($classification_two_type_name),
            'classification_three' => $this->classification_three_type_repository->findByName($classification_three_name),
            'reference_display_type' => $this->reference_display_type_repository->findByName($reference_display_type_name),
            'amount_rouding_type' => $this->mtb_rounding_type_repository->findByName($amount_rouding_type_name),
            'tax_rouding_type' => $this->mtb_rounding_type_repository->findByName($tax_rouding_type_name),
        ];
    }

    public function save($model)
    {
        if (isset($model['yayoi_sales_id'])) {
            return $this->yayoi_sales_repository->update($model);
        } else {
            return $this->yayoi_sales_repository->register($model);
        }
    }
}