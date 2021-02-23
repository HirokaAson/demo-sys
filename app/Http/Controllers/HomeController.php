<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\HomeService;

class HomeController extends BaseController
{
  public function __construct()
  {
    parent::__construct();
    $this->middleware('auth');
    $this->home_service = new HomeService();
  }

  //
  public function index(Request $request)
  {
    return view('home.index',[]);
  }

  //
  public function logout(Request $request)
  {
    // 削除 (全データ)
    $this->session_service->flush();
    return redirect('/');
  }
}
