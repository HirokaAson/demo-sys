<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Session;

class SessionService
{

    public function __construct()
    {
    }

    public function put($key, $data)
    {
        // 情報を保存する
        Session::put($key, $data);
    }

    public function has($key)
    {
        // 情報が存在する(!= null)かチェック
        return Session::has($key);
    }

    public function flush()
    {
        // 削除 (全データ)
        Session::flush();
    }
}