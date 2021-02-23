<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LoginService;

class LoginController extends BaseController
{
  public function __construct()
  {
    parent::__construct();
    $this->login_service = new LoginService();
  }

  // Indexを表示
  public function index(Request $request)
  {
    return view('login.index');
  }

  //
  public function auth(Request $request)
  {
    $account = $this->login_service->getAccount($request->email, $request->password);

    if (!$account) {
      return redirect('/')->with('flash_message', config('message.error.login'));
    }

    // ユーザー情報を保存する
    $this->session_service->put('account', $account);

    return redirect('home');
  }
}
