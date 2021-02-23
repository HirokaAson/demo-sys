<?php

namespace App\Repositories;

class ClosingGroupRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct('closing_group');
    }

    public function getAll()
    {
        return $this->table->get();
    }

    public function find($closing_group_code)
    {
        return $this->table->find($closing_group_code);
    }

    public function findByName($closing_group_name)
    {
        return $this->table
        ->where('closing_group_name', $closing_group_name)
        ->first();
    }
}