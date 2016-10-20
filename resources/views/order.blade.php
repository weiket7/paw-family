<?php use App\Models\Enums\SaleStat; ?>
<?php use App\Models\Enums\PaymentType; ?>
<?php use App\Models\Enums\DeliveryChoice; ?>

@extends('template')

@section('content')
  <div class="page_content_offset">
    <div class="container">
      <div class="row clearfix">
        <div class="col-md-12">

          <div class="row">
            <div class="col-md-6">
              <h2 class="tt_uppercase color_dark m_bottom_15">Order Information</h2>
              <table class="table_type_6 responsive_table full_width r_corners shadow m_bottom_45 t_align_l">
                <tbody>
                <tr>
                  <td class="d_xs_none">Order Number</td>
                  <td data-title="Order Number">{{$sale->sale_no}}</td>
                </tr>
                <tr>
                  <td class="d_xs_none">Date</td>
                  <td data-title="Date">{{CommonHelper::formatDateTime($sale->sale_on)}}</td>
                </tr>
                <tr>
                  <td class="d_xs_none">Status</td>
                  <td data-title="Status">{{SaleStat::$values[$sale->stat]}}</td>
                </tr>
                @if($sale->stat == SaleStat::Paid || $sale->stat == SaleStat::Delivered)
                  <tr>
                    <td class="d_xs_none">Paid On</td>
                    <td data-title="Paid On">{{CommonHelper::formatDateTime($sale->paid_on)}}</td>
                  </tr>
                @endif
                <tr>
                  <td class="d_xs_none">Payment Type</td>
                  <td data-title="Payment Type">{{PaymentType::$values[$sale->payment_type]}}</td>
                </tr>
                @if($sale->payment_type == PaymentType::Bank)
                  <tr>
                    <td class="d_xs_none">Bank Ref</td>
                    <td data-title="Bank Ref">{{$sale->bank_ref}}</td>
                  </tr>
                @endif
                <tr>
                  <td class="d_xs_none">Earned Points</td>
                  <td data-title="Earned Points">{{$sale->earned_points}}</td>
                </tr>
                @if($sale->redeemed_points > 0)
                  <tr>
                    <td class="d_xs_none">Redeemed Points</td>
                    <td data-title="Redeemed Points">{{$sale->redeemed_points}}</td>
                  </tr>
                  <tr>
                    <td class="d_xs_none">Redeemed Amount</td>
                    <td data-title="Redeemed Amount">${{CommonHelper::formatNumber($sale->redeemed_amt)}}</td>
                  </tr>
                @endif
                @if($sale->delivery_fee > 0)
                  <tr>
                    <td class="d_xs_none">Delivery Fee</td>
                    <td data-title="Delivery Fee">${{CommonHelper::formatNumber($sale->delivery_fee)}}</td>
                  </tr>
                @endif
                @if($sale->erp_surcharge > 0)
                  <tr>
                    <td class="d_xs_none">ERP Surcharge</td>
                    <td data-title="ERP Surcharge">${{CommonHelper::formatNumber($sale->erp_surcharge)}}</td>
                  </tr>
                @endif
                @if($sale->bulk_discount > 0)
                  <tr>
                    <td class="d_xs_none">Bulk Discount</td>
                    <td data-title="Bulk Discount">${{CommonHelper::formatNumber($sale->bulk_discount)}}</td>
                  </tr>
                @endif
                <tr>
                  <td class="d_xs_none"> Total</td>
                  <td data-title="Total">
                    <p class="fw_medium scheme_color">${{CommonHelper::formatNumber($sale->nett_total)}}</p>
                  </td>
                </tr>
                </tbody>
              </table>
            </div>
            <div class="col-md-6">
              <h2 class="tt_uppercase color_dark m_bottom_15">Delivery</h2>
              <table class="table_type_6 responsive_table full_width r_corners shadow m_bottom_45 t_align_l">
                <tbody>
                <tr>
                  <td class="d_xs_none">Contact Person</td>
                  <td data-title="Contact Person">{{$sale->contact_person}}</td>
                </tr>
                <tr>
                  <td class="d_xs_none">Contact Number</td>
                  <td data-title="Contact Number">{{$sale->contact_number}}</td>
                </tr>
                <tr>
                  <td class="d_xs_none">Address</td>
                  <td data-title="Address">{{$sale->address}}</td>
                </tr>
                <tr>
                  <td class="d_xs_none">Postal</td>
                  <td data-title="Postal">{{$sale->postal}}</td>
                </tr>
                @if($sale->building)
                  <tr>
                    <td class="d_xs_none">Building</td>
                    <td data-title="Building">{{$sale->building}}</td>
                  </tr>
                @endif
                @if($sale->lift_lobby)
                  <tr>
                    <td class="d_xs_none">Lift Lobby</td>
                    <td data-title="Lift Lobby">{{$sale->lift_lobby}}</td>
                  </tr>
                @endif
                <tr>
                  <td class="d_xs_none">Expected Delivery</td>
                  <td data-title="Expected Delivery">{{CommonHelper::formatDate($sale->delivery_date)}} at {{$sale->delivery_time}}</td>
                </tr>
                <tr>
                  <td class="d_xs_none">Remark</td>
                  <td data-title="Remark">{{$sale->customer_remark}}</td>
                </tr>
                </tbody>
              </table>
            </div>
          </div>

          <h2 class="tt_uppercase color_dark m_bottom_15">PRODUCTS</h2>
          <table class="table_type_7 responsive_table full_width t_align_l">
            <thead>
            <tr class="f_size_large">
              <td>Name</td>
              <td>Price</td>
              <td>Quantity</td>
              <td>Subtotal</td>
            </tr>
            </thead>
            <tbody>
            <?php $total = 0; ?>
            @foreach($sale->products as $product)
              <tr>
                <td data-title="Name">
                  <img src="{{url('/')}}/assets/images/products/{{$product->image}}" style="max-height:80px">
                  {{$product->name}}
                  @if($product->size_id > 0)
                    <br>Size: {{$product->size_name}}
                  @endif
                  @if($product->option_id > 0)
                    <br>Repack: {{$product->option_name}} - ${{CommonHelper::formatNumber($product->option_price)}}
                  @endif
                </td>
                <td data-title="Price">${{$product->discounted_price}}</td>
                <td data-title="Quantity">{{$product->quantity}}</td>
                <td data-title="Subtotal">${{CommonHelper::formatNumber($product->subtotal)}}</td>
              </tr>
              <?php $total += $product->subtotal; ?>
            @endforeach
            {{--<tr>
              <td colspan="3">
                <p class="fw_medium f_size_large t_align_r t_xs_align_c">Total:</p>
              </td>
              <td colspan="1" class="color_dark"><p class="fw_medium f_size_large scheme_color">${{CommonHelper::formatNumber($total)}}</p></td>
            </tr>--}}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection