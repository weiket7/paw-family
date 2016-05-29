<?php use App\Models\Enums\SaleStat; ?>
<?php use App\Models\Enums\PaymentType; ?>

@extends('template')

@section('content')
  <div class="page_content_offset">
    <div class="container">
      <div class="row clearfix">
        <div class="col-md-12">
          <h2 class="tt_uppercase color_dark m_bottom_15">Order Information</h2>
          <table class="table_type_6 responsive_table full_width r_corners shadow m_bottom_45 t_align_l">
            <tbody>
            <tr>
              <td class="f_size_large d_xs_none">Status</td>
              <td data-title="Order Number">{{SaleStat::$values[$sale->stat]}}</td>
            </tr>
            <tr>
              <td class="f_size_large d_xs_none">Order Number</td>
              <td data-title="Order Number">{{$sale->sale_no}}</td>
            </tr>
            <tr>
              <td class="f_size_large d_xs_none">Total</td>
              <td data-title="Total">
                <p class="fw_medium f_size_large scheme_color">${{CommonHelper::formatNumber($sale->nett_total)}}</p>
              </td>
            </tr>
            <tr>
              <td class="f_size_large d_xs_none">Payment</td>
              <td data-title="Order Number">{{PaymentType::$values[$sale->payment_type]}}</td>
            </tr>
            <tr>
              <td class="f_size_large d_xs_none">Date</td>
              <td data-title="Order Number">{{CommonHelper::formatDate($sale->sale_on)}}</td>
            </tr>
            </tbody>
          </table>

          <h2 class="tt_uppercase color_dark m_bottom_15">PRODUCTS</h2>
          <table class="table_type_2 responsive_table full_width r_corners shadow m_bottom_45 t_align_l">
            <tr>
              <td class="f_size_large" width="50%">Name</td>
              <td class="f_size_large" width="15%">Price</td>
              <td class="f_size_large" width="15%">Quantity</td>
              <td class="f_size_large">Subtotal</td>
            </tr>
            @foreach($sale->products as $product)
              <tr>
                <td>{{$product->product_name}}</td>
                <td>${{$product->discounted_price}}</td>
                <td>{{$product->quantity}}</td>
                <td>${{CommonHelper::formatNumber($product->subtotal)}}</td>
              </tr>
            @endforeach
            <tr>
              <td colspan="3" class="t_align_r">Total</td>
              <td>${{CommonHelper::formatNumber($sale->nett_total)}}</td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection