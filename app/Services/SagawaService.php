<?php

namespace App\Services;

use Carbon\Carbon;

class SagawaService extends BaseDeliveryService implements IDeliveryService
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
            '住所録コード',
            'お届け先電話番号',
            'お届け先郵便番号',
            'お届け先住所１（必須）',
            'お届け先住所２',
            'お届け先住所３',
            'お届け先名称１（必須）',
            'お届け先名称２',
            'お客様管理ナンバー',
            'お客様コード',
            '部署・担当者',
            '荷送人電話番号',
            'ご依頼主電話番号',
            'ご依頼主郵便番号',
            'ご依頼主住所１',
            'ご依頼主住所２',
            'ご依頼主名称１',
            'ご依頼主名称２',
            '荷姿コード',
            '品名１',
            '品名２',
            '品名３',
            '品名４',
            '品名５',
            '出荷個数',
            '便数（スピードで選択）',
            '便数（商品）',
            '配達日',
            '配達指定時間帯',
            '配達時間指定時間（時分）',
            '代引金額',
            '消費税',
            '決済種別',
            '保険金額',
            '保険金額印字',
            '指定シール①',
            '指定シール②',
            '指定シール③',
            '営業店止め',
            'SRC区分',
            '営業店コード',
            '元着区分'
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

        $order_item_index = 0;
        return [
            [
                '', // 住所録コード
                $shipping->phone_number, // お届け先電話番号
                $shipping->postal_code, // お届け先郵便番号
                $this->address($shipping->pref_id, $shipping->addr01), // お届け先住所１（必須）
                $shipping->addr02, // お届け先住所２
                '', // お届け先住所３
                $shipping->company_name, // お届け先名称１（必須）
                "{$shipping->name01}{$shipping->name02}", // お届け先名称２
                '', // お客様管理ナンバー
                '', // お客様コード
                '', // 部署・担当者
                '', // 荷送人電話番号
                $order->phone_number, // ご依頼主電話番号
                $order->postal_code, // ご依頼主郵便番号
                $this->address($order->pref_id, $order->addr01), // ご依頼主住所１
                $order->addr02, // ご依頼主住所２
                $order->company_name, // ご依頼主名称１
                "{$order->name01}{$order->name02}", // ご依頼主名称２
                '', // 荷姿コード
                isset($order_items[$order_item_index]) ? $order_items[$order_item_index]->product_name : '', // 品名１
                isset($order_items[++$order_item_index]) ? $order_items[$order_item_index]->product_name : '', // 品名２
                isset($order_items[++$order_item_index]) ? $order_items[$order_item_index]->product_name : '', // 品名３
                isset($order_items[++$order_item_index]) ? $order_items[$order_item_index]->product_name : '', // 品名４
                isset($order_items[++$order_item_index]) ? $order_items[$order_item_index]->product_name : '', // 品名５
                '', // 出荷個数
                '', // 便数（スピードで選択）
                '', // 便数（商品）
                $this->deliveryDate($shipping->delivery_date), // 配達日
                $this->deliveryTime($shipping->delivery_time), // 配達指定時間帯
                '', // 配達時間指定時間（時分）
                '', // 代引金額
                '', // 消費税
                '', // 決済種別
                '', // 保険金額
                '', // 保険金額印字
                '', // 指定シール①
                '', // 指定シール②
                '', // 指定シール③
                '', // 営業店止め
                '', // SRC区分
                '', // 営業店コード
                '', // 元着区分
            ],
        ];
    }

    private function filename()
    {
        $dt = Carbon::now()->format('YmdHis');
        return "sagawa_{$dt}";
    }

    private function deliveryDate($delivery_date)
    {
        $dt = Carbon::parse($delivery_date);
        return $dt->format('Ymd');
    }

    private function deliveryTime($delivery_time)
    {
        if ($delivery_time === config('ec_cube_order.delivery_time.2')) {
            return '01';
        } elseif ($delivery_time === config('ec_cube_order.delivery_time.3')) {
            return '14';
        } elseif ($delivery_time === config('ec_cube_order.delivery_time.4')) {
            return '16';
        } elseif ($delivery_time === config('ec_cube_order.delivery_time.5')) {
            return '18';
        } elseif ($delivery_time === config('ec_cube_order.delivery_time.6')) {
            return '19';
        } else {
            return '';
        }
    }

    private function address($pref_id, $addr01)
    {
        $pref_name = $this->mtb_pref_repository->find($pref_id)->name;
        return "{$pref_name}{$addr01}";
    }
}