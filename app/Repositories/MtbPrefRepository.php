<?php

namespace App\Repositories;

class MtbPrefRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct('mtb_pref');
    }

    public function getAll()
    {
        return $this->table->get();
    }

    public function find($pref_id)
    {
        return $this->table->find($pref_id);
    }
}