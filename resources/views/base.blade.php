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
                <li><a href="#tab-1" class="bg_light_color_1 color_dark tr_delay_hover r_corners d_block">Login</a></li>
                <li><a href="#tab-2" class="bg_light_color_1 color_dark tr_delay_hover r_corners d_block">Register</a></li>
              </ul>
            </nav>
            <section class="tabs_content shadow r_corners">
              <div id="tab-1">
                <form method="post" action="{{url("login")}}">
                  {{csrf_field()}}
                  <ul>
                    <li class="clearfix m_bottom_15">
                      <div class="half_column type_2 f_left">
                        <label for="username" class="m_bottom_5 d_inline_b">Username</label>
                        <input type="text" id="username" name="username" autocomplete="off" class="r_corners full_width m_bottom_5">
                        <a href="#" class="color_dark f_size_medium">Forgot your username?</a>
                      </div>
                      <div class="half_column type_2 f_left">
                        <label for="pass" class="m_bottom_5 d_inline_b">Password</label>
                        <input type="password" id="password" name="password" autocomplete="off" class="r_corners full_width m_bottom_5">
                        <a href="#" class="color_dark f_size_medium">Forgot your password?</a>
                      </div>
                    </li>
                    <li class="m_bottom_15">
                      <input type="checkbox" class="d_none" name="checkbox_4" id="checkbox_4"><label for="checkbox_4">Remember me</label>
                    </li>
                    <li><button type="submit" class="button_type_4 r_corners bg_scheme_color color_light tr_all_hover">Log In</button></li>
                  </ul>
                </form>
              </div>
              <div id="tab-2">
                <form>
                  <ul>
                    <li class="m_bottom_25">
                      <label for="d_name" class="d_inline_b m_bottom_5 required">Displayed Name</label>
                      <input type="text" id="d_name" name="" class="r_corners full_width">
                    </li>
                    <li class="m_bottom_5">
                      <input type="checkbox" class="d_none" name="checkbox_5" id="checkbox_5"><label for="checkbox_5">Create an account</label>
                    </li>
                    <li class="m_bottom_15">
                      <label for="u_name" class="d_inline_b m_bottom_5 required">Username</label>
                      <input type="text" id="u_name" name="" class="r_corners full_width">
                    </li>
                    <li class="m_bottom_15">
                      <label for="u_email" class="d_inline_b m_bottom_5 required">Email</label>
                      <input type="email" id="u_email" name="" class="r_corners full_width">
                    </li>
                    <li class="m_bottom_15">
                      <label for="u_pass" class="d_inline_b m_bottom_5 required">Password</label>
                      <input type="password" id="u_pass" name="" class="r_corners full_width">
                    </li>
                    <li>
                      <label for="u_repeat_pass" class="d_inline_b m_bottom_5 required">Confirm Password</label>
                      <input type="password" id="u_repeat_pass" name="" class="r_corners full_width">
                    </li>
                  </ul>
                </form>
              </div>
            </section>
          </div>
        </section>
      </div>
    </div>
  </div>
@endsection