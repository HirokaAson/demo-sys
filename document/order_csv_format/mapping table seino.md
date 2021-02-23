|  item  |  not null  |  length  |  attribute  |  database.table  |  remark  |
| ---- | ---- | ---- | ---- | ---- | ---- |
|  荷送人コード  |  ○  |  11  |  半角  |    |  西濃運輸との運賃契約コードを入力<br />※マスター管理>荷送人一覧 にセット済みの荷送人コードのみ利用できます  |
|  ~~西濃発店コード~~  |    |  4  |  半角  |    |    |
|  出荷予定日  |    |  8  |  半角  |  dtb_shipping.shipping_date  |  西暦年月日（YYYYMMDD 例: 20140210）<br />※空白の場合取込日になります<br />※過去日付での登録はできません<br />※スラッシュ(/)自動除去  |
|  ~~お問合番号~~  |    |  10  |  半角  |    |    |
|  管理番号  |  ○  |  20  |  半角  |  dtb_order.order_no  |  お客様にて任意で管理に使われる番号<br />※21文字目以降は切り捨て、20文字までが登録されます<br />※取り込む出荷データ内で1件ずつ重複しないもの(例: 001 ~ 連番)<br />主キー項目 : 出荷予定日 + 管理番号<br />※出荷予定日が同じ + 同じ管理番号で、一括登録をすると、キー項目が同じため、読み飛ばしまたは上書きされます。<br />（基本設定 > 出荷取込設定 > 既に登録済みのデータ項目の設定に準じる）  |
|  元着区分  |    |  1  |  半角  |    |  1 : 元払<br />3 : 着払  |
|  原票区分  |    |  1  |  半角  |    |  0 : 一般<br />1 : 宅配<br />3 : ミニ<br />8 : 通販<br />9 : ビジネス  |
|  個数  |  ○  |  5  |  半角  |    |  出荷可能な個数は、1 ~ 999個まで  |
|  ~~重量区分~~  |    |  1  |  半角  |    |    |
|  重量Ｋ  |    |  5  |  半角  |    |  登録可能な重量は、1 ~ 999999 KGまで（小数点不可）  |
|  ~~重量才~~  |    |  5  |  半角  |    |  登録可能な重量は、1 ~ 999999 KGまで（小数点不可）  |
|  荷送人名称  |  ○  |  20  |  全角  |  dtb_order.name01 + dtb_order.name02  |  荷送人コードが荷送人マスターに存在する場合省力可  |
|  荷送人住所１  |  ○  |  20  |  全角  |  dtb_order.pref_id +　dtb_order.addr01  |  荷送人コードが荷送人マスターに存在する場合省力可  |
|  荷送人住所２  |    |  20  |  全角  |  dtb_order.addr02  |    |
|  荷送人電話番号  |  ○  |  13  |  半角  |  dtb_order.phone_number  |  荷送人コードが荷送人マスターマスターに存在する場合省力可  |
|  部署コード  |    |  2  |  半角  |    |  部署マスターに存在すること  |
|  部署名  |    |  15  |  全角  |    |    |
|  ~~重量契約区分~~  |    |  1  |  半角  |    |    |
|  お届け先郵便番号  |    |  7  |  半角  |  dtb_shipping.postal_code  |    |
|  お届け先名称１  |  ○  |  30  |  全角  |  dtb_shipping.company_name  |  お届け先コードがお届け先マスターに存在する場合省略可  |
|  お届け先名称2  |    |  30  |  全角  |  dtb_shipping.name01 + dtb_shipping.name02  |    |
|  お届け先住所１  |  ○  |  30  |  全角  |  dtb_shipping.pref_id + dtb_shipping.addr01  |  お届け先コードがお届け先マスターに存在する場合省略可<br />※都道府県から入力して下さい。  |
|  お届け先住所２  |    |  30  |  全角  |  dtb_shipping.addr02  |    |
|  お届け先電話番号  |  ○  |  13  |  半角  |  dtb_shipping.phone_number  |  お届け先コードがお届け先マスターに存在する場合省略可  |
|  お届け先コード  |    |  12  |  半角  |    |    |
|  お届け先ＪＩＳ<br />市町村コード  |    |  5  |  半角  |    |    |
|  ~~着店コード付け区分~~  |    |  1  |  半角  |    |    |
|  ~~着地コード~~  |    |  9  |  半角  |    |    |
|  ~~着店コード~~  |    |  4  |  半角  |    |    |
|  保険金額  |    |  5  |  半角  |    |  単位:万円  |
|  ~~輸送指示1~~  |    |  15  |  全角  |    |    |
|  ~~輸送指示2~~  |    |  15  |  全角  |    |    |
|  記事1  |    |  15  |  全角  |    |    |
|  記事2  |    |  15  |  全角  |    |    |
|  記事3  |    |  15  |  全角  |    |    |
|  記事4  |    |  15  |  全角  |    |    |
|  記事5  |    |  15  |  全角  |    |    |
|  輸送指示配達指定日  |    |  5  |  半角  |    |  輸送指示コード1・2のどちらかに02(配達指定)をセットした時のみ<br />月日(4桁)+区分<br />【一般・ミニ・宅配・ビジネス便の場合】<br />区分･･･0：希望無、1：午前、2：午後 <br />【通販便の場合】<br />区分･･･0：希望無、5：9:00～12:00、6：12:00～17:00、7：17:00～20:00(0:当日中　1:午前　2:午後)<br />※区分のみの指定もできます。その場合は、｢月日（0000）＋区分」でご指定ください。  |
|  輸送指示コード１  |    |  2  |  半角  |    |  01 : 止商品<br />02 : 配達指定<br />03 : 取扱注意<br />04 : われもの注意<br />05 : ガラス注意<br />06 : コワレモノ<br />07 : 水濡れ注意<br />08 : 精密機器<br />09 : 下積厳禁<br />10 : 横積厳禁<br />11 : 平積厳禁<br />12 : 立積厳禁<br />13 : 天地無用<br />14 : 角つき厳禁<br />15 : 貴重品<br />16 : 高価品<br />17 : 予約  |
|  輸送指示コード２  |    |  2  |  半角  |    |  01 : 止商品<br />02 : 配達指定<br />03 : 取扱注意<br />04 : われもの注意<br />05 : ガラス注意<br />06 : コワレモノ<br />07 : 水濡れ注意<br />08 : 精密機器<br />09 : 下積厳禁<br />10 : 横積厳禁<br />11 : 平積厳禁<br />12 : 立積厳禁<br />13 : 天地無用<br />14 : 角つき厳禁<br />15 : 貴重品<br />16 : 高価品<br />17 : 予約  |
|  輸送指示とめ店所  |    |  4  |  全角  |    |  輸送指示コード1・2のどちらかに01(止荷物)をセットした時のみ  |
|  予備  |    |  120  |  全角  |    |  EXCELで作成する場合、データの最後を認識させるため、ダミーとして”0”を入力して下さい  |
|  品代金  |    |  9  |  半角  |    |  ※代引契約ありの場合のみ利用可能です<br />※ドライバーの収受金額を入力してください。  |
|  消費税  |    |  9  |  半角  |    |  品代金に含まれている消費税<br />空白 : 品代金より、消費税を自動計算  |