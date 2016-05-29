<?php use App\Models\Enums\SaleStat; ?>
<?php use App\Models\Enums\PaymentType; ?>
<?php use App\Models\Enums\DeliveryChoice; ?>

@extends("admin.template", [
  "title"=>"Order",
  "action"=>"view",
  "controller"=>"sale",
  "hide_delete"=>true,
])

@section('script')
  <script>
    $(document).ready(function() {
      $('#btn-paid').on('confirmed.bs.confirmation', function () {
        $("#sale_stat").val("{{SaleStat::Paid}}");
        $("form").submit();
      });

      $('#btn-delivered').on('confirmed.bs.confirmation', function () {
        $("#sale_stat").val("{{SaleStat::Delivered}}");
        $("form").submit();
      });
    });
  </script>
@endsection

@section("content")
  <input type="hidden" name="sale_stat" id="sale_stat">

  <div class="row">
    <div class="col-md-6">
      <div class="portlet blue-dark box">
        <div class="portlet-title">
          <div class="caption">
            <i class="fa fa-navicon"></i>Details </div>
          <div class="actions">
            <a href="javascript:;" class="btn btn-default btn-sm">
              <i class="fa fa-pencil"></i> Edit </a>
          </div>
        </div>
        <div class="portlet-body">
          <div class="row static-info">
            <div class="col-md-5 name"> Order No: </div>
            <div class="col-md-7 value"> {{$sale->sale_no}}

            </div>
          </div>
          <div class="row static-info">
            <div class="col-md-5 name"> Date: </div>
            <div class="col-md-7 value"> {{CommonHelper::formatDateTime($sale->sale_on)}} </div>
          </div>
          <div class="row static-info">
            <div class="col-md-5 name"> Status: </div>
            <div class="col-md-7 value">
              {{SaleStat::$values[$sale->stat]}}
              @if ($sale->stat == SaleStat::Pending)
                &nbsp; <button type="button" class="btn btn-sm blue" id='btn-paid' data-placement="bottom" data-singleton='true' data-toggle='confirmation' data-original-title='Are you sure?'>Paid</button>
              @elseif ($sale->stat == SaleStat::Paid)
                &nbsp; <button type="button" class="btn btn-sm blue" id='btn-delivered' data-placement="bottom" data-singleton='true' data-toggle='confirmation' data-original-title='Are you sure?'>Delivered</button>
              @endif
            </div>
          </div>
          @if($sale->stat == SaleStat::Paid || $sale->stat == SaleStat::Delivered)
            <div class="row static-info">
              <div class="col-md-5 name"> Paid On: </div>
              <div class="col-md-7 value"> {{CommonHelper::formatDateTime($sale->paid_on)}} </div>
            </div>
          @endif
          @if($sale->stat == SaleStat::Delivered)
            <div class="row static-info">
              <div class="col-md-5 name"> Delivered On: </div>
              <div class="col-md-7 value"> {{CommonHelper::formatDateTime($sale->delivered_on)}} </div>
            </div>
          @endif
          <div class="row static-info">
            <div class="col-md-5 name"> Payment Type: </div>
            <div class="col-md-7 value"> {{PaymentType::$values[$sale->payment_type]}} </div>
          </div>
          <div class="row static-info">
            <div class="col-md-5 name"> Gross Total: </div>
            <div class="col-md-7 value"> ${{$sale->gross_total}} </div>
          </div>
          <div class="row static-info">
            <div class="col-md-5 name"> Product Discount: </div>
            <div class="col-md-7 value"> ${{$sale->product_discount}} </div>
          </div>
          <div class="row static-info">
            <div class="col-md-5 name"> Promo Discount: </div>
            <div class="col-md-7 value"> ${{$sale->promo_discount}} </div>
          </div>
          <div class="row static-info">
            <div class="col-md-5 name"> Nett Total: </div>
            <div class="col-md-7 value"> ${{$sale->nett_total}} </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="portlet green-meadow box">
        <div class="portlet-title">
          <div class="caption">
            <i class="fa fa-user"></i>Delivery </div>
          <div class="actions">
            <a href="javascript:;" class="btn btn-default btn-sm">
              <i class="fa fa-pencil"></i> Edit </a>
          </div>
        </div>
        <div class="portlet-body">
          <div class="row static-info">
            <div class="col-md-5 name"> Name: </div>
            <div class="col-md-7 value"> <a href="{{url("admin/customer/save/".$customer->customer_id)}}">{{$customer->name}}</a> </div>
          </div>
          <div class="row static-info">
            <div class="col-md-5 name"> Mobile: </div>
            <div class="col-md-7 value"> {{$customer->mobile }} </div>
          </div>
          <div class="row static-info">
            <div class="col-md-5 name"> Email: </div>
            <div class="col-md-7 value"> {{$customer->email }} </div>
          </div>
          <div class="row static-info">
            <div class="col-md-5 name"> Choice: </div>
            <div class="col-md-7 value"> {{DeliveryChoice::$values[$sale->delivery_choice]}} </div>
          </div>
          <div class="row static-info">
            <div class="col-md-5 name"> Address: </div>
            <div class="col-md-7 value"> {{$sale->delivery_address}} </div>
          </div>
          <div class="row static-info">
            <div class="col-md-5 name"> Time: </div>
            <div class="col-md-7 value">
              {{$sale->delivery_time}}
            </div>
          </div>
          <div class="row static-info">
            <div class="col-md-5 name"> Customer Remark: </div>
            <div class="col-md-7 value"> {{$sale->customer_remark}} </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="portlet grey-cascade box">
        <div class="portlet-title">
          <div class="caption">
            <i class="fa fa-shopping-cart"></i>Products
          </div>
        </div>
        <div class="portlet-body">
          <table class="table table-bordered">
            <thead>
            <th>Name</th>
            <th>Size</th>
            <th>Option</th>
            <th>Quantity</th>
            <th>Discounted Price</th>
            <th>Subtotal</th>
            </thead>
            <tbody>
            @foreach($sale->products as $product)
              <tr>
                <td>
                  <a href="{{url("admin/product/save/".$product->product_id)}}">{{$product->product_name}}</a>
                </td>
                <td>{{$product->size_name}}</td>
                <td>
                  @if($product->option_name)
                    {{$product->option_name}} - ${{CommonHelper::formatNumber($product->option_price)}}
                  @endif
                </td>
                <td>{{$product->quantity}}</td>
                <td>${{CommonHelper::formatNumber($product->discounted_price)}}</td>
                <td>${{CommonHelper::formatNumber($product->subtotal)}}</td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection