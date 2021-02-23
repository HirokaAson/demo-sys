<?php

namespace App\Repositories;

class YayoiSalesRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct('yayoi_sales');
    }

    public function getAll()
    {
        return $this->table->get();
    }

    public function find($yayoi_sales_id)
    {
        return $this->table->find($yayoi_sales_id);
    }

    public function getByCustomerId($customer_id)
    {
        return $this->table
        ->leftJoin('price_type', 'yayoi_sales.price_type_id', '=', 'price_type.id')
        ->leftJoin('mtb_rounding_type', function ($join) {
            $join->on('yayoi_sales.amount_rouding_type_id', '=', 'mtb_rounding_type.id')
            ->orOn('yayoi_sales.tax_rouding_type_id', '=', 'mtb_rounding_type.id');
        })
        ->leftJoin('tax_pass_through_type', 'yayoi_sales.tax_pass_through_type_id', '=', 'tax_pass_through_type.id')
        ->leftJoin('collect_money_cycle_type', 'yayoi_sales.collect_money_cycle_type_id', '=', 'collect_money_cycle_type.id')
        ->leftJoin('classification_one_type', 'yayoi_sales.classification_one_type_id', '=', 'classification_one_type.id')
        ->leftJoin('classification_two_type', 'yayoi_sales.classification_two_type_id', '=', 'classification_two_type.id')
        ->leftJoin('classification_three_type', 'yayoi_sales.classification_three_type_id', '=', 'classification_three_type.id')
        ->leftJoin('reference_display_type', 'yayoi_sales.reference_display_type_id', '=', 'reference_display_type.id')
        ->leftJoin('closing_group', 'yayoi_sales.closing_group_code', '=', 'closing_group.code')
        ->where('customer_id', $customer_id)
        ->select('yayoi_sales.*')
        ->first();
    }

    public function register($model)
    {
        try {
            $this->table
            ->insert(
                [
                    'customer_id' => $model['customer_id'],
                    'integration_code' => $model['integration_code'],
                    'price_type_id' => $model['price_type_id'],
                    'billding_address_code' => $model['billding_address_code'],
                    'closing_group_code' => $model['closing_group_code'],
                    'amount_rouding_type_id' => $model['amount_rouding_type_id'],
                    'tax_rouding_type_id' => $model['tax_rouding_type_id'],
                    'tax_pass_through_type_id' => $model['tax_pass_through_type_id'],
                    'account_receivable_balance' => $model['account_receivable_balance'],
                    'collect_money_code' => $model['collect_money_code'],
                    'collect_money_cycle_type_id' => $model['collect_money_cycle_type_id'],
                    'collect_money_cycle_day' => $model['collect_money_cycle_day'],
                    'classification_one_type_id' => $model['classification_one_type_id'],
                    'classification_two_type_id' => $model['classification_two_type_id'],
                    'classification_three_type_id' => $model['classification_three_type_id'],
                    'reference_display_type_id' => $model['reference_display_type_id'],
                ]
            );
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function update($model)
    {
        try {
            $this->table
            ->where('id', $model['yayoi_sales_id'])
            ->update(
                [
                    'integration_code' => $model['integration_code'],
                    'price_type_id' => $model['price_type_id'],
                    'billding_address_code' => $model['billding_address_code'],
                    'closing_group_code' => $model['closing_group_code'],
                    'amount_rouding_type_id' => $model['amount_rouding_type_id'],
                    'tax_rouding_type_id' => $model['tax_rouding_type_id'],
                    'tax_pass_through_type_id' => $model['tax_pass_through_type_id'],
                    'account_receivable_balance' => $model['account_receivable_balance'],
                    'collect_money_code' => $model['collect_money_code'],
                    'collect_money_cycle_type_id' => $model['collect_money_cycle_type_id'],
                    'collect_money_cycle_day' => $model['collect_money_cycle_day'],
                    'classification_one_type_id' => $model['classification_one_type_id'],
                    'classification_two_type_id' => $model['classification_two_type_id'],
                    'classification_three_type_id' => $model['classification_three_type_id'],
                    'reference_display_type_id' => $model['reference_display_type_id'],
                ]
            );
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}