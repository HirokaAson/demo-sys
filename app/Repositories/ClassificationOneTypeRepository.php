<?php

namespace App\Repositories;

class ClassificationOneTypeRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct('classification_one_type');
    }

    public function getAll()
    {
        return $this->table->get();
    }

    public function find($classification_one_type_id)
    {
        return $this->table->find($classification_one_type_id);
    }

    public function findByName($classification_one_type_name)
    {
        return $this->table
        ->where('classification_one_type_name', $classification_one_type_name)
        ->first();
    }
}