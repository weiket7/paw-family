@extends('template')

@section('script')

@endsection

@section('content')
<script type="text/javascript">
  function selectSize() {
    var size = $('input[name=size]:checked').val()
    var repack_options_json = '{!! json_encode($product->repack) !!}';
    var repack_options_object = JSON.parse(repack_options_json);
    var repack_options = repack_options_object[size];
    //console.log(JSON.stringify(repack_options)+"<br>");
    var html = "";
    if (typeof repack_options === 'undefined') {
      $("#repack_option_title").text("No repack options")
      $("#repack_option").html("");
      return;
    };

    for (var key in repack_options) {
      if (repack_options.hasOwnProperty(key)) {
        html += "<li class='tr_delay_hover'>"+repack_options[key].repack_name+"</li>";
      }
    }
    $("#repack_option_title").text("Select Repack")
    $("#repack_option").html(html);
    //console.log(html);
  }
</script>


  <!--breadcrumbs-->
<section class="breadcrumbs">
  <div class="container">
    <ul class="horizontal_list clearfix bc_list f_size_medium">
      <li class="m_right_10 current"><a href="#" class="default_t_color">Home<i class="fa fa-angle-right d_inline_middle m_left_10"></i></a></li>
      <li class="m_right_10"><a href="#" class="default_t_color">Women</a><i class="fa fa-angle-right d_inline_middle m_left_10"></i></li>
      <li><a href="#" class="default_t_color">Eget elementum vel</a></li>
    </ul>
  </div>
</section>
<!--content-->
<div class="page_content_offset">
  <div class="container">
    <div class="clearfix m_bottom_30 t_xs_align_c">
      <div class="row">
        <div class="col-md-5">
          <div class="photoframe type_2 shadow r_corners f_left f_sm_none d_xs_inline_b product_single_preview relative m_right_30 m_bottom_5 m_sm_bottom_20 m_xs_right_0 w_mxs_full">
            <span class="hot_stripe"><img src="{{url("assets/flatastic")}}/images/sale_product.png" alt=""></span>
            <div class="relative d_inline_b m_bottom_10 qv_preview d_xs_block">
              <img id="zoom_image" src="{{url("assets/images/products/".$product->image)}}" data-zoom-image="images/preview_zoom_1.jpg" class="tr_all_hover" alt="">
              <a href="images/preview_zoom_1.jpg" class="d_block button_type_5 r_corners tr_all_hover box_s_none color_light p_hr_0">
                <i class="fa fa-expand"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-7">

          <div class="p_top_10 t_xs_align_l">
        <!--description-->
        <h2 class="color_dark fw_medium m_bottom_10">{{$product->name}}</h2>
        <hr class="m_bottom_10 divider_type_3">
        <table class="description_table m_bottom_10">
          <tr>
            <td>Brand:</td>
            <td><a href="#" class="color_dark">{{ $product->brand }}</a></td>
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
        {{--<h5 class="fw_medium m_bottom_10">Product Dimensions and Weight</h5>
        <table class="description_table m_bottom_5">
          <tr>
            <td>Product Length:</td>
            <td><span class="color_dark">10.0000M</span></td>
          </tr>
          <tr>
            <td>Product Weight:</td>
            <td>10.0000KG</td>
          </tr>
        </table>--}}
        <hr class="divider_type_3 m_bottom_10">
        <p class="m_bottom_10">Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Donec sit amet eros. Lorem ipsum dolor sit amet, consecvtetuer adipiscing. </p>
        <hr class="divider_type_3 m_bottom_15">

        <table class="description_table type_2 m_bottom_15">
          @if(count($product->sizes))
          <tr>
            <td class="v_align_t">Size:</td>
            <td class="v_align_m">
              <table class="size_table">
                @foreach($product->sizes as $size)
                <tr>
                  <td>
                    <input type="radio" name="size" id="size{{$size->size_name}}" class="d_none" value="{{$size->product_size_id}}" onclick="selectSize()">
                    <label for="size{{$size->size_name}}">{{$size->size_name}}</label>
                  </td>
                  <td>
                    ${{$size->price}}
                  </td>
                </tr>
                @endforeach
              </table>
            </td>
          </tr>
          @endif
          <tr>
            <td class="v_align_m">Quantity:</td>
            <td class="v_align_m">
              <div class="clearfix quantity r_corners d_inline_middle f_size_medium color_dark">
                <button class="bg_tr d_block f_left" data-direction="down">-</button>
                <input type="text" name="" readonly value="1" class="f_left">
                <button class="bg_tr d_block f_left" data-direction="up">+</button>
              </div>
            </td>
          </tr>
          @if(count($product->sizes))
          <tr>
            <td class="v_align_m">Repack:</td>
            <td class="v_align_m">
              <div class="custom_select f_size_medium relative d_inline_middle">
                <div class="select_title r_corners relative color_dark" id="repack_option_title">Select Size</div>
                <ul class="select_list d_none" id="repack_option"></ul>
                <select name="repack_option">
                  <option value="s">s</option>
                  <option value="m">m</option>
                  <option value="l">l</option>
                </select>
              </div>
            </td>
          </tr>
          @endif
        </table>

        <div class="m_bottom_15">
          <s class="v_align_b f_size_ex_large">$152.00</s>
          <span class="v_align_b f_size_big m_left_5 scheme_color fw_medium">$102.00</span>
        </div>
        <div class="d_ib_offset_0 m_bottom_20">
          <button class="button_type_12 r_corners bg_scheme_color color_light tr_delay_hover d_inline_b f_size_large m_right_5">Add to Cart</button>
          <button class="button_type_12 r_corners bg_color_blue color_light tr_delay_hover d_inline_b f_size_large" onclick="history.go(-1)">Back</button>
        </div>
      </div>

        </div>
      </div>
    </div>
    <!--tabs-->
    <div class="tabs m_bottom_45">
      <!--tabs navigation-->
      <nav>
        <ul class="tabs_nav horizontal_list clearfix">
          <li class="f_xs_none"><a href="#tab-1" class="bg_light_color_1 color_dark tr_delay_hover r_corners d_block">Description</a></li>
          {{--<li class="f_xs_none"><a href="#tab-2" class="bg_light_color_1 color_dark tr_delay_hover r_corners d_block">Specifications</a></li>
          <li class="f_xs_none"><a href="#tab-3" class="bg_light_color_1 color_dark tr_delay_hover r_corners d_block">Reviews</a></li>
          <li class="f_xs_none"><a href="#tab-4" class="bg_light_color_1 color_dark tr_delay_hover r_corners d_block">Custom Tab</a></li>--}}
        </ul>
      </nav>
      <section class="tabs_content shadow r_corners">
        <div id="tab-1">
          <p class="m_bottom_10">Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Donec sit amet eros. Lorem ipsum dolor sit amet, consecvtetuer adipiscing elit. Mauris fermentum dictum magna. Sed laoreet aliquam leo. Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. </p>
          <p class="m_bottom_15">Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse sollicitudin velit sed leo. Ut pharetra augue nec augue. Nam elit agna,endrerit sit amet, tincidunt ac, viverra sed, nulla. Donec porta diam eu massa. Quisque diam lorem, interdum vitae,dapibus ac, scelerisque vitae, pede. Donec eget tellus non erat lacinia fermentum. </p>
        </div>
      </section>
    </div>
    <div class="clearfix">
      <h2 class="color_dark tt_uppercase f_left m_bottom_15 f_mxs_none">Related Products</h2>
      <div class="f_right clearfix nav_buttons_wrap f_mxs_none m_mxs_bottom_5">
        <button class="button_type_7 bg_cs_hover box_s_none f_size_ex_large t_align_c bg_light_color_1 f_left tr_delay_hover r_corners rp_prev"><i class="fa fa-angle-left"></i></button>
        <button class="button_type_7 bg_cs_hover box_s_none f_size_ex_large t_align_c bg_light_color_1 f_left m_left_5 tr_delay_hover r_corners rp_next"><i class="fa fa-angle-right"></i></button>
      </div>
    </div>
    <div class="related_projects product_full_width m_bottom_15">
      <figure class="r_corners photoframe shadow relative d_inline_b d_md_block d_xs_inline_b tr_all_hover">
        <!--product preview-->
        <a href="#" class="d_block relative pp_wrap">
          <!--hot product-->
          <span class="hot_stripe type_2"><img src="{{url("assets/flatastic")}}/images/hot_product_type_2.png" alt=""></span>
          <img src="{{url("assets/flatastic")}}/images/product_img_5.jpg" class="tr_all_hover" alt="">
          <span data-popup="#quick_view_product" class="button_type_5 box_s_none color_light r_corners tr_all_hover d_xs_none">Quick View</span>
        </a>
        <!--description and price of product-->
        <figcaption class="t_xs_align_l">
          <h5 class="m_bottom_10"><a href="#" class="color_dark ellipsis">Eget elementum vel</a></h5>
          <div class="clearfix">
            <p class="scheme_color f_left f_size_large m_bottom_15">$102.00</p>
            <!--rating-->
            <ul class="horizontal_list f_right clearfix rating_list tr_all_hover">
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
          </div>
          <button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0">Add to Cart</button>
        </figcaption>
      </figure>
      <figure class="r_corners photoframe shadow relative d_inline_b d_md_block d_xs_inline_b tr_all_hover">
        <!--product preview-->
        <a href="#" class="d_block relative pp_wrap">
          <img src="{{url("assets/flatastic")}}/images/product_img_7.jpg" class="tr_all_hover" alt="">
          <span data-popup="#quick_view_product" class="button_type_5 box_s_none color_light r_corners tr_all_hover d_xs_none">Quick View</span>
        </a>
        <!--description and price of product-->
        <figcaption class="t_xs_align_l">
          <h5 class="m_bottom_10"><a href="#" class="color_dark ellipsis">Cursus eleifend elit aenean elit aenean</a></h5>
          <div class="clearfix">
            <p class="scheme_color f_left f_size_large m_bottom_15">$99.00</p>
            <!--rating-->
            <ul class="horizontal_list f_right clearfix rating_list tr_all_hover">
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
          </div>
          <button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0">Add to Cart</button>
        </figcaption>
      </figure>
      <figure class="r_corners photoframe shadow relative d_inline_b d_md_block d_xs_inline_b tr_all_hover">
        <!--product preview-->
        <a href="#" class="d_block relative pp_wrap">
          <!--hot product-->
          <span class="hot_stripe type_2"><img src="{{url("assets/flatastic")}}/images/hot_product_type_2.png" alt=""></span>
          <img src="{{url("assets/flatastic")}}/images/product_img_3.jpg" class="tr_all_hover" alt="">
          <span data-popup="#quick_view_product" class="button_type_5 box_s_none color_light r_corners tr_all_hover d_xs_none">Quick View</span>
        </a>
        <!--description and price of product-->
        <figcaption class="t_xs_align_l">
          <h5 class="m_bottom_10"><a href="#" class="color_dark ellipsis">Eget elementum vel</a></h5>
          <div class="clearfix">
            <p class="scheme_color f_left f_size_large m_bottom_15">$102.00</p>
            <!--rating-->
            <ul class="horizontal_list f_right clearfix rating_list tr_all_hover">
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
          </div>
          <button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0">Add to Cart</button>
        </figcaption>
      </figure>
      <figure class="r_corners photoframe shadow relative d_inline_b d_md_block d_xs_inline_b tr_all_hover">
        <!--product preview-->
        <a href="#" class="d_block relative pp_wrap">
          <img src="{{url("assets/flatastic")}}/images/product_img_1.jpg" class="tr_all_hover" alt="">
          <span data-popup="#quick_view_product" class="button_type_5 box_s_none color_light r_corners tr_all_hover d_xs_none">Quick View</span>
        </a>
        <!--description and price of product-->
        <figcaption class="t_xs_align_l">
          <h5 class="m_bottom_10"><a href="#" class="color_dark ellipsis">Cursus eleifend elit aenean...</a></h5>
          <div class="clearfix">
            <p class="scheme_color f_left f_size_large m_bottom_15">$99.00</p>
            <!--rating-->
            <ul class="horizontal_list f_right clearfix rating_list tr_all_hover">
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
          </div>
          <button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0">Add to Cart</button>
        </figcaption>
      </figure>
      <figure class="r_corners photoframe shadow relative d_inline_b d_md_block d_xs_inline_b tr_all_hover">
        <!--product preview-->
        <a href="#" class="d_block relative pp_wrap">
          <!--sale product-->
          <span class="hot_stripe type_2"><img src="{{url("assets/flatastic")}}/images/sale_product_type_2.png" alt=""></span>
          <img src="{{url("assets/flatastic")}}/images/product_img_9.jpg" class="tr_all_hover" alt="">
          <span data-popup="#quick_view_product" class="button_type_5 box_s_none color_light r_corners tr_all_hover d_xs_none">Quick View</span>
        </a>
        <!--description and price of product-->
        <figcaption class="t_xs_align_l">
          <h5 class="m_bottom_10"><a href="#" class="color_dark ellipsis">Aliquam erat volutpat</a></h5>
          <div class="clearfix">
            <p class="scheme_color f_left f_size_large m_bottom_15"><s class="default_t_color m_right_5">$79.00</s>$36.00</p>
            <!--rating-->
            <ul class="horizontal_list f_right clearfix rating_list tr_all_hover">
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
          </div>
          <button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0">Add to Cart</button>
        </figcaption>
      </figure>
    </div>
  </div>
</div>
<!--markup footer-->

@endsection
