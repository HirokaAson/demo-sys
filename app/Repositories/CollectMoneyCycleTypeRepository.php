<?php

namespace App\Repositories;

class CollectMoneyCycleTypeRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct('collect_money_cycle_type');
    }

    public function getAll()
    {
        return $this->table->get();
    }

    public function find($collect_money_cycle_type_id)
    {
        return $this->table->find($collect_money_cycle_type_id);
    }

    public function findByName($collect_money_cycle_type_name)
    {
        return $this->table
        ->where('collect_money_cycle_type_name', $collect_money_cycle_type_name)
        ->first();
    }
}