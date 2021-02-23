<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>{{ config('label.title')}}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>

  </head>
  @include('partials.navigation')
  <body>
    <div class="container-fuild border">
      <div class="row">
        <div class="col-2">
          <div class="list-group" id="list-tab" role="tablist">
            <a class="list-group-item list-group-item-action active" id="tab-menu-1"
                data-toggle="list" href="#tab-content-1"
                role="tab" aria-controls="tab-content-1">期間別-年</a>
            <a class="list-group-item list-group-item-action" id="tab-menu-2"
                data-toggle="list" href="#tab-content-2"
                role="tab" aria-controls="tab-content-2">期間別-月</a>
            <a class="list-group-item list-group-item-action" id="tab-menu-3"
                data-toggle="list" href="#tab-content-3"
                role="tab" aria-controls="tab-content-3">商品別</a>
            <a class="list-group-item list-group-item-action" id="tab-menu-4"
                data-toggle="list" href="#tab-content-4"
                role="tab" aria-controls="tab-content-4">都道府県別</a>
          </div>
        </div>
        <div class="col-10">
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="tab-content-1"
                role="tabpanel" aria-labelledby="tab-menu-1">@include('analytics.year')</div>
            <div class="tab-pane fade" id="tab-content-2"
                role="tabpanel" aria-labelledby="tab-menu-2">@include('analytics.month')</div>
            <div class="tab-pane fade" id="tab-content-3"
                role="tabpanel" aria-labelledby="tab-menu-3">@include('analytics.product')</div>
            <div class="tab-pane fade" id="tab-content-4"
                role="tabpanel" aria-labelledby="tab-menu-4">@include('analytics.pref')</div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>