<?php

namespace App\Repositories;

class ClassificationThreeTypeRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct('classification_three_type');
    }

    public function getAll()
    {
        return $this->table->get();
    }

    public function find($classification_three_type_id)
    {
        return $this->table->find($classification_three_type_id);
    }

    public function findByName($classification_three_type_name)
    {
        return $this->table
        ->where('classification_three_type_name', $classification_three_type_name)
        ->first();
    }
}