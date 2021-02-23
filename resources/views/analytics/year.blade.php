  <div class="container">
    <canvas id="yearChart"></canvas>
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Sales - Year</h5>
        <table class="table table-hover">
          <thead class="thead-light">
            <tr>
              <th>Date</th>
              <th>Sales（円）</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($sales_years as $sales_year)
              <tr>
                <td>{{ $sales_year->order_date }}</td>
                <td>{{ number_format($sales_year->payment_total) }}</td>
              </tr>
            @endforeach
          </tbody>
          </table>
      </div>
    </div>
  </div>
<script src="../js/analytics/year.js"></script>
<script>
  const label_sales_years = [];
  const data_sales_years = [];
  @foreach ($sales_years as $sales_year)
    label_sales_years.unshift('{{$sales_year->order_date}}');
    data_sales_years.unshift('{{$sales_year->payment_total}}');
  @endforeach

  const year_background_color = [];
  const year_border_color = [];
  for(let i = 0; i < label_sales_years.length; i++) {
    year_background_color.push('rgba(255, 206, 86, 0.2)'); // yellow
    year_border_color.push('rgba(255, 206, 86, 1)'); // yellow
  }
  yearChart(label_sales_years, data_sales_years, year_background_color, year_border_color)
</script>