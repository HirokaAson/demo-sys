<div class="container">
  <canvas id="productChart"></canvas>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Sales - Product</h5>
      <table class="table table-hover">
        <thead class="thead-light">
          <tr>
            <th>#</th>
            <th>Product</th>
            <th>Sales（円）</th>
          </tr>
        </thead>
        <tbody>
          @for ($i = 1; $i < count($sales_products); $i++)
            <tr>
              <td>{{ $i }}</td>
              <td>{{ $sales_products[$i - 1]->product_name }}</td>
              <td>{{ number_format($sales_products[$i - 1]->payment_total) }}</td>
            </tr>
          @endfor
        </tbody>
        </table>
    </div>
  </div>
</div>
<script src="../js/analytics/product.js"></script>
<script>
  const label_sales_product = [];
  const data_sales_product = [];
  @foreach ($sales_products as $sales_product)
    label_sales_product.push('{{$sales_product->product_name}}');
    data_sales_product.push('{{$sales_product->payment_total}}');
  @endforeach

  const product_background_color = [];
  const product_border_color = [];
  for(let i = 0; i < label_sales_product.length; i++) {
    product_background_color.push('rgba(54, 162, 235, 0.2)'); // blue
    product_border_color.push('rgba(54, 162, 235, 1)',); // blue
  }
  productChart(label_sales_product, data_sales_product, product_background_color)
</script>