<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class DtbCustomerRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct('dtb_customer');
    }

    public function getAll()
    {
        return $this->table->get();
    }

    public function getAllWithPaginate()
    {
        return $this->table->simplePaginate(20);
    }

    public function find($customer_id)
    {
        return $this->table->find($customer_id);
    }

    public function getAllWithYayoiSalesPaginate($search_param)
    {
        $query = $this->table->leftJoin('yayoi_sales', 'dtb_customer.id', '=', 'yayoi_sales.customer_id');

        if (isset($search_param['customer_name'])) {
            $query
            ->where(DB::raw('CONCAT(name01, name02)'), 'like', "%{$search_param['customer_name']}%");
        }

        if (isset($search_param['company_name'])) {
            $query
            ->where('company_name', 'like', "%{$search_param['company_name']}%");
        }

        return $query
        ->select('dtb_customer.id as id', 'company_name', 'name01', 'name02', 'email', 'phone_number', 'yayoi_sales.integration_code')
        ->orderBy('dtb_customer.id', 'desc')
        ->simplePaginate(20);
    }

    public function getByEmail($email)
    {
        return $this->table
        ->where('email', $email)
        ->first();
    }
}