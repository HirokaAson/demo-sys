<?php

namespace App\Repositories;

class MtbRoundingTypeRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct('mtb_rounding_type');
    }

    public function getAll()
    {
        return $this->table->get();
    }

    public function find($mtb_rounding_type_id)
    {
        return $this->table->find($mtb_rounding_type_id);
    }

    public function findByName($name)
    {
        return $this->table
        ->where('name', $name)
        ->first();
    }
}