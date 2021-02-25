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
    <div class="container">
      <!-- <h5 class="card-title">弥生販売連携</h5> -->
      @if ($yayoi_sales_id)
        <form class="form-horizontal" action="edit/{{ $customer_id }}/{{ $yayoi_sales_id }}" method="POST">
      @else
        <form class="form-horizontal" action="create/{{ $customer_id }}" method="POST">
      @endif
        {{ csrf_field() }}
        <div class="row">
          <div class="form-group col-md-4">
            <div class="form-group">
              <label>会社</label>
              <input type="text" name="company_name" id="userphone" maxlength="12" class="form-control" value="{{ $customer_item->company_name}}" disabled>
            </div>
          </div>
          <div class="form-group col-md-4">
            <div class="form-group">
              <label>名前</label>
              <input type="text" name="name" id="userphone" maxlength="12" class="form-control" value="{{ $customer_item->name01. $customer_item->name02}}" disabled>
            </div>
          </div>
          <div class="form-group col-md-4">
            <div class="form-group">
              <label>メールアドレス</label>
              <input type="text" name="email" id="userphone" maxlength="12" class="form-control" value="{{ $customer_item->email}}" disabled>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-4">
            <div class="form-group">
              <label>弥生販売連携コード</label>
              <input type="text" name="integration_code" id="userphone" maxlength="12" class="form-control" value="{{ $integration_code}}" placeholder="Enter integration code">
            </div>
            <div class="form-group">
              <label>単価種類</label>
              <select id="select_price_type" class="form-control" name="select_price_type">
                <option value="">-</option>
                @foreach ($yayoi_integration_items['price_type'] as $price_type)
                  @if ($price_type_id === $price_type->id)
                    <option value="{{ $price_type->id }}" selected>{{ $price_type->price_type_name }}</option>
                  @else
                    <option value="{{ $price_type->id }}">{{ $price_type->price_type_name }}</option>
                  @endif
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="select_billding_address_code">請求先</label>
              <input type="text" name="billding_address_code" id="billding_address_code" maxlength="12" class="form-control" value="{{ $billding_address_code }}" placeholder="Enter billding address code">
            </div>
            <div class="form-group">
              <label>締めグループ</label>
              <select id="select_closing_group" class="form-control" name="select_closing_group">
                <option value="">-</option>
                @foreach ($yayoi_integration_items['closing_group'] as $closing_group)
                  @if ($closing_group_code === $closing_group->code)
                    <option value="{{ $closing_group->code }}" selected>{{ $closing_group->closing_group_name }}</option>
                  @else
                    <option value="{{ $closing_group->code }}">{{ $closing_group->closing_group_name }}</option>
                  @endif
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>税転嫁</label>
              <select id="select_tax_pass_through_type" class="form-control" name="select_tax_pass_through_type">
                <option value="">-</option>
                @foreach ($yayoi_integration_items['tax_pass_through_type'] as $tax_pass_through_type)
                  @if ($tax_pass_through_type_id === $tax_pass_through_type->id)
                    <option value="{{ $tax_pass_through_type->id }}" selected>{{ $tax_pass_through_type->tax_pass_through_type_name }}</option>
                  @else
                    <option value="{{ $tax_pass_through_type->id }}">{{ $tax_pass_through_type->tax_pass_through_type_name }}</option>
                  @endif
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group col-md-4">
            <div class="form-group">
              <label>金額端数処理</label>
              <select id="select_amount_rouding_type" class="form-control" name="select_amount_rouding_type">
                <option value="">-</option>
                @foreach ($yayoi_integration_items['amount_rouding_type'] as $amount_rouding_type)
                  @if ($amount_rouding_type_id === $price_type->id)
                    <option value="{{ $amount_rouding_type->id }}" selected>{{ $amount_rouding_type->name }}</option>
                  @else
                    <option value="{{ $amount_rouding_type->id }}">{{ $amount_rouding_type->name }}</option>
                  @endif
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>税端数処理</label>
              <select id="select_tax_rouding_type" class="form-control" name="select_tax_rouding_type">
                <option value="">-</option>
                @foreach ($yayoi_integration_items['tax_rouding_type'] as $tax_rouding_type)
                  @if ($amount_rouding_type_id === $price_type->id)
                    <option value="{{ $tax_rouding_type->id }}" selected>{{ $tax_rouding_type->name }}</option>
                  @else
                    <option value="{{ $tax_rouding_type->id }}">{{ $tax_rouding_type->name }}</option>
                  @endif
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>回収方法</label>
              <input type="text" name="collect_money_code" id="collect_money_code" maxlength="12" class="form-control" value="{{ $collect_money_code }}" placeholder="Enter collect money code">
            </div>
            <div class="form-group">
              <label>回収サイクル</label>
              <select id="select_collect_money_cycle_type" class="form-control" name="select_collect_money_cycle_type">
                <option value="">-</option>
                @foreach ($yayoi_integration_items['collect_money_cycle_type'] as $collect_money_cycle_type)
                  @if ($collect_money_cycle_type_id === $collect_money_cycle_type->id)
                    <option value="{{ $collect_money_cycle_type->id }}" selected>{{ $collect_money_cycle_type->collect_money_cycle_type_name }}</option>
                  @else
                    <option value="{{ $collect_money_cycle_type->id }}">{{ $collect_money_cycle_type->collect_money_cycle_type_name }}</option>
                  @endif
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>回収日</label>
              <input type="text" name="collect_money_cycle_day" id="collect_money_cycle_day" maxlength="12" class="form-control" value="{{ $collect_money_cycle_day }}" placeholder="Enter collect money cycle day">
            </div>
          </div>
          <div class="form-group col-md-4">
            <div class="form-group">
              <label>売掛残高</label>
              <input type="text" name="account_receivable_balance" id="account_receivable_balance" maxlength="12" class="form-control" value="{{ $account_receivable_balance }}" placeholder="Enter account receivable balance">
            </div>
            <div class="form-group">
              <label>分類１</label>
              <select id="select_classification_one_type" class="form-control" name="select_classification_one_type">
                <option value="">-</option>
                @foreach ($yayoi_integration_items['classification_one_type'] as $classification_one_type)
                  @if ($classification_one_type_id === $classification_one_type->id)
                    <option value="{{ $classification_one_type->id }}" selected>{{ $classification_one_type->classification_one_type_name }}</option>
                  @else
                    <option value="{{ $classification_one_type->id }}">{{ $classification_one_type->classification_one_type_name }}</option>
                  @endif
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>分類２</label>
              <select id="select_classification_two_type" class="form-control" name="select_classification_two_type">
                <option value="">-</option>
                @foreach ($yayoi_integration_items['classification_two_type'] as $classification_two_type)
                  @if ($classification_two_type_id === $classification_two_type->id)
                    <option value="{{ $classification_two_type->id }}" selected>{{ $classification_two_type->classification_two_type_name }}</option>
                  @else
                    <option value="{{ $classification_two_type->id }}">{{ $classification_two_type->classification_two_type_name }}</option>
                  @endif
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>分類３</label>
              <select id="select_classification_three_type" class="form-control" name="select_classification_three_type">
                <option value="">-</option>
                @foreach ($yayoi_integration_items['classification_three_type'] as $classification_three_type)
                  @if ($classification_three_type_id === $classification_three_type->id)
                    <option value="{{ $classification_three_type->id }}" selected>{{ $classification_three_type->classification_three_type_name }}</option>
                  @else
                    <option value="{{ $classification_three_type->id }}">{{ $classification_three_type->classification_three_type_name }}</option>
                  @endif
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>参照表示</label>
              <select id="select_reference_display_type" class="form-control" name="select_reference_display_type">
                <option value="">-</option>
                @foreach ($yayoi_integration_items['reference_display_type'] as $reference_display_type)
                  @if ($reference_display_type_id === $reference_display_type->id)
                    <option value="{{ $reference_display_type->id }}" selected>{{ $reference_display_type->reference_display_type_name }}</option>
                  @else
                    <option value="{{ $reference_display_type->id }}">{{ $reference_display_type->reference_display_type_name }}</option>
                  @endif
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary">
                <i class="fa fa-fw fa-edit"></i>
                Save
              </button>
              @if (session('save_message'))
                <strong>{{ session('save_message') }}</strong>
              @endif
            </div>
          </div>
        </div>
      </form>
    </div>
  </body>
</html>