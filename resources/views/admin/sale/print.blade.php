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
    <div class="row">
      <div class="col-xs-6">
        <div class="portlet blue-dark box">
          <div class="portlet-title">
            <div class="caption">
              <i class="fa fa-navicon"></i>Order #{{$sale->sale_no}} on {{CommonHelper::formatDateTime($sale->sale_on)}}
            </div>
          </div>
          <div class="portlet-body">
            <div class="row static-info">
              <div class="col-xs-3 name"> Name: </div>
              <div class="col-xs-9 value"> {{$customers[$sale->customer_id]->name}} </div>
            </div>
            <div class="row static-info">
              <div class="col-xs-3 name"> Mobile: </div>
              <div class="col-xs-9 value"> {{$customers[$sale->customer_id]->mobile }} </div>
            </div>
            <div class="row static-info">
              <div class="col-xs-3 name"> Email: </div>
              <div class="col-xs-9 value"> {{$customers[$sale->customer_id]->email }} </div>
            </div>
            <div class="row static-info">
              <div class="col-xs-3 name"> Earned Points: </div>
              <div class="col-xs-9 value"> {{$sale->earned_points}} </div>
            </div>
            @if($sale->redeemed_points)
              <div class="row static-info">
                <div class="col-xs-3 name"> Redeemed Points: </div>
                <div class="col-xs-9 value"> {{$sale->redeemed_points}} </div>
              </div>
            @endif
          </div>
        </div>
      </div>
      <div class="col-xs-6">
        <div class="portlet green-meadow box">
          <div class="portlet-title">
            <div class="caption">
              <i class="fa fa-navicon"></i>Payment
            </div>
          </div>
          <div class="portlet-body">
            <div class="row static-info">
              <div class="col-xs-3 name"> Status: </div>
              <div class="col-xs-9 value">
                {{SaleStat::$values[$sale->stat]}}
              </div>
            </div>
            @if($sale->stat == SaleStat::Paid || $sale->stat == SaleStat::Delivered)
              <div class="row static-info">
                <div class="col-xs-3 name"> Paid On: </div>
                <div class="col-xs-9 value"> {{CommonHelper::formatDateTime($sale->paid_on)}} </div>
              </div>
            @endif
            <div class="row static-info">
              <div class="col-xs-3 name"> Payment Type: </div>
              <div class="col-xs-9 value"> {{PaymentType::$values[$sale->payment_type]}} </div>
            </div>
            @if($sale->payment_type == PaymentType::Bank)
              <div class="row static-info">
                <div class="col-xs-3 name"> Bank Ref: </div>
                <div class="col-xs-9 value"> {{$sale->bank_ref}} </div>
              </div>
            @endif
            @if($sale->redeemed_points > 0)
              <div class="row static-info">
                <div class="col-xs-3 name"> Redeemed Amount: </div>
                <div class="col-xs-3 value"> ${{CommonHelper::formatNumber($sale->redeemed_amt)}} </div>
              </div>
            @endif
            @if($sale->delivery_fee > 0)
              <div class="row static-info">
                <div class="col-xs-3 name"> Delivery Fee: </div>
                <div class="col-xs-3 value"> ${{CommonHelper::formatNumber($sale->delivery_fee)}} </div>
              </div>
            @endif
            @if($sale->erp_surcharge > 0)
              <div class="row static-info">
                <div class="col-xs-3 name"> ERP surcharge: </div>
                <div class="col-xs-3 value"> ${{CommonHelper::formatNumber($sale->erp_surcharge)}} </div>
              </div>
            @endif
            @if($sale->bulk_discount > 0)
              <div class="row static-info">
                <div class="col-xs-3 name"> Bulk Discount: </div>
                <div class="col-xs-3 value"> ${{CommonHelper::formatNumber($sale->bulk_discount)}} </div>
              </div>
            @endif
            <div class="row static-info">
              <div class="col-xs-3 name"> Nett Total: </div>
              <div class="col-xs-9 value"> ${{CommonHelper::formatNumber($sale->nett_total)}} </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12">
        <div class="portlet green-meadow box">
          <div class="portlet-title">
            <div class="caption">
              <i class="fa fa-navicon"></i>Delivery
            </div>
          </div>
          <div class="portlet-body">
            <div class="row static-info">
              <div class="col-xs-2 name"> Choice: </div>
              <div class="col-xs-10 value"> {{DeliveryChoice::$values[$sale->delivery_choice]}} </div>
            </div>
            <div class="row static-info">
              <div class="col-xs-2 name"> Address: </div>
              <div class="col-xs-10 value"> {{$sale->address}} </div>
            </div>
            @if($sale->postal)
              <div class="row static-info">
                <div class="col-xs-2 name"> Postal: </div>
                <div class="col-xs-10 value"> {{$sale->postal}} </div>
              </div>
            @endif
            @if($sale->building)
              <div class="row static-info">
                <div class="col-xs-2 name"> Building: </div>
                <div class="col-xs-10 value"> {{$sale->building}} </div>
              </div>
            @endif
            @if($sale->lift_lobby)
              <div class="row static-info">
                <div class="col-xs-2 name"> Lift Lobby: </div>
                <div class="col-xs-10 value"> {{$sale->lift_lobby}} </div>
              </div>
            @endif
            <br>

            <div class="row static-info">
              <div class="col-xs-2 name"> Expected Delivery: </div>
              <div class="col-xs-10 value">
                {{CommonHelper::formatDate($sale->delivery_date)}} at {{$sale->delivery_time}}
              </div>
            </div>
            @if($sale->stat == SaleStat::Delivered)
              <div class="row static-info">
                <div class="col-xs-2 name"> Delivered On: </div>
                <div class="col-xs-10 value"> {{CommonHelper::formatDateTime($sale->delivered_on)}} </div>
              </div>
            @endif
            <div class="row static-info">
              <div class="col-xs-2 name"> Customer Remark: </div>
              <div class="col-xs-10 value"> {{$sale->customer_remark}} </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="portlet box blue-hoki">
      <div class="portlet-title">
        <div class="caption">
          Products
        </div>
      </div>
      <div class="portlet-body">
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
                  <img src="{{url('/')}}/assets/images/products/{{$product->image}}" style="max-height:80px">
                  {{$product->name}}<br>
                  @if($product->bulk_discount_applicable)
                    Bulk Discount Applicable
                  @else
                    Bulk Discount Not Applicable
                  @endif
                  @if($product->size_name)
                    <br>Size: {{$product->size_name}}
                  @endif
                  @if($product->option_name)
                    <br>Option: {{$product->option_name}} - ${{CommonHelper::formatNumber($product->option_price)}}
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