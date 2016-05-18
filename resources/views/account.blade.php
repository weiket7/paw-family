<?php use App\Models\Enums\PaymentType; ?>
<?php use App\Models\Enums\SaleStat; ?>
<?php use App\Models\Enums\SubscribeStat; ?>

@extends('template')

@section('content')
  <div class="page_content_offset">
    <div class="container">
      <div class="row clearfix">
        <section class="col-lg-12 col-md-12 col-sm-12 m_xs_bottom_30">

          @if(Session::has('login'))
            <div class="alert_box r_corners color_green success m_bottom_10">
              <i class="fa fa-smile-o"></i><p>Welcome {{$customer->name}}! </p>
            </div>
          @endif

          <div class="tabs m_bottom_45">
            <!--tabs navigation-->
            <nav>
              <ul class="tabs_nav horizontal_list clearfix">
                <li><a href="#tab-account" class="bg_light_color_1 color_dark tr_delay_hover r_corners d_block">Account</a></li>
                <li><a href="#tab-pets" class="bg_light_color_1 color_dark tr_delay_hover r_corners d_block">Pets</a></li>
                <li><a href="#tab-orders" class="bg_light_color_1 color_dark tr_delay_hover r_corners d_block">Orders</a></li>
                <li><a href="#tab-password" class="bg_light_color_1 color_dark tr_delay_hover r_corners d_block">Change Password</a></li>
              </ul>
            </nav>
            <section class="tabs_content shadow r_corners">
              <div id="tab-account">
                <form method="post" action="">
                  {{csrf_field()}}

                  @if(Session::has('msg'))
                    <div class="alert_box r_corners color_green success m_bottom_10">
                      <i class="fa fa-check"></i><p>{{ Session::get('msg') }} </p>
                    </div>
                  @endif

                  @if ($errors->has())
                    <div class="alert_box r_corners error m_bottom_10">
                      <i class="fa fa-exclamation"></i>
                      <p>
                        @foreach ($errors->all() as $error)
                          {{ $error }}<br>
                        @endforeach
                      </p>
                    </div>
                  @endif

                  <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 m_xs_bottom_30">
                      <ul>
                        <li class="m_bottom_15">
                          <label for="email" class="d_inline_b m_bottom_5 required" tabindex="1">Name</label>
                          {{Form::text("name", $customer->name, ['id'=>'name', 'class'=>'r_corners full_width m_bottom_5', 'tabindex'=>1])}}
                        </li>
                        <li class="m_bottom_15">
                          <label for="email" class="d_inline_b m_bottom_5 required" tabindex="1">Email</label>
                          {{Form::text("email", $customer->email, ['id'=>'email', 'class'=>'r_corners full_width m_bottom_5', 'tabindex'=>2])}}
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
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 m_xs_bottom_30">
                      <ul>
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
                      </ul>
                    </div>
                  </div>

                </form>
              </div>
              <div id="tab-orders">
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
              <div id="tab-pets">

              </div>
              <div id="tab-password">
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 m_xs_bottom_30">
                    <ul>
                      <li class="m_bottom_15">
                        <label for="email" class="d_inline_b m_bottom_5 required" tabindex="1">Current Password</label>
                        {{Form::text("password_current", '', ['class'=>'r_corners full_width m_bottom_5', 'tabindex'=>1])}}
                      </li>
                      <li class="m_bottom_15">
                        <label for="email" class="d_inline_b m_bottom_5 required" tabindex="1">New Password</label>
                        {{Form::text("password_new", '', ['class'=>'r_corners full_width m_bottom_5', 'tabindex'=>2])}}
                      </li>
                      <li class="m_bottom_15">
                        <label for="email" class="d_inline_b m_bottom_5 required" tabindex="1">Confirm Password</label>
                        {{Form::text("password_confirmation", '', ['class'=>'r_corners full_width m_bottom_5', 'tabindex'=>2])}}
                      </li>
                      <li><button type="submit" class="button_type_4 r_corners bg_scheme_color color_light tr_all_hover" tabindex="3">Save</button></li>
                    </ul>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </section>
      </div>
    </div>
  </div>
@endsection