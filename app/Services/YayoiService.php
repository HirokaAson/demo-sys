<?php

namespace App\Services;

use Carbon\Carbon;

class YayoiService extends BaseDeliveryService implements IDeliveryService
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getShipmentList($order_id)
    {
        return [
            'header' => $this->header(),
            'body' => $this->body($order_id),
            'filename' => $this->filename(),
        ];
    }

    private function header()
    {
        return [
            '削除マーク',
            '締めフラグ',
            'チェック',
            '伝票日付',
            '伝票番号',
            '伝票区分',
            '取引区分',
            '税転嫁',
            '金額端数処理',
            '税端数処理',
            '得意先コード',
            '納入先コード',
            '担当者コード',
            '行番号',
            '明細区分',
            '商品コード',
            '入金区分コード',
            '商品名/入金内容',
            '課税区分',
            '単位',
            '入数',
            'ケース'
        ];
    }

    private function body($order_id)
    {
        // get order data.
        $order = $this->dtb_order_repository->find($order_id);
        // get order_item data.
        $order_items = $this->dtb_order_item_repository->getByOrderId($order_id);
        // get shipping data.
        $shipping = $this->dtb_shipping_repository->findByOrderId($order_id);

        $yayoi_sales = $this->yayoi_sales_repository->getByCustomerId($order->customer_id);

        if (!$yayoi_sales) {
            return config('status_code.error.error_yayoi_sales_integration');
        }

        $body = [];
        $max_count = count($order_items);
        for($i = 0; $i < $max_count; $i++) {
            array_push(
                $body,
                [
                    config("yayoi_integration_status.delete_mark.1"), // 削除マーク
                    config("yayoi_integration_status.closing_flg.1"), // 締めフラグ
                    '', // チェック
                    Carbon::now()->format('Ymd'), // 伝票日付
                    '', // 伝票番号
                    config("yayoi_integration_status.slip_class.24"), // 伝票区分
                    config("yayoi_integration_status.transaction_class.1"), // 取引区分
                    config("yayoi_integration_status.tax_pass_through.{$yayoi_sales->tax_pass_through_type_id}"), // 税転嫁
                    config("yayoi_integration_status.amount_rouding.{$yayoi_sales->amount_rouding_type_id}"), // 金額端数処理
                    config("yayoi_integration_status.tax_rouding.{$yayoi_sales->tax_rouding_type_id}"), // 税端数処理
                    $yayoi_sales->integration_code, // 得意先コード
                    '', // 納入先コード
                    '', // 担当者コード
                    sprintf('%08d', $i + 1), // 行番号
                    config("yayoi_integration_status.item_class.1"), // 明細区分
                    $order_items[$i]->product_code, // 商品コード
                    $yayoi_sales->collect_money_code, // 入金区分コード
                    $order_items[$i]->product_name, // 商品名/入金内容
                    config("yayoi_integration_status.tax_class.13"), // 課税区分
                    '', // 単位
                    '', // 入数
                    '', // ケース
                ]
            );
        }

        return $body;
    }

    private function filename()
    {
        $dt = Carbon::now()->format('YmdHis');
        return "yayoi_{$dt}";
    }
}