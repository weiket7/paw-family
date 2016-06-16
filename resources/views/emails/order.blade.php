<img src="http://pawfamily.sg/assets/images/paw-family-logo.png">

<p>
  Dear {{$name}},<br><br>

  Your order #{{$sale_no}} has been received. Please refer to the order details below:<br><br>

  ORDER INFORMATION<br><br>

<table>
  <tr>
    <td>Status</td><td>Pending Payment</td>
  </tr>
  <tr>
    <td>Order Number</td><td>{{$sale->sale_no}}</td>
  </tr>
  <tr>
    <td>Total</td><td>{{$sale->nett_total}}</td>
  </tr>
  <tr>
    <td>Payment</td><td>{{$sale->payment_type}}</td>
  </tr>
  <tr>
    <td>Date</td><td>{{CommonHelper::formatDateTime($sale->sale_on)}}</td>
  </tr>
  <tr>
</table>
<br><br>

PRODUCTS<br><br>

<table>
  <tr>
    <td>Name</td>
    <td>Price</td>
    <td>Quantity</td>
    <td>Subtotal</td>
  </tr>
  @foreach($sale->products as $product)
    <tr>
      <td>
        {{$product->name}}
        @if($product->size_id > 0)
          <br>Size: {{$product->size_name}}
        @endif
        @if($product->option_id > 0)
          <br>Repack: {{$product->option_name}} - ${{CommonHelper::formatNumber($product->option_price)}}
        @endif
      </td>
      <td>${{$product->discounted_price}}</td>
      <td>{{$product->quantity}}</td>
      <td>${{CommonHelper::formatNumber($product->subtotal)}}</td>
    </tr>
  @endforeach
</table>
<br><br>

If you have any questions or encounter any issues, please email us at admin@pawfamily.sg or contact us at +65 9026 4166.
<br><br>

Regards,<br>
Paw Family

</p>