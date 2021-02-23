<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>{{ config('label.title')}}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  </head>
  @include('partials.navigation')
  <body>
    <div class="container">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">会員一覧</h5>
          <form class="form-horizontal" action="list" method="GET">
            <div class="row">
              <div class="form-group col-md-3">
                <div class="form-group">
                  <input type="text" name="company_name" id="company_name" maxlength="20" class="form-control" value="{{ $company_name }}" placeholder="Enter Compnay Name">
                </div>
              </div>
              <div class="form-group col-md-3">
                <div class="form-group">
                  <input type="text" name="customer_name" id="customer_name" maxlength="20" class="form-control" value="{{ $customer_name }}" placeholder="Enter Customer Name">
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
                <th>会社</th>
                <th>名前</th>
                <th>メールアドレス</th>
                <th>電話番号</th>
                <th>弥生販売連携コード</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($dtb_customers as $dtb_customer)
                <tr>
                  <th scope="row">{{ $dtb_customer->id }}</th>
                  <td>{{ $dtb_customer->company_name }}</td>
                  <td>{{ $dtb_customer->name01. $dtb_customer->name02 }}</td>
                  <td>{{ $dtb_customer->email }}</td>
                  <td>{{ $dtb_customer->phone_number }}</td>
                  <td>{{ $dtb_customer->integration_code }}</td>
                  <td>
                      <a href="/customer/{{ $dtb_customer->id }}">
                        <img src="{{ asset('icon/pencil.svg') }}" />
                      </a>
                  </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <!-- page control -->
          {{
            $dtb_customers
            ->appends(['company_name' => $company_name, 'customer_name' => $customer_name])
            ->links()
          }}
        </div>
      </div>
    </div>
  </body>
</html>