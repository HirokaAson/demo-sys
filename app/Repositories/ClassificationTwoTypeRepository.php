<?php

namespace App\Repositories;

class ClassificationTwoTypeRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct('classification_two_type');
    }

    public function getAll()
    {
        return $this->table->get();
    }

    public function find($classification_two_type_id)
    {
        return $this->table->find($classification_two_type_id);
    }

    public function findByName($classification_two_type_name)
    {
        return $this->table
        ->where('classification_two_type_name', $classification_two_type_name)
        ->first();
    }
}