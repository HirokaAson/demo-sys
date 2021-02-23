<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SessionService;

class BaseController extends Controller
{
  public $session_service;

  public function __construct()
  {
    $this->session_service = new SessionService();
  }
}
