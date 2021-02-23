<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AnalyticsService;

class AnalyticsController extends BaseController
{
  public function __construct()
  {
    parent::__construct();
    $this->middleware('auth');
    $this->analytics_service = new AnalyticsService();
  }

  //
  public function index(Request $request)
  {
    $sales_years = $this->analytics_service->getYearlySales();
    $sales_month = $this->analytics_service->getMonthlySales();
    $sales_products = $this->analytics_service->getSalesProduct();
    $sales_prefs = $this->analytics_service->getSalesPref();

    return view('analytics.index',[
      'sales_years' => $sales_years,
      'sales_month' => $sales_month,
      'sales_products' => $sales_products,
      'sales_prefs' => $sales_prefs,
    ]);
  }
}
