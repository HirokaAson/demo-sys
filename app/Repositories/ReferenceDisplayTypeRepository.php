<?php

namespace App\Repositories;

class ReferenceDisplayTypeRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct('reference_display_type');
    }

    public function getAll()
    {
        return $this->table->get();
    }

    public function find($reference_display_type_id)
    {
        return $this->table->find($reference_display_type_id);
    }

    public function findByName($reference_display_type_name)
    {
        return $this->table
        ->where('reference_display_type_name', $reference_display_type_name)
        ->first();
    }
}