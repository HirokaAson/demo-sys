<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>{{ config('label.title')}}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  </head>
  @include('partials.navigation')
  <body>
    <button type="button" class="btn btn-outline-light" onclick="history.back()">
      <img src="{{ asset('icon/back.svg') }}" />
    </button>
    <form class="form-horizontal" action="export" method="POST">
      {{ csrf_field() }}

      <input type="hidden" name="order_id" value="{{ $order_id }}" />
      <div class="container">
        <div class="row">
          <div class="col-md-11">
            <div class="text-right">
              <input name="print-btn" type="checkbox" checked data-toggle="toggle" data-size="normal" data-on="Not Print" data-off="Print"  data-onstyle="warning" data-offstyle="info">
            </div>
          </div>
        </div>
        <hr>

        <div class="row">
          <div class="card col-md-8">
            <div class="card-body">
              <h5 class="card-title">受注</h5>
              <table class="table table-hover">
                <tbody>
                  <tr>
                    <td>受注番号</td>
                    <td>{{ $order->order_no }}</td>
                  </tr>
                  <tr>
                    <td>名前</td>
                    <td>{{ $order->name01. $order->name02 }}</td>
                  </tr>
                  <tr>
                    <td>郵便番号</td>
                    <td>{{ $order->postal_code }}</td>
                  </tr>
                  <tr>
                    <td>住所</td>
                    <td>{{ $order_pref }}{{ $order->addr01 }}<br />{{ $order->addr02 }}</td>
                  </tr>
                  <tr>
                    <td>配達料</td>
                    <td>{{ number_format($order->delivery_fee_total) }}</td>
                  </tr>
                  <tr>
                    <td>支払い合計</td>
                    <td>{{ number_format($order->payment_total) }}</td>
                  </tr>
                </tbody>
              </table>
              <h5 class="card-title">配送</h5>
              <table class="table table-hover">
                <tbody>
                  <tr>
                    <td>トラッキング番号</td>
                    <td>{{ $shipping->tracking_number }}</td>
                  </tr>
                  <tr>
                    <td>名前</td>
                    <td>{{ $shipping->name01. $shipping->name02 }}</td>
                  </tr>
                  <tr>
                    <td>電話番号</td>
                    <td>{{ $shipping->phone_number }}</td>
                  </tr>
                  <tr>
                    <td>郵便番号</td>
                    <td>{{ $shipping->postal_code }}</td>
                  </tr>
                  <tr>
                    <td>住所</td>
                    <td>{{ $shipping_pref }}{{ $shipping->addr01 }}<br />{{ $shipping->addr02 }}</td>
                  </tr>
                  <tr>
                    <td>配達</td>
                    <td>{{ $shipping->delivery_name }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="form-group col-md-2">
            <select id="select1a" class="form-control" name="csv_export_type">
              <option value="{{ config('csv_export_type.yayoi') }}">弥生販売</option>
              <!-- <option value="{{ config('csv_export_type.order_form') }}">注文書</option> -->
              <!-- <option value="{{ config('csv_export_type.yamato') }}">ヤマト運輸</option>
              <option value="{{ config('csv_export_type.sagawa') }}">佐川運輸</option>
              <option value="{{ config('csv_export_type.yu_pack') }}">ゆうパック</option>
              <option value="{{ config('csv_export_type.seino') }}">西濃運輸</option> -->
            </select>
            <div class="form-group">
            @if (session('error_message'))
              <strong class="text-danger">{{ session('error_message') }}</strong>
            @endif
            </div>
          </div>
          <div  class="form-group col-md-2">
            <div class="form-group">
              <button id="export-btn" type="submit" class="btn btn-outline-info">Export</button>
            </div>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="card col-md-8">
            <div class="card-body">
              <h5 class="card-title">Order</h5>
              <table class="table table-hover">
                <thead class="thead-dark">
                  <tr>
                    <th>商品コード</th>
                    <th>商品名</th>
                    <th>カテゴリー名</th>
                    <th>金額</th>
                    <th>数量</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($order_item as $order_item)
                    <tr>
                      <th scope="row">{{ $order_item->product_code }}</th>
                      <td>{{ $order_item->product_name }}</td>
                      <td>{{ $order_item->class_category_name1 }}</td>
                      <td>{{ number_format($order_item->price) }}</td>
                      <td>{{ $order_item->quantity }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </form>
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
    $(function() {
      $('[name="print-btn"]').change(() => {
        if($('[name="print-btn"]').prop('checked')) {
          $('body').removeAttr('style');
          $('#export-btn').show();
          $('#select1a').show();
          $('.col-md-12').removeClass('col-md-12');
          $('.card').addClass('col-md-8');
        } else {
          $('body').css('fontSize', '25px');
          $('#export-btn').hide();
          $('#select1a').hide();
          $('.col-md-8').removeClass('col-md-8');
          $('.card').addClass('col-md-12');
        }
      });
    });
    </script>
  </body>
</html>