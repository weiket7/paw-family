<?php use App\Models\Enums\SaleStat; ?>
<?php use App\Models\Enums\PaymentType; ?>

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
                  <td data-title="Order Number">{{CommonHelper::formatDateTime($sale->sale_on)}}</td>
                </tr>
                <tr>
                  <td class="d_xs_none">Status</td>
                  <td data-title="Order Number">{{SaleStat::$values[$sale->stat]}}</td>
                </tr>
                @if($sale->stat == SaleStat::Paid || $sale->stat == SaleStat::Delivered)
                  <tr>
                    <td class="d_xs_none">Paid On</td>
                    <td data-title="Order Number">{{CommonHelper::formatDateTime($sale->paid_on)}}</td>
                  </tr>
                @endif
                <tr>
                  <td class="d_xs_none">Payment Type</td>
                  <td data-title="Order Number">{{PaymentType::$values[$sale->payment_type]}}</td>
                </tr>
                @if($sale->payment_type == PaymentType::Bank)
                  <tr>
                    <td class="d_xs_none">Bank Ref</td>
                    <td data-title="Order Number">{{$sale->bank_ref}}</td>
                  </tr>
                @endif
                <tr>
                  <td class="d_xs_none">Earned Points</td>
                  <td data-title="Total">{{$sale->earned_points}}</td>
                </tr>
                @if($sale->redeemed_points)
                  <tr>
                    <td class="d_xs_none">Redeemed Points</td>
                    <td data-title="Paw Points">{{$sale->redeemed_points}}</td>
                  </tr>
                  <tr>
                    <td class="d_xs_none">Gross Total</td>
                    <td data-title="Total">${{CommonHelper::formatNumber($sale->nett_total + $sale->redeemed_amt)}}</td>
                  </tr>
                  <tr>
                    <td class="d_xs_none">Redeemed Amount</td>
                    <td data-title="Paw Points">${{CommonHelper::formatNumber($sale->redeemed_amt)}}</td>
                  </tr>
                  <tr>
                    <td class="d_xs_none">Nett Total</td>
                    <td data-title="Total">
                      <p class="fw_medium scheme_color">${{CommonHelper::formatNumber($sale->nett_total)}}</p>
                    </td>
                  </tr>
                @else
                  <tr>
                    <td class="d_xs_none">Total</td>
                    <td data-title="Total">
                      <p class="fw_medium scheme_color">${{CommonHelper::formatNumber($sale->nett_total)}}</p>
                    </td>
                  </tr>
                @endif
                </tbody>
              </table>
            </div>
            <div class="col-md-6">
              <h2 class="tt_uppercase color_dark m_bottom_15">Delivery</h2>
              <table class="table_type_6 responsive_table full_width r_corners shadow m_bottom_45 t_align_l">
                <tbody>
                <tr>
                  <td class="d_xs_none">Address</td>
                  <td data-title="Order Number">{{$sale->address}}</td>
                </tr>
                <tr>
                  <td class="d_xs_none">Postal</td>
                  <td data-title="Order Number">{{$sale->postal}}</td>
                </tr>
                @if($sale->building)
                  <tr>
                    <td class="d_xs_none">Building</td>
                    <td data-title="Order Number">{{$sale->building}}</td>
                  </tr>
                @endif
                @if($sale->lift_lobby)
                  <tr>
                    <td class="d_xs_none">Lift Lobby</td>
                    <td data-title="Order Number">{{$sale->lift_lobby}}</td>
                  </tr>
                @endif
                </tbody>
              </table>
            </div>
          </div>

          <h2 class="tt_uppercase color_dark m_bottom_15">PRODUCTS</h2>
          <table class="table_type_2 responsive_table full_width r_corners shadow m_bottom_45 t_align_l">
            <tr>
              <td class="f_size_large" width="50%">Name</td>
              <td class="f_size_large" width="15%">Price</td>
              <td class="f_size_large" width="15%">Quantity</td>
              <td class="f_size_large">Subtotal</td>
            </tr>
            <?php $total = 0; ?>
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
              <?php $total += $product->subtotal; ?>
            @endforeach
            @if($sale->redeemed_points)
              <tr>
                <td colspan="3" class="t_align_r"></td>
                <td>-${{CommonHelper::formatNumber($sale->redeemed_amt)}}</td>
              </tr>
            @endif
            <tr>
              <td colspan="3" class="t_align_r">Total</td>
              <td>${{CommonHelper::formatNumber($total)}}</td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection