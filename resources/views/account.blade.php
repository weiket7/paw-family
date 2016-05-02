<?php use App\Models\Enums\PaymentType; ?>
<?php use App\Models\Enums\SaleStat; ?>
<?php use App\Models\Enums\SubscribeEmailStat; ?>

@extends('template')

@section('content')
  <div class="page_content_offset">
    <div class="container">
      <div class="row clearfix">
        <section class="col-lg-12 col-md-12 col-sm-12 m_xs_bottom_30">
          <div class="tabs m_bottom_45">
            <!--tabs navigation-->
            <nav>
              <ul class="tabs_nav horizontal_list clearfix">
                <li><a href="#tab-1" class="bg_light_color_1 color_dark tr_delay_hover r_corners d_block">Account</a></li>
                <li><a href="#tab-2" class="bg_light_color_1 color_dark tr_delay_hover r_corners d_block">Orders</a></li>
              </ul>
            </nav>
            <section class="tabs_content shadow r_corners">
              <div id="tab-1">
                <form method="post" action="">
                  {{csrf_field()}}
                  <ul>
                    @if(Session::has('msg'))
                      <li class="m_bottom_15">
                        <div class="alert_box r_corners error m_bottom_10">
                          <i class="fa fa-exclamation"></i><p>{{ Session::get('msg') }}</p>
                        </div>
                      </li>
                    @endif

                    <li class="m_bottom_15">
                      <label for="email" class="d_inline_b m_bottom_5 required" tabindex="1">Name</label>
                      {{Form::text("name", $customer->name, ['id'=>'name', 'class'=>'r_corners full_width m_bottom_5', 'tabindex'=>1])}}
                    </li>
                    <li class="m_bottom_15">
                      <label for="email" class="d_inline_b m_bottom_5 required" tabindex="1">Email</label>
                      {{Form::text("email", $customer->email, ['id'=>'email', 'class'=>'r_corners full_width m_bottom_5', 'tabindex'=>2])}}
                    </li>
                    <li class="m_bottom_15">
                      <label for="email" class="d_inline_b m_bottom_5 required" tabindex="1">Mobile</label>
                      {{Form::text("mobile", $customer->mobile, ['id'=>'mobile', 'class'=>'r_corners full_width m_bottom_5', 'tabindex'=>2])}}
                    </li>
                    <li class="m_bottom_15">
                      <label for="email" class="d_inline_b m_bottom_5 required" tabindex="1">Phone</label>
                      {{Form::text("phone", $customer->phone, ['id'=>'phone', 'class'=>'r_corners full_width m_bottom_5', 'tabindex'=>2])}}
                    </li>
                    <li class="m_bottom_15">
                      <label for="email" class="d_inline_b m_bottom_5 required" tabindex="1">Birthday</label>
                      {{Form::text("birthday", $customer->birthday, ['id'=>'birthday', 'class'=>'r_corners full_width m_bottom_5', 'tabindex'=>2])}}
                    </li>
                    <li class="m_bottom_15">
                      <label for="email" class="d_inline_b m_bottom_5 required" tabindex="1">Address</label>
                      {{Form::text("address", $customer->address, ['id'=>'address', 'class'=>'r_corners full_width m_bottom_5', 'tabindex'=>2])}}
                    </li>
                    <li class="m_bottom_15">
                      <label for="email" class="d_inline_b m_bottom_5 required" tabindex="1">Postal</label>
                      {{Form::text("postal", $customer->postal, ['id'=>'postal', 'class'=>'r_corners full_width m_bottom_5', 'tabindex'=>2])}}
                    </li>
                    <li><button type="submit" class="button_type_4 r_corners bg_scheme_color color_light tr_all_hover" tabindex="3">Save</button></li>
                  </ul>
                </form>
              </div>
              <div id="tab-2">
                <table class="table_type_3 responsive_table full_width r_corners wrapper shadow bg_light_color_1 m_bottom_30 t_align_l">
                  <thead>
                  <tr class="f_size_large">
                    <th>Order Number</th>
                    <th>Order Date</th>
                    <th>Total</th>
                    <th>Payment Type</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($sales as $sale)
                    <tr>
                      <td><a href="{{url("order/".$sale->sale_code)}}">{{$sale->sale_code}}</a></td>
                      <td>{{CommonHelper::formatDateTime($sale->sale_on)}}</td>
                      <td>${{$sale->nett_total}}</td>
                      <td>{{PaymentType::$values[$sale->payment_type]}}</td>
                      <td>{{SaleStat::$values[$sale->stat]}}</td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
            </section>
          </div>
        </section>
      </div>
    </div>
  </div>
@endsection