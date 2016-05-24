<?php use App\Models\Enums\MainCategory; ?>

<!doctype html>
<!--[if IE 9 ]><html class="ie9" lang="en"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en"><!--<![endif]-->
<head>
  <title>Paw Family - Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <!--meta info-->
  <meta name="author" content="">
  <meta name="keywords" content="">
  <meta name="description" content="">
  <link rel="icon" type="image/ico" href="{{url("assets/flatastic")}}/images/fav.ico">
  <!--stylesheet include-->
  <link rel="stylesheet" type="text/css" media="all" href="{{url("assets")}}/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" media="all" href="{{url("assets")}}/css/typeaheadjs.css">
  <link rel="stylesheet" type="text/css" media="all" href="{{url("assets/flatastic")}}/css/jquery.fancybox-1.3.4.css">
  <link rel="stylesheet" type="text/css" media="all" href="{{url("assets/flatastic")}}/css/flexslider.css">
  <link rel="stylesheet" type="text/css" media="all" href="{{url("assets/flatastic")}}/css/owl.carousel.css">
  <link rel="stylesheet" type="text/css" media="all" href="{{url("assets/flatastic")}}/css/owl.transitions.css">
  <link rel="stylesheet" type="text/css" media="all" href="{{url("assets/flatastic")}}/css/jquery.custom-scrollbar.css">
  <link rel="stylesheet" type="text/css" media="all" href="{{url("assets/flatastic")}}/css/style.css">
  <link rel="stylesheet" type="text/css" media="all" href="{{url("assets/flatastic")}}/css/custom.css">
  <!--font include-->
  <link href="{{url("assets/flatastic")}}/css/font-awesome.min.css" rel="stylesheet">
  <link href="{{url("assets/css/powertip/jquery.powertip-orange.css")}}" rel="stylesheet">
  <script src="{{url("assets/flatastic")}}/js/modernizr.js"></script>
</head>
<body>

<!--boxed layout-->
<div class="wide_layout relative w_xs_auto">
  <!--[if (lt IE 9) | IE 9]>
  <div style="background:#fff;padding:8px 0 10px;">
    <div class="container" style="width:1170px;"><div class="row wrapper"><div class="clearfix" style="padding:9px 0 0;float:left;width:83%;"><i class="fa fa-exclamation-triangle scheme_color f_left m_right_10" style="font-size:25px;color:#e74c3c;"></i><b style="color:#e74c3c;">Attention! This page may not display correctly.</b> <b>You are using an outdated version of Internet Explorer. For a faster, safer browsing experience.</b></div><div class="t_align_r" style="float:left;width:16%;"><a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode" class="button_type_4 r_corners bg_scheme_color color_light d_inline_b t_align_c" target="_blank" style="margin-bottom:2px;">Update Now!</a></div></div></div></div>
  <![endif]-->
  <!--markup header type 2-->
  <header role="banner">
    <section class="h_bot_part container">
      <div class="clearfix row">
        <div class="col-lg-4 col-md-4 col-sm-4 t_xs_align_c">
          <a href="{{url("/")}}" class="logo m_xs_bottom_15 d_xs_inline_b">
            <img src="{{url("assets")}}/images/paw-family-logo.png" alt="">
          </a>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8">
          <div class="row clearfix">
            <div class="col-lg-6 col-md-6 col-sm-6  t_xs_align_c m_xs_bottom_15">
              <div class="row">
                <div class="col-xs-7 t_align_r">
                  Free delivery for orders ${{Cache::get('settings_cache')["freedeliveryaboveorequalto"]}} and above within 1-3 working days!
                </div>
                <div class="col-xs-5 t_align_c">
                  <b class="f_size_ex_large color_dark"><i class="fa fa-phone"></i> 9026 4166</b>
                </div>
              </div>
              {{--<dl class="l_height_medium">
                <dt class="f_size_small">Call us:</dt>
                <dd class="f_size_ex_large color_dark"><b>8233 5100</b></dd>
              </dl>--}}
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
              <form class="relative type_2" role="search" method="get" action="{{url("product/search")}}">
                <input type="text" placeholder="Search" name="term" id="search" autocomplete="off" class="r_corners f_size_medium full_width">
                <button class="f_right search_button tr_all_hover f_xs_none">
                  <i class="fa fa-search"></i>
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--main menu container-->
    <div class="container">
      <section class="menu_wrap type_2 relative clearfix t_xs_align_c"> <!--removed m_bottom_20-->
        <!--button for responsive menu-->
        <button id="menu_button" class="r_corners centered_db d_none tr_all_hover d_xs_block m_bottom_15">
          <span class="centered_db r_corners"></span>
          <span class="centered_db r_corners"></span>
          <span class="centered_db r_corners"></span>
        </button>
        <!--main menu-->
        <nav role="navigation" class="f_left f_xs_none d_xs_none t_xs_align_l">
          <ul class="horizontal_list main_menu clearfix">
            <li class="current relative f_xs_none m_xs_bottom_5">
              <a href="{{url("/")}}" class="tr_delay_hover color_light tt_uppercase"><b>Home</b></a>
            </li>
            <li class="relative f_xs_none m_xs_bottom_5"><a href="#" class="tr_delay_hover color_light tt_uppercase"><b>Dogs</b></a>
              <!--sub menu-->
              <div class="sub_menu_wrap top_arrow d_xs_none type_2 tr_all_hover clearfix r_corners">
                <ul class="sub_menu">
                  @foreach(Cache::get('categories_cache')[MainCategory::Dogs] as $category)
                    <li><a class="color_dark tr_delay_hover" href="{{url("product/category/".MainCategory::Dogs.'/'.$category->slug)}}">{{$category->name}}</a></li>
                  @endforeach
                </ul>
              </div>
            </li>
            <li class="relative f_xs_none m_xs_bottom_5"><a href="#" class="tr_delay_hover color_light tt_uppercase"><b>Cats</b></a>
              <!--sub menu-->
              <div class="sub_menu_wrap top_arrow d_xs_none type_2 tr_all_hover clearfix r_corners">
                <ul class="sub_menu">
                  @if(isset(Cache::get('categories_cache')[MainCategory::Cats]))
                    @foreach(Cache::get('categories_cache')[MainCategory::Cats] as $category)
                      <li><a class="color_dark tr_delay_hover" href="{{url("product/category/".MainCategory::Cats.'/'.$category->slug)}}">{{$category->name}}</a></li>
                    @endforeach
                  @endif
                </ul>
              </div>
            </li>
            <li class="relative f_xs_none m_xs_bottom_5"><a href="#" class="tr_delay_hover color_light tt_uppercase"><b>Small Animals</b></a>
              <!--sub menu-->
              <div class="sub_menu_wrap top_arrow d_xs_none type_2 tr_all_hover clearfix r_corners">
                <ul class="sub_menu">
                  @if(isset(Cache::get('categories_cache')[MainCategory::SmallAnimals]))
                    @foreach(Cache::get('categories_cache')[MainCategory::SmallAnimals] as $category)
                      <li><a class="color_dark tr_delay_hover" href="{{url("product/category/".MainCategory::SmallAnimals.'/'.$category->slug)}}">{{$category->name}}</a></li>
                    @endforeach
                  @endif
                </ul>
              </div>
            </li>
            <li class="relative f_xs_none m_xs_bottom_5">
              <a href="{{url("brands")}}" class="tr_delay_hover color_light tt_uppercase">
                <b>Brands</b>
              </a>
            </li>
            <li class="relative f_xs_none m_xs_bottom_5">
              <a href="{{url("contact")}}" class="tr_delay_hover color_light tt_uppercase">
                <b>Contact</b>
              </a>
            </li>
            @if(auth()->check())
              <li class="relative f_xs_none m_xs_bottom_5">
                <a href="{{url("account")}}" class="tr_delay_hover color_light tt_uppercase">
                  <b>Account</b>
                </a>
              </li>
              <li class="relative f_xs_none m_xs_bottom_5">
                <a href="{{url("logout")}}" class="tr_delay_hover color_light tt_uppercase">
                  <b>Log Out</b>
                </a>
              </li>
            @else
              <li class="relative f_xs_none m_xs_bottom_5">
                <a href="#" data-popup="#login_popup" class="tr_delay_hover color_light tt_uppercase">
                  <b>Log In</b>
                </a>
              </li>
            @endif
          </ul>
        </nav>
        <ul class="f_right horizontal_list clearfix t_align_l t_xs_align_c site_settings d_xs_inline_b f_xs_none">
          <!--shopping cart-->
          <li class="m_left_5 relative container3d" id="shopping_button">
            <a role="button" href="#" class="button_type_3 color_light bg_scheme_color d_block r_corners tr_delay_hover box_s_none">
                  <span class="d_inline_middle shop_icon">
                    <i class="fa fa-shopping-cart"></i>
                    <span class="count tr_delay_hover type_2 circle t_align_c">3</span>
                  </span>
              <b>$355</b>
            </a>
            <div class="shopping_cart top_arrow tr_all_hover r_corners">
              <div class="f_size_medium sc_header">Recently added item(s)</div>
              <ul class="products_list">
                <li>
                  <div class="clearfix">
                    <!--product image-->
                    <img class="f_left m_right_10" src="{{url("assets/flatastic")}}/images/shopping_c_img_1.jpg" alt="">
                    <!--product description-->
                    <div class="f_left product_description">
                      <a href="#" class="color_dark m_bottom_5 d_block">Cursus eleifend elit aenean auctor wisi et urna</a>
                      <span class="f_size_medium">Product Code PS34</span>
                    </div>
                    <!--product price-->
                    <div class="f_left f_size_medium">
                      <div class="clearfix">
                        1 x <b class="color_dark">$99.00</b>
                      </div>
                      <button class="close_product color_dark tr_hover"><i class="fa fa-times"></i></button>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="clearfix">
                    <!--product image-->
                    <img class="f_left m_right_10" src="{{url("assets/flatastic")}}/images/shopping_c_img_2.jpg" alt="">
                    <!--product description-->
                    <div class="f_left product_description">
                      <a href="#" class="color_dark m_bottom_5 d_block">Cursus eleifend elit aenean auctor wisi et urna</a>
                      <span class="f_size_medium">Product Code PS34</span>
                    </div>
                    <!--product price-->
                    <div class="f_left f_size_medium">
                      <div class="clearfix">
                        1 x <b class="color_dark">$99.00</b>
                      </div>
                      <button class="close_product color_dark tr_hover"><i class="fa fa-times"></i></button>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="clearfix">
                    <!--product image-->
                    <img class="f_left m_right_10" src="{{url("assets/flatastic")}}/images/shopping_c_img_3.jpg" alt="">
                    <!--product description-->
                    <div class="f_left product_description">
                      <a href="#" class="color_dark m_bottom_5 d_block">Cursus eleifend elit aenean auctor wisi et urna</a>
                      <span class="f_size_medium">Product Code PS34</span>
                    </div>
                    <!--product price-->
                    <div class="f_left f_size_medium">
                      <div class="clearfix">
                        1 x <b class="color_dark">$99.00</b>
                      </div>
                      <button class="close_product color_dark tr_hover"><i class="fa fa-times"></i></button>
                    </div>
                  </div>
                </li>
              </ul>
              <!--total price-->
              <ul class="total_price bg_light_color_1 t_align_r color_dark">
                <li class="m_bottom_10">Tax: <span class="f_size_large sc_price t_align_l d_inline_b m_left_15">$0.00</span></li>
                <li class="m_bottom_10">Discount: <span class="f_size_large sc_price t_align_l d_inline_b m_left_15">$37.00</span></li>
                <li>Total: <b class="f_size_large bold scheme_color sc_price t_align_l d_inline_b m_left_15">$999.00</b></li>
              </ul>
              <div class="sc_footer t_align_c">
                <a href="#" role="button" class="button_type_4 d_inline_middle bg_light_color_2 r_corners color_dark t_align_c tr_all_hover m_mxs_bottom_5">View Cart</a>
                <a href="{{url("checkout")}}" role="button" class="button_type_4 bg_scheme_color d_inline_middle r_corners tr_all_hover color_light">Checkout</a>
              </div>
            </div>
          </li>
        </ul>
      </section>
    </div>
  </header>

  @if(isset($breadcrumbs))
    <div class="container">
      <ul class="horizontal_list clearfix bc_list f_size_medium"  style="background-color:#f2f4f5; padding: 9px;">
        <li class="m_right_10 current">
          Home<i class="fa fa-angle-right d_inline_middle m_left_10"></i>
        </li>
        @foreach($breadcrumbs as $b)
          <li class="m_right_10">
            @if($b != array_last($breadcrumbs))
              {{ ucwords($b) }}
              <i class="fa fa-angle-right d_inline_middle m_left_10"></i>
            @else
              <a href="#"><b>{{ucwords($b)}}</b></a>
          @endif
        @endforeach
      </ul>
    </div>
  @endif

  @if(Session::has('msg-info'))
    <div class="container">
      <div class="alert_box r_corners info m_bottom_10">
        <i class="fa fa-info-circle"></i><p>{{ Session::get('msg-info') }}</p>
      </div>
    </div>
    @endif

  @if(Session::has('msg'))
    <div class="container">
      <div class="alert_box r_corners color_green success m_bottom_10">
        <i class="fa fa-check"></i><p>{{ Session::get('msg') }} </p>
      </div>
    </div>
  @endif

  @yield('content')

  <!--markup footer-->
  <footer id="footer" class="type_2">
    <div class="footer_top_part">
      <div class="container">
        <div class="row clearfix">
          <div class="col-lg-4 col-md-4 col-sm-4 m_xs_bottom_30">
            <h3 class="color_light_2 m_bottom_20">About</h3>
            <p class="m_bottom_15">Paw Family is a one-stop online pet store which offers pet owners incredible savings on top quality pet supplies.<br><br>

              Our mission is to provide fantastic deals to cater the needs for your precious pets. As pet lovers ourselves, we value the quality and reliability of every product.</p>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 m_xs_bottom_30">
            <h3 class="color_light_2 m_bottom_20">Information</h3>
            <ul class="vertical_list">
              <li><a class="color_light tr_delay_hover" href="#">About Pawfamily<i class="fa fa-angle-right"></i></a></li>
              <li><a class="color_light tr_delay_hover" href="{{url('contact')}}">Contact<i class="fa fa-angle-right"></i></a></li>
              <li><a class="color_light tr_delay_hover" href="#">Delivery<i class="fa fa-angle-right"></i></a></li>
              <li><a class="color_light tr_delay_hover" href="#">Loyalty and Rewards<i class="fa fa-angle-right"></i></a></li>
              <li><a class="color_light tr_delay_hover" href="{{url('terms-and-conditions')}}">Terms &amp; Conditions<i class="fa fa-angle-right"></i></a></li>
            </ul>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4">
            <h3 class="color_light_2 m_bottom_20">Contact Us</h3>
            <ul class="c_info_list">
              <li class="m_bottom_10">
                <div class="clearfix m_bottom_15">
                  <i class="fa fa-map-marker f_left"></i>
                  <p class="contact_e">Upper Paya Lebar</p>
                </div>
              </li>
              <li class="m_bottom_10">
                <div class="clearfix m_bottom_10">
                  <i class="fa fa-phone f_left"></i>
                  <p class="contact_e">9026 4166</p>
                </div>
              </li>
              <li class="m_bottom_10">
                <div class="clearfix m_bottom_10">
                  <i class="fa fa-envelope f_left"></i>
                  <a class="contact_e color_light" href="mailto:admin@pawfamily.sg">admin@pawfamily.sg</a>
                </div>
              </li>
              <li>
                <div class="clearfix">
                  <i class="fa fa-clock-o f_left"></i>
                  <p class="contact_e">Monday - Friday: 10am - 10am</p>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!--copyright part-->
    <div class="footer_bottom_part">
      <div class="container clearfix t_mxs_align_c">
        <p class="f_left f_mxs_none m_mxs_bottom_10">&copy; 2014 <span class="color_light">Pawfamily</span>. All Rights Reserved.</p>
        <ul class="f_right horizontal_list clearfix f_mxs_none d_mxs_inline_b">
          <li><img src="{{url("assets/flatastic")}}/images/payment_img_1.png" alt=""></li>
        </ul>
      </div>
    </div>
  </footer>
</div>

<!--login popup-->
<div class="popup_wrap d_none" id="login_popup">
  <section class="popup r_corners shadow">
    <button class="bg_tr color_dark tr_all_hover text_cs_hover close f_size_large"><i class="fa fa-times"></i></button>
    <h3 class="m_bottom_20 color_dark">Log In</h3>
    <form id="form-login">
      {{csrf_field()}}
      <ul>
        <li id="div-login-result" class="m_bottom_15" style="display:none">
          <div class="alert_box r_corners error m_bottom_10">
            <i class="fa fa-exclamation"></i><p>Wrong username and/or password</p>
          </div>
        </li>
        <li class="m_bottom_15">
          <label for="email_login" class="m_bottom_5 d_inline_b">Email</label><br>
          <input type="text" name="email_login" id="email_login" class="r_corners full_width">
        </li>
        <li class="m_bottom_25">
          <label for="password_login" class="m_bottom_5 d_inline_b">Password</label><br>
          <input type="password" name="password_login" id="password_login" class="r_corners full_width">
        </li>
        <li class="clearfix m_bottom_30">
          <button type="button" id="btn-login" class="button_type_4 tr_all_hover r_corners f_left bg_scheme_color color_light f_mxs_none m_mxs_bottom_15">Log In</button>
          <div class="f_right f_size_medium f_mxs_none">
            <a href="{{url("forgot-password")}}" class="color_dark">Forgot your password?</a><br>
          </div>
        </li>
      </ul>
      <footer class="bg_light_color_1 t_mxs_align_c">
        <h3 class="color_dark d_inline_middle d_mxs_block m_mxs_bottom_15">New customer?</h3>
        <a href="{{url("register")}}" role="button" class="tr_all_hover r_corners button_type_4 bg_dark_color bg_cs_hover color_light d_inline_middle m_mxs_left_0">Register here</a>
      </footer>
    </form>
  </section>
</div>
<button class="t_align_c r_corners type_2 tr_all_hover animate_ftl" id="go_to_top"><i class="fa fa-angle-up"></i></button>
<!--scripts include-->
<script src="{{url("assets")}}/js/jquery-2.2.3.min.js"></script>
<script src="{{url("assets/flatastic")}}/js/jquery-ui.min.js"></script>
<script src="{{url("assets/flatastic")}}/js/jquery-migrate-1.2.1.min.js"></script>
<script src="{{url("assets/flatastic")}}/js/retina.js"></script>
<script src="{{url("assets/flatastic")}}/js/elevatezoom.min.js"></script>
<script src="{{url("assets/flatastic")}}/js/waypoints.min.js"></script>
<script src="{{url("assets/flatastic")}}/js/jquery.tweet.min.js"></script>
<script src="{{url("assets/flatastic")}}/js/jquery.fancybox-1.3.4.js"></script>
<script src="{{url("assets/flatastic")}}/js/jquery.flexslider-min.js"></script>
<script src="{{url("assets/flatastic")}}/js/waypoints.min.js"></script>
<script src="{{url("assets/flatastic")}}/js/jquery.isotope.min.js"></script>
<script src="{{url("assets/flatastic")}}/js/owl.carousel.min.js"></script>
<script src="{{url("assets/flatastic")}}/js/jquery.tweet.min.js"></script>
<script src="{{url("assets/flatastic")}}/js/jquery.custom-scrollbar.js"></script>
<script src="{{url("assets/flatastic")}}/js/scripts.js"></script>
<script src="{{url("assets/flatastic")}}/js/custom.js"></script>
<script src="{{url("assets")}}/js/bootstrap3-typeahead.min.js"></script>
<script src="{{url("assets")}}/js/jquery.powertip.min.js"></script>
<script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=xa-5306f8f674bfda4c"></script>

<script type="text/javascript">
  var objects;
  var map;

  //http://stackoverflow.com/questions/12389948/twitter-bootstrap-typeahead-id-label
  $("#search").typeahead({
    minLength: 2,
    autoSelect: false,
    //highlight: true,
    source: function (query, process) {
      objects = [];
      map = {};

      return $.get('{{url("product/autocomplete")}}', { query: query }, function(data) {
        $.each(data, function(i, object) {
          map[object.name] = object;
          objects.push(object.name);
        });
        return process(objects);
      });
    },
    updater: function(item) {
      //console.log(map[item].slug);
      redirect('{{url("product/view/")}}/'+map[item].slug);
    }
  });

  $(document).ready(function() {


    $('#btn-login').click(function (){
      login();
    });

    function login() {
      var data = {
        email: $("#form-login #email_login").val(),
        password: $("#form-login #password_login").val(),
        _token: $("input[name='_token']").val(),
      };

      $.ajax({
        type: "POST",
        url: "{{ url("login") }}",
        data: data,
        success: function(response) {
          //console.log(data);
          //console.log(response);
          if (response === "fail") {
            $("#div-login-result").slideDown();
          } else if (response === "success") {
            redirect("{{url("account")}}");
          } else {
            alert("An error has occurred, please contact admin@pawfamily.sg");
          }
        },
        error: function(response) {
          alert("An error has occurred, please contact admin@pawfamily.sg");
        }
      });
    }

    $('#email_login, #password_login').keypress(function(event) {
      if (event.keyCode == 13 || event.which == 13) {
        login();
      }
    });
  });
</script>

@section('script')

@show

</body>
</html>