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

            <ul>
              @if ($errors->has())
                <li class="m_bottom_15">
                  <div class="alert_box r_corners error m_bottom_10">
                    <i class="fa fa-exclamation"></i>
                    <p>
                      @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                      @endforeach
                    </p>
                  </div>
                </li>
              @endif

              <li class="m_bottom_15">
                <label for="name" class="d_inline_b m_bottom_5 required">Name</label>
                {{Form::text("name", old("name"), ['class'=>'r_corners full_width', 'tabindex'=>4])}}
              </li>
              <li class="m_bottom_15">
                <label for="email" class="d_inline_b m_bottom_5 required">Email</label>
                {{Form::text("email", old("email"), ['class'=>'r_corners full_width', 'tabindex'=>5])}}
              </li>
              <li class="m_bottom_15">
                <label for="password" class="d_inline_b m_bottom_5 required">Password</label>
                <input type="password" name="password" autocomplete="off" class="r_corners full_width" tabindex="6">
              </li>
              <li class="m_bottom_25">
                <label for="password_confirmation" class="d_inline_b m_bottom_5 required">Confirm Password</label>
                <input type="password" id="password_confirmation" autocomplete="off" name="password_confirmation" class="r_corners full_width" tabindex="7">
              </li>
              <li class="m_bottom_15">
                <?php $checked_subscribe_email = old("subscribe_email") ? "checked" : ""; ?>
                <input type="checkbox" class="d_none" name="subscribe_email" id="subscribe_email" name="subscribe_email" tabindex="7" value="{{SubscribeEmailStat::Yes}}" {{$checked_subscribe_email}}>
                <label for="subscribe_email">I wish to receive promotions and news via email</label>
              </li>
              <li><button type="submit" class="button_type_4 r_corners bg_scheme_color color_light tr_all_hover" tabindex="8">Register</button></li>
            </ul>
          </form>
        </section>
      </div>
    </div>
  </div>
@endsection