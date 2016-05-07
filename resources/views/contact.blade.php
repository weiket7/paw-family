@extends('template')

@section("script")
  <script type="text/javascript">
    /*$("#form-contact").validate({
      rules: {
        name: { required: true },
        mobile: { required: true },
        email: { required: true },
        content: { required: true }
      },
      messages: {
        name: { required: "Required" },
        mobile: { required: "Required" },
        email: { required: "Required" },
        content: { required: "Required" }
      }
    });*/
  </script>
@endsection

@section('content')
  <div class="page_content_offset">
    <div class="container">
      <div class="row clearfix">
        <!--left content column-->
        <section class="col-lg-12 col-md-12 col-sm-12">
          <div class="row clearfix">
            <div class="col-lg-4 col-md-4 col-sm-4 m_xs_bottom_30">
              <h2 class="tt_uppercase color_dark m_bottom_25">Contact Info</h2>
              <ul class="c_info_list">
                <li class="m_bottom_10">
                  <div class="clearfix m_bottom_15">
                    <i class="fa fa-map-marker f_left color_dark"></i>
                    <p class="contact_e">Upper Paya Lebar</p>
                  </div>
                </li>
                <li class="m_bottom_10">
                  <div class="clearfix m_bottom_10">
                    <i class="fa fa-phone f_left color_dark"></i>
                    <p class="contact_e">9026 4166</p>
                  </div>
                </li>
                <li class="m_bottom_10">
                  <div class="clearfix m_bottom_10">
                    <i class="fa fa-envelope f_left color_dark"></i>
                    <a class="contact_e default_t_color" href="mailto:#">admin@pawfamily.sg</a>
                  </div>
                </li>
                <li>
                  <div class="clearfix">
                    <i class="fa fa-clock-o f_left color_dark"></i>
                    <p class="contact_e">
                      Monday - Friday: 10am to 10am
                    </p>
                  </div>
                </li>
              </ul>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 m_xs_bottom_30">
              <h2 class="tt_uppercase color_dark m_bottom_25">Contact Form</h2>
              <form id="form-contact" method="post" action="">
                {{ csrf_field() }}
                <ul>
                  <li class="clearfix m_bottom_15">
                    <div class="f_left half_column">
                      <label for="name" class="required d_inline_b m_bottom_5">Name</label>
                      <input type="text" id="name" name="name" class="full_width r_corners">
                    </div>
                    <div class="f_left half_column">
                      <label for="mobile" class="required d_inline_b m_bottom_5">Mobile</label>
                      <input type="text" id="mobile" name="mobile" class="full_width r_corners">
                    </div>
                  </li>
                  <li class="m_bottom_15">
                    <label for="email" class="required d_inline_b m_bottom_5">Email</label>
                    <input type="text" id="email" name="email" class="full_width r_corners">
                  </li>
                  <li class="m_bottom_10">
                    <label for="cf_message" class="d_inline_b m_1bottom_5 required">Message</label>
                    <textarea id="cf_message" name="content" class="full_width r_corners"></textarea>
                  </li>
                  <li>
                    <button class="button_type_14 bg_color_blue color_light 1r_corners mw_0 tr_all_hover color_dark">Send</button>
                  </li>
                </ul>
              </form>
              @if(Session::has('msg'))
                <div class="alert_box r_corners color_green success" style="margin-top:20px">
                  <i class="fa fa-smile-o"></i><p>{{Session::get('msg')}}</p>
                </div>
              @endif
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>

@endsection