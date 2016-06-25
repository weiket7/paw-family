<?php use App\Models\Enums\PaymentType; ?>
<?php use App\Models\Enums\SaleStat; ?>
<?php use App\Models\Enums\SubscribeStat; ?>
<?php use App\Models\Enums\PointType; ?>

@extends('template')

@section('content')
  @if(Session::has('login'))
    <div class="container">
      <div class="alert_box r_corners color_green success" id="div-welcome">
        <i class="fa fa-smile-o"></i><p>Welcome {{$customer->name}}! </p>
      </div>
    </div>
  @endif

  @if(Session::has('msg'))
    <div class="container">
      <div class="alert_box r_corners color_green success">
        <i class="fa fa-check"></i><p>{{ Session::get('msg') }} </p>
      </div>
    </div>
  @endif

  <div class="page_content_offset">
    <div class="container">
      <div class="row clearfix">
        <section class="col-lg-12 col-md-12 col-sm-12 m_xs_bottom_30">
          <div class="tabs m_bottom_45">
            <!--tabs navigation-->
            <nav>
              <ul class="tabs_nav horizontal_list clearfix">
                <li><a href="#tab-account" class="bg_light_color_1 color_dark tr_delay_hover r_corners d_block">Account</a></li>
                <li><a href="#tab-orders" class="bg_light_color_1 color_dark tr_delay_hover r_corners d_block">Orders</a></li>
                <li><a href="#tab-points" class="bg_light_color_1 color_dark tr_delay_hover r_corners d_block">Points</a></li>
                <li><a href="#tab-pets" class="bg_light_color_1 color_dark tr_delay_hover r_corners d_block">Pets</a></li>
                <li><a href="#tab-password" class="bg_light_color_1 color_dark tr_delay_hover r_corners d_block">Change Password</a></li>
              </ul>
            </nav>
            <section class="tabs_content shadow r_corners">
              <div id="tab-account">
                <form method="post" action="">
                  {!! csrf_field() !!}
                  <input type="hidden" name="action" value="account">

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
                          <label for="email" class="d_inline_b m_bottom_5 required" tabindex="1">Full Name</label>
                          {{Form::text("name", $customer->name, ['id'=>'name', 'class'=>'r_corners full_width m_bottom_5', 'tabindex'=>1])}}
                        </li>
                        <li class="m_bottom_15">
                          <label for="email" class="d_inline_b m_bottom_5 required" tabindex="1">Email</label>
                          {{Form::text("email", $customer->email, ['id'=>'email', 'class'=>'r_corners full_width m_bottom_5', 'tabindex'=>2])}}
                        </li>
                        <li class="m_bottom_15">
                          <label for="email" class="d_inline_b m_bottom_5" tabindex="1">Phone</label>
                          {{Form::text("phone", $customer->phone, ['id'=>'phone', 'class'=>'r_corners full_width m_bottom_5', 'tabindex'=>2])}}
                        </li>
                        <li class="m_bottom_15">
                          <label for="email" class="d_inline_b m_bottom_5" tabindex="1">Birthday (DD-MM-YYYY)</label>
                          <?php $birthday = ($customer->birthday == '' || $customer->birthday == null) ? '' : date('d-m-Y', strtotime($customer->birthday)); ?>
                          {{Form::text("birthday", $birthday , ['class'=>'r_corners full_width m_bottom_5', 'tabindex'=>2])}}
                        </li>
                        <li class="m_bottom_30">
                          <label for="email" class="d_inline_b">Promotions</label><br>
                          <?php $checked = $customer->subscribe == 'Y' ? "checked" : ''; ?>
                          <input type="checkbox" class="d_none" name="subscribe" id="subscribe" {{$checked}}><label for="subscribe">Yes, I would like to receive emails about promotions</label>
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
                          <label for="email" class="d_inline_b m_bottom_5 required" tabindex="1">Address</label>
                          {{Form::text("address", $customer->address, ['id'=>'address', 'class'=>'r_corners full_width m_bottom_5', 'tabindex'=>2])}}
                        </li>
                        <li class="m_bottom_15">
                          <label for="email" class="d_inline_b m_bottom_5 required" tabindex="1">Postal</label>
                          {{Form::text("postal", $customer->postal, ['id'=>'postal', 'class'=>'r_corners full_width m_bottom_5', 'tabindex'=>2])}}
                        </li>
                        <li class="m_bottom_15">
                          <label for="address" class="d_inline_b m_bottom_5">Building</label>
                          {{Form::text("building", $customer->building, ['id'=>'building', 'class'=>'r_corners full_width m_bottom_5', 'tabindex'=>6])}}
                        </li>
                        <li class="m_bottom_15">
                          <label for="postal" class="d_inline_b m_bottom_5">Lift Lobby</label>
                          {{Form::text("lift_lobby", $customer->lift_lobby, ['id'=>'lift_lobby', 'class'=>'r_corners full_width m_bottom_5', 'tabindex'=>7])}}
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
                    <th>Status</th>
                    <th>Order Number</th>
                    <th>Total</th>
                    <th>Payment</th>
                    <th>Date</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($customer->sales as $sale)
                    <tr>
                      <td>{{SaleStat::$values[$sale->stat]}}</td>
                      <td><a href="{{url("order/".$sale->sale_no)}}">{{$sale->sale_no}}</a></td>
                      <td>${{$sale->nett_total}}</td>
                      <td>{{PaymentType::$values[$sale->payment_type]}}</td>
                      <td>{{CommonHelper::formatDateTime($sale->sale_on)}}</td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <div id="tab-pets">

              </div>
              <div id="tab-points">
                <div class="row">
                  <div class="col-md-12">
                    <h3 class="color_dark m_bottom_20">Paw Points : {{ $customer->points }}</h3>

                    <p>
                      Paw Points can be used as cash discounts during checkout:
                      <ul>
                        <li>1200 paw points = $10 discount</li>
                        <li>3000 paw points = $25 discount</li>
                        <li>5000 paw points = $50 discount</li>
                      </ul>
                    </p>
                  </div>
                </div>
                <br>

                <table class="table_type_3 responsive_table full_width r_corners bg_light_color_1 m_bottom_30 t_align_l">
                  <thead>
                  <tr>
                    <th>Order No</th>
                    <th>Type</th>
                    <th>Points</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($customer->point_logs as $log)
                    <tr>
                      <td><a href="{{url("order/".$log->sale_no)}}">{{$log->sale_no }}</a></td>
                      <td>{{PointType::$values[$log->type] }}</td>
                      <td>{{$log->sign}}{{$log->point_change}}</td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <div id="tab-password">
                <form method="post" action="">
                  {!! csrf_field() !!}
                  <input type="hidden" name="action" value="change_password">

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
                    <div class="col-lg-12 col-md-12 col-sm-12 m_xs_bottom_30">
                      <ul>
                        <li class="m_bottom_15">
                          <label for="current_password" class="d_inline_b m_bottom_5 required" tabindex="1">Current Password</label>
                          <input type="password" name="current_password" autocomplete="off" class="r_corners full_width" tabindex="30">
                        </li>
                        <li class="m_bottom_15">
                          <label for="password" class="d_inline_b m_bottom_5 required">Password</label>
                          <input type="password" name="password" autocomplete="off" class="r_corners full_width" tabindex="31">
                        </li>
                        <li class="m_bottom_15">
                          <label for="password_confirmation" class="d_inline_b m_bottom_5 required">Confirm Password</label>
                          <input type="password" id="password_confirmation" autocomplete="off" name="password_confirmation" class="r_corners full_width" tabindex="32">
                        </li>
                        <li><button type="submit" class="button_type_4 r_corners bg_scheme_color color_light tr_all_hover" tabindex="3">Save</button></li>
                      </ul>
                    </div>
                  </div>
                </form>
              </div>
            </section>
          </div>
        </section>
      </div>
    </div>
  </div>
@endsection