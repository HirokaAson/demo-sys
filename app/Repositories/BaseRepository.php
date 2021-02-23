<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class BaseRepository
{
    public $table = '';
    
    public function __construct($table_name)
    {
        $this->table = DB::table($table_name);
    }
}