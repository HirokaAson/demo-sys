<?php

namespace App\Repositories;

class PriceTypeRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct('price_type');
    }

    public function getAll()
    {
        return $this->table->get();
    }

    public function find($price_type_id)
    {
        return $this->table->find($price_type_id);
    }

    public function findByName($price_type_name)
    {
        return $this->table
        ->where('price_type_name', $price_type_name)
        ->first();
    }
}