<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CustomerService;
use SplFileObject;

class CustomerController extends BaseController
{
  public function __construct()
  {
    parent::__construct();
    $this->middleware('auth');
    $this->customer_service = new CustomerService();
  }

  //
  public function list(Request $request)
  {
    $search_param = [
      'customer_name' => $request->customer_name,
      'company_name' => $request->company_name,
    ];
    $dtb_customer = $this->customer_service->getCustomer($search_param);

    return view(
      'customer.list',
      [
        'dtb_customers' => $dtb_customer,
        'customer_name' => $request->customer_name,
        'company_name' => $request->company_name,
      ]
    );
  }

  //
  public function detail(Request $request)
  {
    $customer_id = $request->route()->parameter('customer_id');
    $yayoi_sales_data = $this->customer_service->getYayoiSalesByCustomerId($customer_id);
    $yayoi_integration_items = $this->customer_service->getYayoiIntegrationItem();

    if ($yayoi_sales_data) {
      return view(
        'customer.detail',
        [
          'yayoi_sales_id' => $yayoi_sales_data->id,
          'customer_id' => $customer_id,
          'integration_code' => $yayoi_sales_data->integration_code,
          'price_type_id' => $yayoi_sales_data->price_type_id,
          'billding_address_code' => $yayoi_sales_data->billding_address_code,
          'closing_group_code' => $yayoi_sales_data->closing_group_code,
          'amount_rouding_type_id' => $yayoi_sales_data->amount_rouding_type_id,
          'tax_rouding_type_id' => $yayoi_sales_data->tax_rouding_type_id,
          'tax_pass_through_type_id' => $yayoi_sales_data->tax_pass_through_type_id,
          'account_receivable_balance' => $yayoi_sales_data->account_receivable_balance,
          'collect_money_code' => $yayoi_sales_data->collect_money_code,
          'collect_money_cycle_type_id' => $yayoi_sales_data->collect_money_cycle_type_id,
          'collect_money_cycle_day' => $yayoi_sales_data->collect_money_cycle_day,
          'classification_one_type_id' => $yayoi_sales_data->classification_one_type_id,
          'classification_two_type_id' => $yayoi_sales_data->classification_two_type_id,
          'classification_three_type_id' => $yayoi_sales_data->classification_three_type_id,
          'reference_display_type_id' => $yayoi_sales_data->reference_display_type_id,
          'yayoi_integration_items' => $yayoi_integration_items,
        ]
      );
    } else {
      return view(
        'customer.detail',
        [
          'yayoi_sales_id' => '',
          'customer_id' => $customer_id,
          'integration_code' => '',
          'price_type_id' => '',
          'billding_address_code' => '',
          'closing_group_code' => '',
          'amount_rouding_type_id' => '',
          'tax_rouding_type_id' => '',
          'tax_pass_through_type_id' => '',
          'account_receivable_balance' => 0,
          'collect_money_code' => '000',
          'collect_money_cycle_type_id' => '',
          'collect_money_cycle_day' => 0,
          'classification_one_type_id' => '',
          'classification_two_type_id' => '',
          'classification_three_type_id' => '',
          'reference_display_type_id' => '',
          'yayoi_integration_items' => $yayoi_integration_items,
        ]
      );
    }
  }

  public function create(Request $request)
  {
    $customer_id = $request->route()->parameter('customer_id');

    // create
    $yayoi_sales_model = [
      // 'yayoi_sales_id' => $yayoi_sales_id,
      'customer_id' => $customer_id,
      'integration_code' => $request->integration_code,
      'price_type_id' => $request->select_price_type,
      'billding_address_code' => $request->billding_address_code,
      'closing_group_code' => $request->select_closing_group,
      'amount_rouding_type_id' => $request->select_amount_rouding_type,
      'tax_rouding_type_id' => $request->select_tax_rouding_type,
      'tax_pass_through_type_id' => $request->select_tax_pass_through_type,
      'account_receivable_balance' => $request->account_receivable_balance,
      'collect_money_code' => $request->collect_money_code,
      'collect_money_cycle_type_id' => $request->select_collect_money_cycle_type,
      'collect_money_cycle_day' => $request->collect_money_cycle_day,
      'classification_one_type_id' => $request->select_classification_one_type,
      'classification_two_type_id' => $request->select_classification_two_type,
      'classification_three_type_id' => $request->select_classification_three_type,
      'reference_display_type_id' => $request->select_reference_display_type
    ];
    $result = $this->customer_service->save($yayoi_sales_model);

    if ($result) {
      return redirect("customer/{$customer_id}")->with('save_message', '保存しました');
    } else {
      return redirect("customer/{$customer_id}")->with('save_message', '保存に失敗しました。');
    }
  }

  public function edit(Request $request)
  {
    $customer_id = $request->route()->parameter('customer_id');
    $yayoi_sales_id = $request->route()->parameter('yayoi_sales_id');
    
    // update
    $yayoi_sales_model = [
      'yayoi_sales_id' => $yayoi_sales_id,
      'customer_id' => $customer_id,
      'integration_code' => $request->integration_code,
      'price_type_id' => $request->select_price_type,
      'billding_address_code' => $request->billding_address_code,
      'closing_group_code' => $request->select_closing_group,
      'amount_rouding_type_id' => $request->select_amount_rouding_type,
      'tax_rouding_type_id' => $request->select_tax_rouding_type,
      'tax_pass_through_type_id' => $request->select_tax_pass_through_type,
      'account_receivable_balance' => $request->account_receivable_balance,
      'collect_money_code' => $request->collect_money_code,
      'collect_money_cycle_type_id' => $request->select_collect_money_cycle_type,
      'collect_money_cycle_day' => $request->collect_money_cycle_day,
      'classification_one_type_id' => $request->select_classification_one_type,
      'classification_two_type_id' => $request->select_classification_two_type,
      'classification_three_type_id' => $request->select_classification_three_type,
      'reference_display_type_id' => $request->select_reference_display_type
    ];
    $result = $this->customer_service->save($yayoi_sales_model);

    if ($result) {
      return redirect("customer/{$customer_id}")->with('save_message', '保存しました');
    } else {
      return redirect("customer/{$customer_id}")->with('save_message', '保存に失敗しました。');
    }
  }

  // import作業が終わったら不要のため削除を行う。
  public function csv(Request $request)
  {
    // $this->register();
    $this->update();
    return response(200);
  }

  private function register() {
        //SplFileObjectを生成
        $file = new SplFileObject("../storage/customerlist.csv");
 
        //SplFileObject::READ_CSV が最速らしい
        $file->setFlags(SplFileObject::READ_CSV);
        
        $dtb_customers = $this->customer_service->getAllCustomer();
        $test = [];
        foreach($dtb_customers as $dtb_customer) {
          $test[$dtb_customer->email] = $dtb_customer->id;
        }
        // var_dump($test);
        // exit;
        foreach ($file as $row) {
          // $dtb_customer = $this->customer_service->getCustomerByEmail($row[2]);
          // var_dump($dtb_customer[0]->id);
          // exit;
            $customer_id = $test[$row[2]];
            $yayoi_sales_model = [
              'customer_id' => $customer_id,
              'integration_code' => $row[1],
              'price_type_id' => 0,
              'billding_address_code' => $row[1],
              'closing_group_code' => '00',
              'amount_rouding_type_id' => 1,
              'tax_rouding_type_id' => 1,
              'tax_pass_through_type_id' => 0,
              'account_receivable_balance' => 0,
              'collect_money_code' => 0,
              'collect_money_cycle_type_id' => 0,
              'collect_money_cycle_day' => 0,
              'classification_one_type_id' => null,
              'classification_two_type_id' => null,
              'classification_three_type_id' => null,
              'reference_display_type_id' => 0
            ];
            $this->customer_service->save($yayoi_sales_model);
    
        }
  }
  private function update() {
    //SplFileObjectを生成
    $file = new SplFileObject("../storage/new_customerlist.csv");

    //SplFileObject::READ_CSV が最速らしい
    $file->setFlags(SplFileObject::READ_CSV);
    
    foreach ($file as $row) {
      $this->customer_service = new CustomerService();
      $yayoi_integration = $this->customer_service->getYayoiIntegration(
        $row[1],
        $row[6],
        $row[9],
        $row[11],
        $row[12],
        $row[13],
        $row[14],
        $row[4],
        $row[5]
      );
      // var_dump($yayoi_integration);
      // exit;
      
      // var_dump($yayoi_integration['tax_pass_through_type']->id);
      // exit;
      try {
        $yayoi_sales_model = [
          // 'customer_id' => $row[0],
          'integration_code' => $row[0],
          'price_type_id' => $row[1],
          'billding_address_code' => $row[2],
          'closing_group_code' => $row[3],
          'amount_rouding_type_id' => $row[4],
          'tax_rouding_type_id' => $row[5],
          'tax_pass_through_type_id' => $row[6],
          'account_receivable_balance' => $row[7],
          'collect_money_code' => $row[8],
          'collect_money_cycle_type_id' => $row[9],
          'collect_money_cycle_day' => $row[10],
          'classification_one_type_id' => $row[11] === '' ? null : $row[11],
          'classification_two_type_id' => $row[12] === '' ? null : $row[12],
          'classification_three_type_id' => $row[13] === '' ? null : $row[13],
          'reference_display_type_id' => $row[14]
        ];
        $this->customer_service->save($yayoi_sales_model);
        // echo $row[0];

      } catch (Exception $e) {
        // var_dump($yayoi_integration);
        // exit;
      }
    }
  }
}
