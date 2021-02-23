<div class="container">
  <canvas id="monthChart"></canvas>
  <div class="row">
    @foreach ($sales_month as $key1 => $value1)
      <div class="card col-md-3.5">
        <div class="card-body">
          <h5 class="card-title">{{$key1}}</h5>
          <table class="table table-hover">
            <thead class="thead-light">
              <tr>
                <th>Date</th>
                <th>Sales（円）</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($value1 as $key2 => $value2)
                <tr>
                  <td>{{ $key2 }}</td>
                  <td>{{ number_format($value2) }}</td>
                </tr>
              @endforeach
            </tbody>
            </table>
        </div>
      </div>
    @endforeach
  </div>
</div>
<script src="../js/analytics/month.js"></script>
<script>
  const data_sales = [];
  @foreach ($sales_month as $key1 => $value1)
    data_sales['{{$key1}}'] = [];
    @foreach ($value1 as $key2 => $value2)
    data_sales['{{$key1}}']['{{$key2}}'] = '{{$value2}}';
    @endforeach
  @endforeach

  monthChart(data_sales)
</script>