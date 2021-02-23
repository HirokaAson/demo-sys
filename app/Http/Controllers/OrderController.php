<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Services\CsvService;

class OrderController extends BaseController
{
  public function __construct()
  {
    parent::__construct();
    $this->middleware('auth');
    $this->order_service = new OrderService();
    $this->csv_service = new CsvService();
  }

  //
  public function list(Request $request)
  {
    $search_param = [
      'customer_name' => $request->customer_name,
      'order_status_id' => $request->order_status_id,
    ];

    $dtb_order = $this->order_service->getByOrderStatusId($search_param);

    return view(
      'order.list',
      [
        'dtb_orders' => $dtb_order,
        'customer_name' => $request->customer_name,
        'order_status_id' => $request->order_status_id,
      ]
    );
  }

  //
  public function detail(Request $request)
  {
    $order_and_shipping = $this->order_service->getOrderAndShipping($request->order_id);

    return view(
      'order.detail',
      [
        'order_id' => $request->route()->parameter('order_id'),
        'order' => $order_and_shipping['order'],
        'order_item' => $order_and_shipping['order_item'],
        'shipping' => $order_and_shipping['shipping'],
        'order_pref' => $order_and_shipping['order_pref'],
        'shipping_pref' => $order_and_shipping['shipping_pref'],
      ]
    );
  }

  public function export(Request $request)
  {
    $res = $this->csv_service->export($request->order_id, $request->csv_export_type);

    if ($res === config('status_code.error.error_yayoi_sales_integration')) {
      return redirect("order/{$request->order_id}")->with('error_message', '弥生販売連携データの登録がされていません。');
    }
    return response($res['response'], 200)
    ->header('Content-Type', 'text/csv')
    ->header('Content-Disposition', 'attachment; filename='.$res['filename']);
  }
}
