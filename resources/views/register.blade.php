<?php use App\Models\Enums\SubscribeEmailStat; ?>

@extends('template')

@section('content')
  <div class="page_content_offset">
    <div class="container">
      <div class="row clearfix">
        <section class="col-lg-12 col-md-12 col-sm-12 m_xs_bottom_30">
          <h2 class="tt_uppercase color_dark m_bottom_20">Register</h2>

          <form method="post" action="{{url("register")}}">
            {{csrf_field()}}

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
                      {{Form::text("name", '', ['id'=>'name', 'class'=>'r_corners full_width m_bottom_5', 'tabindex'=>1])}}
                    </li>
                    <li class="m_bottom_15">
                      <label for="email" class="d_inline_b m_bottom_5 required" tabindex="1">Email</label>
                      {{Form::text("email", '', ['id'=>'email', 'class'=>'r_corners full_width m_bottom_5', 'tabindex'=>2])}}
                    </li>
                    <li class="m_bottom_15">
                      <label for="password" class="d_inline_b m_bottom_5 required">Password</label>
                      <input type="password" name="password" autocomplete="off" class="r_corners full_width" tabindex="6">
                    </li>
                    <li class="m_bottom_25">
                      <label for="password_confirmation" class="d_inline_b m_bottom_5 required">Confirm Password</label>
                      <input type="password" id="password_confirmation" autocomplete="off" name="password_confirmation" class="r_corners full_width" tabindex="7">
                    </li>
                    <li><button type="submit" class="button_type_4 r_corners bg_scheme_color color_light tr_all_hover" tabindex="3">Save</button></li>
                  </ul>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 m_xs_bottom_30">
                  <ul>
                    <li class="m_bottom_15">
                      <label for="email" class="d_inline_b m_bottom_5 required" tabindex="1">Mobile</label>
                      {{Form::text("mobile", '', ['id'=>'mobile', 'class'=>'r_corners full_width m_bottom_5', 'tabindex'=>2])}}
                    </li>
                    <li class="m_bottom_15">
                      <label for="email" class="d_inline_b m_bottom_5 required" tabindex="1">Address</label>
                      {{Form::text("address", '', ['id'=>'address', 'class'=>'r_corners full_width m_bottom_5', 'tabindex'=>2])}}
                    </li>
                    <li class="m_bottom_15">
                      <label for="email" class="d_inline_b m_bottom_5 required" tabindex="1">Postal</label>
                      {{Form::text("postal", '', ['id'=>'postal', 'class'=>'r_corners full_width m_bottom_5', 'tabindex'=>2])}}
                    </li>
                  </ul>
                </div>
              </div>
          </form>
        </section>
      </div>
    </div>
  </div>
@endsection