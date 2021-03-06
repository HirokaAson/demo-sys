<?php

return [
    'delete_mark' => [
        '1' => 1, // 通常伝票
        '3' => 3, // 日次締後削除
        '4' => 4, // 締切を行った伝票を訂正したときに発生する内部赤伝
        '5' => 5, // 2回締切を行った後に訂正した際に発生する内部赤伝
    ],    
    'closing_flg' => [
        '1' => 1, // 今回
        '2' => 2, // 次回
    ], 
    'check' => [
        '0' => 0, // 未消込
        '1' => 1, // 消込済
    ], 
    'slip_class' => [
        '24' => 24, // 売上
    ], 
    'transaction_class' => [
        '1' => 1, // 掛売
        '2' => 2, // 現金
        '3' => 3, // サンプル
        '4' => 4, // 都度請求
    ], 
    'tax_pass_through' => [
        '2' => 1, // 外税/伝票計
        '3' => 2, // 外税/請求時
        '1' => 3, // 内税
        '4' => 4, // 輸出
        '5' => 5, // 内税/総額
        '6' => 6, // 内税/請求時
        '7' => 7, // 外税/請求時調整
        '9' => 9, // 外税/手入力
    ], 
    'amount_rouding' => [
        '2' => 1, // 切り捨て
        '3' => 2, // 切り上げ
        '1' => 3, // 四捨五入
    ], 
    'tax_rouding' => [
        '2' => 1, // 切り捨て
        '3' => 2, // 切り上げ
        '1' => 3, // 四捨五入
    ], 
    'item_class' => [
        '0' => 0, // 伝票摘要
        '1' => 1, // 通常
        '2' => 2, // 返品
        '3' => 3, // 値引き
        '4' => 4, // 諸経費
        '5' => 5, // 摘要
        '6' => 6, // メモ
        '9' => 9, // 請求時消費税/手入力消費税
        '99' => 99, // 伝票消費税
    ], 
    'tax_class' => [
        '10' => 10, // 課税 3.0%
        '11' => 11, // 課税 5.0%
        '12' => 12, // 課税 8.0%
        '13' => 13, // 課税 10.0%
        '20' => 20, // 課税(自) 6.0%
        '21' => 21, // 課税(自) 4.5%
        '22' => 22, // 課税(自) 3.0%
        '30' => 30, // 課税(軽) 8.0%
        '70' => 70, // 免税(輸)
        '80' => 80, // 非課税
        '90' => 90, // 対象外
    ], 
];
