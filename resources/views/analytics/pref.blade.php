<div class="container">
  <canvas id="prefChart"></canvas>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Sales - Pref</h5>
      <table class="table table-hover">
        <thead class="thead-light">
          <tr>
            <th>#</th>
            <th>Prefecture</th>
            <th>Sales（円）</th>
          </tr>
        </thead>
        <tbody>
          @for ($i = 1; $i < count($sales_prefs); $i++)
            <tr>
              <td>{{ $i }}</td>
              <td>{{ $sales_prefs[$i - 1]->pref_name }}</td>
              <td>{{ number_format($sales_prefs[$i - 1]->payment_total) }}</td>
            </tr>
            @endfor
        </tbody>
        </table>
    </div>
  </div>
</div>
<script src="../js/analytics/pref.js"></script>
<script>
  const label_sales_prefs = [];
  const data_sales_prefs = [];
  @foreach ($sales_prefs as $sales_pref)
    label_sales_prefs.unshift('{{$sales_pref->pref_name}}');
    data_sales_prefs.unshift('{{$sales_pref->payment_total}}');
  @endforeach

  const pref_background_color = [];
  const pref_border_color = [];
  for(let i = 0; i < label_sales_prefs.length; i++) {
    pref_background_color.push('rgba(54, 162, 235, 0.2)'); // blue
    pref_border_color.push('rgba(54, 162, 235, 1)',); // blue
  }
  prefChart(label_sales_prefs, data_sales_prefs, pref_background_color, pref_border_color)
</script>