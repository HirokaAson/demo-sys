<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>{{ config('label.title')}}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/order/list.css') }}" rel="stylesheet">
  </head>
  @include('partials.navigation')
  <body>
    <div class="container">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">受注一覧</h5>
          <form class="form-horizontal" action="list" method="GET">
            <div class="row">
              <div class="form-group col-md-3">
                <div class="form-group">
                  <input type="text" name="customer_name" id="customer_name" maxlength="20" class="form-control" value="{{ $customer_name }}" placeholder="Enter Customer Name">
                </div>
              </div>
              <div class="form-group col-md-3">
                <div class="form-group">
                  <select id="select1a" class="form-control" name="order_status_id">
                    <option value="">-</option>
                    <option value="{{ config('ec_cube_order.status_id.delivered') }}" @if($order_status_id===config('ec_cube_order.status_id.delivered')) selected  @endif>発送済み</option>
                    <option value="{{ config('ec_cube_order.status_id.paid') }}" @if($order_status_id===config('ec_cube_order.status_id.paid')) selected  @endif>入金済み</option>
                  </select>
                </div>
              </div>
              <div class="form-group col-md-6">
                <div class="form-group">
                  <button type="submit" class="btn btn-outline-info">Search</button>
                </div>
              </div>
            </div>
          </form>
          <table class="table table-hover">
            <thead class="thead-dark">
              <tr>
                <th>#</th>
                <th>受付日</th>
                <th>注文者</th>
                <th>支払方法</th>
                <th>金額合計（円）</th>
                <th>対応状況</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($dtb_orders as $dtb_order)
                <tr>
                  <th scope="row">{{ $dtb_order->id }}</th>
                  <td>{{ $dtb_order->order_date }}</td>
                  <td>{{ $dtb_order->name01. $dtb_order->name02 }}</td>
                  <td>{{ $dtb_order->payment_method }}</td>
                  <td>{{ number_format($dtb_order->payment_total) }}</td>
                  @if ($dtb_order->order_status_id == config('ec_cube_order.status_id.paid'))
                    <td><span style="margin-right: 5px;" class="badge badge-ec-green">入金済み</span></td>
                  @elseif ($dtb_order->order_status_id == config('ec_cube_order.status_id.delivered'))
                    <td><span style="margin-right: 5px;" class="badge badge-ec-blue">発送済み</span></td>
                  @else
                    <td></td>
                  @endif
                  <td>
                      <a href="/order/{{ $dtb_order->id }}">
                        <img src="{{ asset('icon/printer.svg') }}" />
                      </a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          <!-- page control -->
          {{
            $dtb_orders
            ->appends(['order_status_id' => $order_status_id, 'customer_name' => $customer_name])
            ->links()
          }}
        </div>
      </div>
    </div>
  </body>
</html>