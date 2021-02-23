<?php

namespace App\Repositories;

class TaxPassThroughTypeRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct('tax_pass_through_type');
    }

    public function getAll()
    {
        return $this->table->get();
    }

    public function find($tax_pass_through_type_id)
    {
        return $this->table->find($tax_pass_through_type_id);
    }

    public function findByName($tax_pass_through_type_name)
    {
        return $this->table
        ->where('tax_pass_through_type_name', $tax_pass_through_type_name)
        ->first();
    }
}