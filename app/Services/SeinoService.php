<?php

namespace App\Services;

use Carbon\Carbon;

class SeinoService extends BaseDeliveryService implements IDeliveryService
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
            '荷送人コード',
            '西濃発店コード',
            '出荷予定日',
            'お問合番号',
            '管理番号',
            '元着区分',
            '原票区分',
            '個数',
            '重量区分',
            '重量Ｋ',
            '重量才',
            '荷送人名称',
            '荷送人住所１',
            '荷送人住所２',
            '荷送人電話番号',
            '部署コード',
            '部署名',
            '重量契約区分',
            'お届け先郵便番号',
            'お届け先名称１',
            'お届け先名称2',
            'お届け先住所１',
            'お届け先住所２',
            'お届け先電話番号',
            'お届け先コード',
            'お届け先ＪＩＳ　市町村コード',
            '着店コード付け区分',
            '着地コード',
            '着店コード',
            '保険金額',
            '輸送指示1',
            '輸送指示2',
            '記事1',
            '記事2',
            '記事3',
            '記事4',
            '記事5',
            '輸送指示配達指定日',
            '輸送指示コード１',
            '輸送指示コード２',
            '輸送指示とめ店所',
            '予備',
            '品代金',
            '消費税',
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

        return [
            [
                '', // 荷送人コード
                '', // 西濃発店コード
                $this->shippingDate($shipping->shipping_date), // 出荷予定日
                '', // お問合番号
                $order->order_no, // 管理番号
                '', // 元着区分
                '', // 原票区分
                '', // 個数
                '', // 重量区分
                '', // 重量Ｋ
                '', // 重量才
                "{$order->name01}{$order->name02}", // 荷送人名称
                $this->address($order->pref_id, $order->addr01), // 荷送人住所１
                $order->addr02, // 荷送人住所２
                $order->phone_number, // 荷送人電話番号
                '', // 部署コード
                '', // 部署名
                '', // 重量契約区分
                $shipping->postal_code, // お届け先郵便番号
                $shipping->company_name, // お届け先名称１
                "{$shipping->name01}{$shipping->name02}", // お届け先名称2
                $this->address($shipping->pref_id, $shipping->addr01), // お届け先住所１
                $shipping->addr02, // お届け先住所２
                $shipping->phone_number, // お届け先電話番号
                '', // お届け先コード
                '', // お届け先ＪＩＳ　市町村コード
                '', // 着店コード付け区分
                '', // 着地コード
                '', // 着店コード
                '', // 保険金額
                '', // 輸送指示1
                '', // 輸送指示2
                '', // 記事1
                '', // 記事2
                '', // 記事3
                '', // 記事4
                '', // 記事5
                '', // 輸送指示配達指定日
                '', // 輸送指示コード１
                '', // 輸送指示コード２
                '', // 輸送指示とめ店所
                '', // 予備
                '', // 品代金
                '', // 消費税
            ],
        ];
    }

    private function filename()
    {
        $dt = Carbon::now()->format('YmdHis');
        return "seino_{$dt}";
    }

    private function shippingDate($shipping_date)
    {
        $dt = Carbon::parse($shipping_date);
        return $dt->format('Y/m/d');
    }

    private function deliveryDate($delivery_date)
    {
        $dt = Carbon::parse($delivery_date);
        return $dt->format('Ymd');
    }

    private function address($pref_id, $addr01)
    {
        $pref_name = $this->mtb_pref_repository->find($pref_id)->name;
        return "{$pref_name}{$addr01}";
    }
}