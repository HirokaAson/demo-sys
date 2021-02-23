<?php

namespace App\Services;

use Carbon\Carbon;

class YamatoService extends BaseDeliveryService implements IDeliveryService
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
            'お客様管理番号',
            '送り状種類',
            'クール区分',
            '伝票番号',
            '出荷予定日',
            'お届け予定日',
            '配達時間帯',
            'お届け先コード',
            'お届け先電話番号',
            'お届け先電話番号枝番',
            'お届け先郵便番号',
            'お届け先住所',
            'お届け先アパートマンション名',
            'お届け先会社・部門１',
            'お届け先会社・部門２',
            'お届け先名',
            'お届け先名（ｶﾅ）',
            '敬称',
            'ご依頼主コード',
            'ご依頼主電話番号',
            'ご依頼主電話番号枝番',
            'ご依頼主郵便番号',
            'ご依頼主住所',
            'ご依頼主アパートマンション',
            'ご依頼主名',
            'ご依頼主名（ｶﾅ）',
            '品名コード１',
            '品名１',
            '品名コード２',
            '品名２',
            '荷扱い１',
            '荷扱い２',
            '記事',
            'コレクト代金引換額（税込）',
            '内消費税等',
            '止置き',
            '営業所コード',
            '発行枚数',
            '個数口表示フラグ',
            '請求先顧客コード',
            '請求先分類コード',
            '運賃管理番号',
            'クロネコwebコレクトデータ登録',
            'クロネコwebコレクト加盟店番号',
            'クロネコwebコレクト申込受付番号１',
            'クロネコwebコレクト申込受付番号２',
            'クロネコwebコレクト申込受付番号３',
            'お届け予定eメール利用区分',
            'お届け予定eメールe-mailアドレス',
            '入力機種',
            'お届け予定eメールメッセージ',
            'お届け完了eメール利用区分',
            'お届け完了eメールe-mailアドレス',
            'お届け完了eメールメッセージ',
            'クロネコ収納代行利用区分',
            '予備',
            '収納代行請求金額（税込）',
            '収納代行内消費税学等',
            '収納代行請求先郵便番号',
            '収納代行請求先住所',
            '収納代行請求先住所（アパートマンション名）',
            '収納代行請求先会社・部門名１',
            '収納代行請求先会社・部門名２',
            '収納代行請求先名（漢字）',
            '収納代行請求先名（カナ）',
            '収納代行問合せ先名（漢字）',
            '収納代行問合せ先郵便番号',
            '収納代行問合せ先住所',
            '収納代行問合せ先住所（アパートマンション名）',
            '収納代行問合せ先電話番号',
            '収納代行管理番号',
            '収納代行品名',
            '収納代行備考',
            '複数口くくりキー',
            '検索キータイトル１',
            '検索キー１',
            '検索キータイトル２',
            '検索キー２',
            '検索キータイトル３',
            '検索キー３',
            '検索キータイトル４',
            '検索キー４',
            '検索キータイトル５',
            '検索キー５',
            '予備',
            '予備',
            '投函予定メール利用区分',
            '投函予定メールe-mailアドレス',
            '投函予定メールメッセージ',
            '投函完了メール（お届け先宛）利用区分',
            '投函完了メール（お届け先宛）e-mailアドレス',
            '投函完了メール（お届け先宛）メールメッセージ',
            '投函完了メール（ご依頼主宛）利用区分',
            '投函完了メール（ご依頼主宛）e-mailアドレス',
            '投函完了メール（ご依頼主宛）メールメッセージ'
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
                '', // お客様管理番号
                '', // 送り状種類
                '', // クール区分
                '', // 伝票番号
                $this->shippingDate($shipping->shipping_date), // 出荷予定日
                $this->deliveryDate($shipping->delivery_date), // お届け予定日
                $this->deliveryTime($shipping->delivery_time), // 配達時間帯
                '', // お届け先コード
                $shipping->phone_number, // お届け先電話番号
                '', // お届け先電話番号枝番
                $shipping->postal_code, // お届け先郵便番号
                $this->address($shipping->pref_id, $shipping->addr01), // お届け先住所
                $shipping->addr02, // お届け先アパートマンション名
                $shipping->company_name, // お届け先会社・部門１
                '', // お届け先会社・部門２
                "{$shipping->name01}{$shipping->name02}", // お届け先名
                "{$shipping->kana01}{$shipping->kana02}", // お届け先名（ｶﾅ）
                '', // 敬称
                '', // ご依頼主コード
                $order->phone_number, // ご依頼主電話番号
                '', // ご依頼主電話番号枝番
                $order->postal_code, // ご依頼主郵便番号
                $this->address($order->pref_id, $order->addr01), // ご依頼主住所
                $order->addr02, // ご依頼主アパートマンション
                "{$order->name01}{$order->name02}", // ご依頼主名
                "{$order->kana01}{$order->kana02}", // ご依頼主名（ｶﾅ）
                '', // 品名コード１
                '', // 品名１
                '', // 品名コード２
                '', // 品名２
                '', // 荷扱い１
                '', // 荷扱い２
                '', // 記事
                '', // コレクト代金引換額（税込）
                '', // 内消費税等
                '', // 止置き
                '', // 営業所コード
                '', // 発行枚数
                '', // 個数口表示フラグ
                '', // 請求先顧客コード
                '', // 請求先分類コード
                '', // 運賃管理番号
                '', // クロネコwebコレクトデータ登録
                '', // クロネコwebコレクト加盟店番号
                '', // クロネコwebコレクト申込受付番号１
                '', // クロネコwebコレクト申込受付番号２
                '', // クロネコwebコレクト申込受付番号３
                '', // お届け予定eメール利用区分
                '', // お届け予定eメールe-mailアドレス
                '', // 入力機種
                '', // お届け予定eメールメッセージ
                '', // お届け完了eメール利用区分
                '', // お届け完了eメールe-mailアドレス
                '', // お届け完了eメールメッセージ
                '', // クロネコ収納代行利用区分
                '', // 予備
                '', // 収納代行請求金額（税込）
                '', // 収納代行内消費税学等
                '', // 収納代行請求先郵便番号
                '', // 収納代行請求先住所
                '', // 収納代行請求先住所（アパートマンション名）
                '', // 収納代行請求先会社・部門名１
                '', // 収納代行請求先会社・部門名２
                '', // 収納代行請求先名（漢字）
                '', // 収納代行請求先名（カナ）
                '', // 収納代行問合せ先名（漢字）
                '', // 収納代行問合せ先郵便番号
                '', // 収納代行問合せ先住所
                '', // 収納代行問合せ先住所（アパートマンション名）
                '', // 収納代行問合せ先電話番号
                '', // 収納代行管理番号
                '', // 収納代行品名
                '', // 収納代行備考
                '', // 複数口くくりキー
                '', // 検索キータイトル１
                '', // 検索キー１
                '', // 検索キータイトル２
                '', // 検索キー２
                '', // 検索キータイトル３
                '', // 検索キー３
                '', // 検索キータイトル４
                '', // 検索キー４
                '', // 検索キータイトル５
                '', // 検索キー５
                '', // 予備
                '', // 予備
                '', // 投函予定メール利用区分
                '', // 投函予定メールe-mailアドレス
                '', // 投函予定メールメッセージ
                '', // 投函完了メール（お届け先宛）利用区分
                '', // 投函完了メール（お届け先宛）e-mailアドレス
                '', // 投函完了メール（お届け先宛）メールメッセージ
                '', // 投函完了メール（ご依頼主宛）利用区分
                '', // 投函完了メール（ご依頼主宛）e-mailアドレス
                '', // 投函完了メール（ご依頼主宛）メールメッセージ
            ],
        ];
    }

    private function filename()
    {
        $dt = Carbon::now()->format('YmdHis');
        return "yamato_{$dt}";
    }

    private function shippingDate($shipping_date)
    {
        $dt = Carbon::parse($shipping_date);
        return $dt->format('Y/m/d');
    }

    private function deliveryDate($delivery_date)
    {
        $dt = Carbon::parse($delivery_date);
        return $dt->format('Y/m/d');
    }
    
    private function deliveryTime($delivery_time)
    {
        if ($delivery_time === config('ec_cube_order.delivery_time.1')) {
            return '';
        } elseif ($delivery_time === config('ec_cube_order.delivery_time.2')) {
            return '0812';
        } elseif ($delivery_time === config('ec_cube_order.delivery_time.3')) {
            return '1416';
        } elseif ($delivery_time === config('ec_cube_order.delivery_time.4')) {
            return '1618';
        } elseif ($delivery_time === config('ec_cube_order.delivery_time.5')) {
            return '1820';
        } elseif ($delivery_time === config('ec_cube_order.delivery_time.6')) {
            return '1921';
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