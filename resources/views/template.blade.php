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
      <div class="container t_align_c m_bottom_20">
        <!--social icons-->
        <ul class="clearfix d_inline_b horizontal_list social_icons">
          <li class="facebook m_bottom_5 relative">
            <span class="tooltip tr_all_hover r_corners color_dark f_size_small">Facebook</span>
            <a href="#" class="r_corners t_align_c tr_delay_hover f_size_ex_large">
              <i class="fa fa-facebook"></i>
            </a>
          </li>
          <li class="twitter m_left_5 m_bottom_5 relative">
            <span class="tooltip tr_all_hover r_corners color_dark f_size_small">Twitter</span>
            <a href="#" class="r_corners f_size_ex_large t_align_c tr_delay_hover">
              <i class="fa fa-twitter"></i>
            </a>
          </li>
          <li class="google_plus m_left_5 m_bottom_5 relative">
            <span class="tooltip tr_all_hover r_corners color_dark f_size_small">Google Plus</span>
            <a href="#" class="r_corners f_size_ex_large t_align_c tr_delay_hover">
              <i class="fa fa-google-plus"></i>
            </a>
          </li>
          <li class="rss m_left_5 m_bottom_5 relative">
            <span class="tooltip tr_all_hover r_corners color_dark f_size_small">Rss</span>
            <a href="#" class="r_corners f_size_ex_large t_align_c tr_delay_hover">
              <i class="fa fa-rss"></i>
            </a>
          </li>
          <li class="pinterest m_left_5 m_bottom_5 relative">
            <span class="tooltip tr_all_hover r_corners color_dark f_size_small">Pinterest</span>
            <a href="#" class="r_corners f_size_ex_large t_align_c tr_delay_hover">
              <i class="fa fa-pinterest"></i>
            </a>
          </li>
          <li class="instagram m_left_5 m_bottom_5 relative">
            <span class="tooltip tr_all_hover r_corners color_dark f_size_small">Instagram</span>
            <a href="#" class="r_corners f_size_ex_large t_align_c tr_delay_hover">
              <i class="fa fa-instagram"></i>
            </a>
          </li>
          <li class="linkedin m_left_5 m_bottom_5 m_sm_left_5 relative">
            <span class="tooltip tr_all_hover r_corners color_dark f_size_small">LinkedIn</span>
            <a href="#" class="r_corners f_size_ex_large t_align_c tr_delay_hover">
              <i class="fa fa-linkedin"></i>
            </a>
          </li>
          <li class="vimeo m_left_5 m_bottom_5 relative">
            <span class="tooltip tr_all_hover r_corners color_dark f_size_small">Vimeo</span>
            <a href="#" class="r_corners f_size_ex_large t_align_c tr_delay_hover">
              <i class="fa fa-vimeo-square"></i>
            </a>
          </li>
          <li class="youtube m_left_5 m_bottom_5 relative">
            <span class="tooltip tr_all_hover r_corners color_dark f_size_small">Youtube</span>
            <a href="#" class="r_corners f_size_ex_large t_align_c tr_delay_hover">
              <i class="fa fa-youtube-play"></i>
            </a>
          </li>
          <li class="flickr m_left_5 m_bottom_5 relative">
            <span class="tooltip tr_all_hover r_corners color_dark f_size_small">Flickr</span>
            <a href="#" class="r_corners f_size_ex_large t_align_c tr_delay_hover">
              <i class="fa fa-flickr"></i>
            </a>
          </li>
          <li class="envelope m_left_5 m_bottom_5 relative">
            <span class="tooltip tr_all_hover r_corners color_dark f_size_small">Contact Us</span>
            <a href="#" class="r_corners f_size_ex_large t_align_c tr_delay_hover">
              <i class="fa fa-envelope-o"></i>
            </a>
          </li>
        </ul>
      </div>
      <hr class="divider_type_4 m_bottom_50">
      <div class="container">
        <div class="row clearfix">
          <div class="col-lg-3 col-md-3 col-sm-3 m_xs_bottom_30">
            <h3 class="color_light_2 m_bottom_20">About</h3>
            <p class="m_bottom_15">Paw Family is a one-stop online pet store which offers pet owners incredible savings on top quality pet supplies.<br><br>

              Our mission is to provide fantastic deals to cater the needs for your precious pets. As pet lovers ourselves, we value the quality and reliability of every product.</p>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-2 m_xs_bottom_30">
            <h3 class="color_light_2 m_bottom_20">Information</h3>
            <ul class="vertical_list">
              <li><a class="color_light tr_delay_hover" href="#">About Us<i class="fa fa-angle-right"></i></a></li>
              <li><a class="color_light tr_delay_hover" href="#">Delivery<i class="fa fa-angle-right"></i></a></li>
              <li><a class="color_light tr_delay_hover" href="#">Contact Us<i class="fa fa-angle-right"></i></a></li>
              <li><a class="color_light tr_delay_hover" href="#">Terms &amp; Conditions<i class="fa fa-angle-right"></i></a></li>
            </ul>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-2 m_xs_bottom_30">
            <h3 class="color_light_2 m_bottom_20">Catalog</h3>
            <ul class="vertical_list">
              <li><a class="color_light tr_delay_hover" href="#">New Collection<i class="fa fa-angle-right"></i></a></li>
              <li><a class="color_light tr_delay_hover" href="#">Best Sellers<i class="fa fa-angle-right"></i></a></li>
              <li><a class="color_light tr_delay_hover" href="#">Specials<i class="fa fa-angle-right"></i></a></li>
              <li><a class="color_light tr_delay_hover" href="#">Manufacturers<i class="fa fa-angle-right"></i></a></li>
            </ul>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-3">
            <h3 class="color_light_2 m_bottom_20">Contact Us</h3>
            <ul class="c_info_list">
              <li class="m_bottom_10">
                <div class="clearfix m_bottom_15">
                  <i class="fa fa-map-marker f_left"></i>
                  <p class="contact_e">8901 Marmora Road,<br> Glasgow, D04 89GR.</p>
                </div>
              </li>
              <li class="m_bottom_10">
                <div class="clearfix m_bottom_10">
                  <i class="fa fa-phone f_left"></i>
                  <p class="contact_e">800-559-65-80</p>
                </div>
              </li>
              <li class="m_bottom_10">
                <div class="clearfix m_bottom_10">
                  <i class="fa fa-envelope f_left"></i>
                  <a class="contact_e color_light" href="mailto:#">info@companyname.com</a>
                </div>
              </li>
              <li>
                <div class="clearfix">
                  <i class="fa fa-clock-o f_left"></i>
                  <p class="contact_e">Monday - Friday: 08.00-20.00 <br>Saturday: 09.00-15.00<br> Sunday: closed</p>
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
<!--social widgets-->
<ul class="social_widgets d_xs_none">
  <!--facebook-->
  <li class="relative">
    <button class="sw_button t_align_c facebook"><i class="fa fa-facebook"></i></button>
    <div class="sw_content">
      <h3 class="color_dark m_bottom_20">Join Us on Facebook</h3>
      <iframe src="http://www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fenvato&amp;width=235&amp;height=258&amp;colorscheme=light&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=false&amp;appId=438889712801266" style="border:none; overflow:hidden; width:235px; height:258px;"></iframe>
    </div>
  </li>
  <!--twitter feed-->
  <li class="relative">
    <button class="sw_button t_align_c twitter"><i class="fa fa-twitter"></i></button>
    <div class="sw_content">
      <h3 class="color_dark m_bottom_20">Latest Tweets</h3>
      <div class="twitterfeed m_bottom_25"></div>
      <a role="button" class="button_type_4 d_inline_b r_corners tr_all_hover color_light tw_color" href="https://twitter.com/fanfbmltemplate">Follow on Twitter</a>
    </div>
  </li>
  <!--contact form-->
  <li class="relative">
    <button class="sw_button t_align_c contact"><i class="fa fa-envelope-o"></i></button>
    <div class="sw_content">
      <h3 class="color_dark m_bottom_20">Contact Us</h3>
      <p class="f_size_medium m_bottom_15">Lorem ipsum dolor sit amet, consectetuer adipis mauris</p>
      <form id="contactform" class="mini">
        <input class="f_size_medium m_bottom_10 r_corners full_width" type="text" name="cf_name" placeholder="Your name">
        <input class="f_size_medium m_bottom_10 r_corners full_width" type="email" name="cf_email" placeholder="Email">
        <textarea class="f_size_medium r_corners full_width m_bottom_20" placeholder="Message" name="cf_message"></textarea>
        <button type="submit" class="button_type_4 r_corners mw_0 tr_all_hover color_dark bg_light_color_2">Send</button>
      </form>
    </div>
  </li>
  <!--contact info-->
  <li class="relative">
    <button class="sw_button t_align_c googlemap"><i class="fa fa-map-marker"></i></button>
    <div class="sw_content">
      <h3 class="color_dark m_bottom_20">Store Location</h3>
      <ul class="c_info_list">
        <li class="m_bottom_10">
          <div class="clearfix m_bottom_15">
            <i class="fa fa-map-marker f_left color_dark"></i>
            <p class="contact_e">8901 Marmora Road,<br> Glasgow, D04 89GR.</p>
          </div>
          <iframe class="r_corners full_width" id="gmap_mini" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=ru&amp;geocode=&amp;q=Manhattan,+New+York,+NY,+United+States&amp;aq=0&amp;oq=monheten&amp;sll=37.0625,-95.677068&amp;sspn=65.430355,129.814453&amp;t=m&amp;ie=UTF8&amp;hq=&amp;hnear=%D0%9C%D0%B0%D0%BD%D1%85%D1%8D%D1%82%D1%82%D0%B5%D0%BD,+%D0%9D%D1%8C%D1%8E-%D0%99%D0%BE%D1%80%D0%BA,+%D0%9D%D1%8C%D1%8E+%D0%99%D0%BE%D1%80%D0%BA,+%D0%9D%D1%8C%D1%8E-%D0%99%D0%BE%D1%80%D0%BA&amp;ll=40.790278,-73.959722&amp;spn=0.015612,0.031693&amp;z=13&amp;output=embed"></iframe>
        </li>
        <li class="m_bottom_10">
          <div class="clearfix m_bottom_10">
            <i class="fa fa-phone f_left color_dark"></i>
            <p class="contact_e">800-559-65-80</p>
          </div>
        </li>
        <li class="m_bottom_10">
          <div class="clearfix m_bottom_10">
            <i class="fa fa-envelope f_left color_dark"></i>
            <a class="contact_e default_t_color" href="mailto:#">info@companyname.com</a>
          </div>
        </li>
        <li>
          <div class="clearfix">
            <i class="fa fa-clock-o f_left color_dark"></i>
            <p class="contact_e">Monday - Friday: 08.00-20.00 <br>Saturday: 09.00-15.00<br> Sunday: closed</p>
          </div>
        </li>
      </ul>
    </div>
  </li>
</ul>
<!--custom popup-->
<div class="popup_wrap d_none" id="quick_view_product">
  <section class="popup r_corners shadow">
    <button class="bg_tr color_dark tr_all_hover text_cs_hover close f_size_large"><i class="fa fa-times"></i></button>
    <div class="clearfix">
      <div class="custom_scrollbar">
        <!--left popup column-->
        <div class="f_left half_column">
          <div class="relative d_inline_b m_bottom_10 qv_preview">
            <span class="hot_stripe"><img src="{{url("assets/flatastic")}}/images/sale_product.png" alt=""></span>
            <img src="{{url("assets/flatastic")}}/images/quick_view_img_1.jpg" class="tr_all_hover" alt="">
          </div>
          <!--carousel-->
          <div class="relative qv_carousel_wrap m_bottom_20">
            <button class="button_type_11 t_align_c f_size_ex_large bg_cs_hover r_corners d_inline_middle bg_tr tr_all_hover qv_btn_prev">
              <i class="fa fa-angle-left "></i>
            </button>
            <ul class="qv_carousel d_inline_middle">
              <li data-src="{{url("assets/flatastic")}}/images/quick_view_img_1.jpg"><img src="{{url("assets/flatastic")}}/images/quick_view_img_4.jpg" alt=""></li>
              <li data-src="{{url("assets/flatastic")}}/images/quick_view_img_2.jpg"><img src="{{url("assets/flatastic")}}/images/quick_view_img_5.jpg" alt=""></li>
              <li data-src="{{url("assets/flatastic")}}/images/quick_view_img_3.jpg"><img src="{{url("assets/flatastic")}}/images/quick_view_img_6.jpg" alt=""></li>
              <li data-src="{{url("assets/flatastic")}}/images/quick_view_img_1.jpg"><img src="{{url("assets/flatastic")}}/images/quick_view_img_4.jpg" alt=""></li>
              <li data-src="{{url("assets/flatastic")}}/images/quick_view_img_2.jpg"><img src="{{url("assets/flatastic")}}/images/quick_view_img_5.jpg" alt=""></li>
              <li data-src="{{url("assets/flatastic")}}/images/quick_view_img_3.jpg"><img src="{{url("assets/flatastic")}}/images/quick_view_img_6.jpg" alt=""></li>
            </ul>
            <button class="button_type_11 t_align_c f_size_ex_large bg_cs_hover r_corners d_inline_middle bg_tr tr_all_hover qv_btn_next">
              <i class="fa fa-angle-right "></i>
            </button>
          </div>
          <div class="d_inline_middle">Share this:</div>
          <div class="d_inline_middle m_left_5">
            <!-- AddThis Button BEGIN -->
            <div class="addthis_toolbox addthis_default_style addthis_32x32_style">
              <a class="addthis_button_preferred_1"></a>
              <a class="addthis_button_preferred_2"></a>
              <a class="addthis_button_preferred_3"></a>
              <a class="addthis_button_preferred_4"></a>
              <a class="addthis_button_compact"></a>
              <a class="addthis_counter addthis_bubble_style"></a>
            </div>
            <!-- AddThis Button END -->
          </div>
        </div>
        <!--right popup column-->
        <div class="f_right half_column">
          <!--description-->
          <h2 class="m_bottom_10"><a href="#" class="color_dark fw_medium">Eget elementum vel</a></h2>
          <div class="m_bottom_10">
            <!--rating-->
            <ul class="horizontal_list d_inline_middle type_2 clearfix rating_list tr_all_hover">
              <li class="active">
                <i class="fa fa-star-o empty tr_all_hover"></i>
                <i class="fa fa-star active tr_all_hover"></i>
              </li>
              <li class="active">
                <i class="fa fa-star-o empty tr_all_hover"></i>
                <i class="fa fa-star active tr_all_hover"></i>
              </li>
              <li class="active">
                <i class="fa fa-star-o empty tr_all_hover"></i>
                <i class="fa fa-star active tr_all_hover"></i>
              </li>
              <li class="active">
                <i class="fa fa-star-o empty tr_all_hover"></i>
                <i class="fa fa-star active tr_all_hover"></i>
              </li>
              <li>
                <i class="fa fa-star-o empty tr_all_hover"></i>
                <i class="fa fa-star active tr_all_hover"></i>
              </li>
            </ul>
            <a href="#" class="d_inline_middle default_t_color f_size_small m_left_5">1 Review(s) </a>
          </div>
          <hr class="m_bottom_10 divider_type_3">
          <table class="description_table m_bottom_10">
            <tr>
              <td>Manufacturer:</td>
              <td><a href="#" class="color_dark">Chanel</a></td>
            </tr>
            <tr>
              <td>Availability:</td>
              <td><span class="color_green">in stock</span> 20 item(s)</td>
            </tr>
            <tr>
              <td>Product Code:</td>
              <td>PS06</td>
            </tr>
          </table>
          <h5 class="fw_medium m_bottom_10">Product Dimensions and Weight</h5>
          <table class="description_table m_bottom_5">
            <tr>
              <td>Product Length:</td>
              <td><span class="color_dark">10.0000M</span></td>
            </tr>
            <tr>
              <td>Product Weight:</td>
              <td>10.0000KG</td>
            </tr>
          </table>
          <hr class="divider_type_3 m_bottom_10">
          <p class="m_bottom_10">Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Donec sit amet eros. Lorem ipsum dolor sit amet, consecvtetuer adipiscing elit. </p>
          <hr class="divider_type_3 m_bottom_15">
          <div class="m_bottom_15">
            <s class="v_align_b f_size_ex_large">$152.00</s><span class="v_align_b f_size_big m_left_5 scheme_color fw_medium">$102.00</span>
          </div>
          <table class="description_table type_2 m_bottom_15">
            <tr>
              <td class="v_align_m">Size:</td>
              <td class="v_align_m">
                <div class="custom_select f_size_medium relative d_inline_middle">
                  <div class="select_title r_corners relative color_dark">s</div>
                  <ul class="select_list d_none"></ul>
                  <select name="product_name">
                    <option value="s">s</option>
                    <option value="m">m</option>
                    <option value="l">l</option>
                  </select>
                </div>
              </td>
            </tr>
            <tr>
              <td class="v_align_m"><Quantity></Quantity>:</td>
              <td class="v_align_m">
                <div class="clearfix quantity r_corners d_inline_middle f_size_medium color_dark">
                  <button class="bg_tr d_block f_left" data-direction="down">-</button>
                  <input type="text" name="" readonly value="1" class="f_left">
                  <button class="bg_tr d_block f_left" data-direction="up">+</button>
                </div>
              </td>
            </tr>
          </table>
          <div class="clearfix m_bottom_15">
            <button class="button_type_12 r_corners bg_scheme_color color_light tr_delay_hover f_left f_size_large">Add to Cart</button>
            <button class="button_type_12 bg_light_color_2 tr_delay_hover f_left r_corners color_dark m_left_5 p_hr_0"><i class="fa fa-heart-o f_size_big"></i><span class="tooltip tr_all_hover r_corners color_dark f_size_small">Wishlist</span></button>
            <button class="button_type_12 bg_light_color_2 tr_delay_hover f_left r_corners color_dark m_left_5 p_hr_0"><i class="fa fa-files-o f_size_big"></i><span class="tooltip tr_all_hover r_corners color_dark f_size_small">Compare</span></button>
            <button class="button_type_12 bg_light_color_2 tr_delay_hover f_left r_corners color_dark m_left_5 p_hr_0 relative"><i class="fa fa-question-circle f_size_big"></i><span class="tooltip tr_all_hover r_corners color_dark f_size_small">Ask a Question</span></button>
          </div>
        </div>
      </div>
    </div>
  </section>
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
          <label for="email" class="m_bottom_5 d_inline_b">Email</label><br>
          <input type="text" name="email" id="email" class="r_corners full_width">
        </li>
        <li class="m_bottom_25">
          <label for="password" class="m_bottom_5 d_inline_b">Password</label><br>
          <input type="password" name="password" id="password" class="r_corners full_width">
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
        email: $("#form-login #email").val(),
        password: $("#form-login #password").val(),
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

    $('#email, #password').keypress(function(event) {
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