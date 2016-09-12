<?php use App\Models\Enums\SaleStat; ?>
<?php use App\Models\Enums\PaymentType; ?>
<?php use App\Models\Enums\DeliveryChoice; ?>

@extends("admin.template", [
  "title"=>"Orders",
  "action"=>"index",
  "controller"=>"product"
])


@section("content")
  <?php $count = 1; ?>
  @foreach($sales as $sale)
    <div class="portlet box blue-hoki">
      <div class="portlet-title">
        <div class="caption">
          Order No: {{$sale->sale_no}}
        </div>
      </div>
      <div class="portlet-body">
        <div class="row static-info">
          <div class="col-xs-3 name"> Date: </div>
          <div class="col-xs-9 value"> {{CommonHelper::formatDateTime($sale->sale_on)}} </div>
        </div>
        <div class="row static-info">
          <div class="col-xs-3 name"> Payment Type: </div>
          <div class="col-xs-9 value"> {{PaymentType::$values[$sale->payment_type]}} </div>
        </div>
        <div class="row static-info">
          <div class="col-xs-3 name"> Nett Total: </div>
          <div class="col-xs-9 value"> ${{CommonHelper::formatNumber($sale->nett_total)}} </div>
        </div>
        <div class="row static-info">
          <div class="col-xs-3 name"> Name: </div>
          <div class="col-xs-9 value"> {{$customers[$sale->customer_id]->name}} </div>
        </div>
        <div class="row static-info">
          <div class="col-xs-3 name"> Mobile: </div>
          <div class="col-xs-9 value"> {{$customers[$sale->customer_id]->mobile }} </div>
        </div>
        <div class="row static-info">
          <div class="col-xs-3 name"> Address: </div>
          <div class="col-xs-9 value"> {{$sale->address}} </div>
        </div>
        <div class="row static-info">
          <div class="col-xs-3 name"> Postal: </div>
          <div class="col-xs-9 value"> {{$sale->postal}} </div>
        </div>
        @if($sale->building)
          <div class="row static-info">
            <div class="col-xs-3 name"> Building: </div>
            <div class="col-xs-9 value"> {{$sale->building}} </div>
          </div>
        @endif
        @if($sale->lift_lobby)
          <div class="row static-info">
            <div class="col-xs-3 name"> Lift Lobby: </div>
            <div class="col-xs-9 value"> {{$sale->lift_lobby}} </div>
          </div>
        @endif
        <div class="row static-info">
          <div class="col-xs-3 name"> Time: </div>
          <div class="col-xs-9 value">
            {{$sale->delivery_time}}
          </div>
        </div>
        <div class="row static-info">
          <div class="col-xs-3 name"> Customer Remark: </div>
          <div class="col-xs-9 value"> {{$sale->customer_remark}} </div>
        </div>

          <div class="table-scrollable">
          <table class="table table-bordered">
            <tr>
              <td><b>Name</b></td>
              <td width="100px"><b>Quantity</b></td>
              <td width="140px"><b>Discounted Price</b></td>
              <td><b>Subtotal</b></td>
            </tr>
            @foreach($sale->products as $product)
              <tr>
                <td>
                  {{$product->name}}<br>
                  @if($product->bulk_discount_applicable)
                    Bulk Discount Applicable
                  @else
                    Bulk Discount Not Applicable
                  @endif
                  @if($product->size_name)
                    <br>{{$product->size_name}}
                  @endif
                  @if($product->option_name)
                    <br>{{$product->option_name}} - ${{CommonHelper::formatNumber($product->option_price)}}
                  @endif
                </td>
                </td>
                <td>{{$product->quantity}}</td>
                <td>${{CommonHelper::formatNumber($product->discounted_price)}}</td>
                <td>${{CommonHelper::formatNumber($product->subtotal)}}</td>
              </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>

    @if($count != count($sales))
      <div class="page-break"></div>
    @endif

    <?php $count++; ?>

  @endforeach
@endsection