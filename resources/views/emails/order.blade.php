<?php use App\Models\Enums\SaleStat; ?>
<?php use App\Models\Enums\PaymentType; ?>
<?php use App\Models\Enums\DeliveryChoice; ?>

<img src="http://pawfamily.sg/assets/images/paw-family-logo.png">

<style>
  body {
    font-family: Arial;
  }

  .tbl-product {
    border-collapse: collapse;
  }

  .tbl-product td {
    border: 1px solid #CCCCCC;
    padding-right: 30px;
    padding-top: 5px;
    padding-bottom: 5px;
  }
</style>

<p>
  Dear {{$customer->name}},<br><br>

  Thank you, your order #{{$sale->sale_no}} has been received. Please refer to the order details below:<br><br>

  <h3>ORDER INFORMATION</h3>

<table>
  <tr>
    <td style="vertical-align:top">
      <table class="tbl-product">
        <tr>
          <td>Order Number</td>
          <td>{{$sale->sale_no}}</td>
        </tr>
        <tr>
          <td>Date</td>
          <td>{{CommonHelper::formatDateTime($sale->sale_on)}}</td>
        </tr>
        <tr>
          <td>Status</td>
          <td>{{SaleStat::$values[$sale->stat]}}</td>
        </tr>
        @if($sale->stat == SaleStat::Paid || $sale->stat == SaleStat::Delivered)
          <tr>
            <td>Paid On</td>
            <td>{{CommonHelper::formatDateTime($sale->paid_on)}}</td>
          </tr>
        @endif
        <tr>
          <td>Payment Type</td>
          <td>{{PaymentType::$values[$sale->payment_type]}}</td>
        </tr>
        @if($sale->payment_type == PaymentType::Bank)
          <tr>
            <td>Bank Ref</td>
            <td>{{$sale->bank_ref}}</td>
          </tr>
        @endif
        <tr>
          <td>Earned Points</td>
          <td>{{$sale->earned_points}}</td>
        </tr>
        @if($sale->redeemed_points > 0)
          <tr>
            <td>Redeemed Points</td>
            <td>{{$sale->redeemed_points}}</td>
          </tr>
          <tr>
            <td>Redeemed Amount</td>
            <td>${{CommonHelper::formatNumber($sale->redeemed_amt)}}</td>
          </tr>
        @endif
        @if($sale->delivery_fee > 0)
          <tr>
            <td>Delivery Fee</td>
            <td>${{CommonHelper::formatNumber($sale->delivery_fee)}}</td>
          </tr>
        @endif
        @if($sale->erp_surcharge > 0)
          <tr>
            <td>ERP Surcharge</td>
            <td>${{CommonHelper::formatNumber($sale->erp_surcharge)}}</td>
          </tr>
        @endif
        @if($sale->bulk_discount > 0)
          <tr>
            <td>Bulk Discount</td>
            <td>${{CommonHelper::formatNumber($sale->bulk_discount)}}</td>
          </tr>
        @endif
        <tr>
          <td>Total</td>
          <td>${{CommonHelper::formatNumber($sale->nett_total)}}</td>
        </tr>
      </table>
    </td>
    <td style="vertical-align:top; padding-left: 30px">
      <table class="tbl-product ">
        <tr>
          <td> Name </td>
          <td> <a href="{{url("admin/customer/save/".$customer->customer_id)}}">{{$customer->name}}</a> </td>
        </tr>
        <tr>
          <td> Points </td>
          <td> {{$customer->points }} </td>
        </tr>
        <tr>
          <td> Mobile </td>
          <td> {{$customer->mobile }} </td>
        </tr>
        <tr>
          <td> Email </td>
          <td> {{$customer->email }} </td>
        </tr>
        <tr>
          <td> Choice </td>
          <td> {{DeliveryChoice::$values[$sale->delivery_choice]}} </td>
        </tr>
        <tr>
          <td> Address </td>
          <td> {{$sale->address}} </td>
        </tr>
        @if($sale->postal)
          <tr>
            <td> Postal </td>
            <td> {{$sale->postal}} </td>
          </tr>
        @endif
        @if($sale->building)
          <tr>
            <td> Building </td>
            <td> {{$sale->building}} </td>
          </tr>
        @endif
        @if($sale->lift_lobby)
          <tr>
            <td> Lift Lobby </td>
            <td> {{$sale->lift_lobby}} </td>
          </tr>
        @endif
        <tr>
          <td> Time </td>
          <td>
            {{$sale->delivery_time}}
          </td>
        </tr>
        <tr>
          <td> Remark </td>
          <td> {{$sale->customer_remark}} </td>
        </tr>
      </table>
    </td>
  </tr>
</table>

<br><br>

<h3>PRODUCTS</h3>

<table class="tbl-product">
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