<?php use App\Models\Enums\FeaturedType; ?>
<?php use App\Models\Enums\BannerStat; ?>

@extends('template')

@section('script')

@endsection

@section('content')
  <!--slider with banners-->
<section class="container">
  <div class="row clearfix">
    <!--slider-->
    <div class="col-lg-9 col-md-9 col-sm-9 m_xs_bottom_30">
      <div class="flexslider animate_ftr long">
        <ul class="slides">
          @foreach($banners as $banner)
              @if(str_contains(strtolower($banner->identifier), 'main') && $banner->stat == BannerStat::Active)
                <li>
                  @if($banner->link)
                    <a href="{{url($banner->link)}}">
                      <img src="{{url("assets/images/banners/".$banner->image)}}" alt="{{$banner->slug}}" data-custom-thumb="{{url("assets/images/banners/".$banner->image)}}">
                    </a>
                  @else
                    <img src="{{url("assets/images/banners/".$banner->image)}}" alt="{{$banner->slug}}" data-custom-thumb="{{url("assets/images/banners/".$banner->image)}}">
                  @endif
                </li>
              @endif
          @endforeach
        </ul>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 t_xs_align_c s_banners">
      <?php $banner = $banners[6]; ?>
      @if($banner->link)
        <a href="{{$banner->link}}" class="d_block d_xs_inline_b m_bottom_20 animate_ftr">
          <img src="{{url("assets/images/banners/".$banner->image)}}" alt="{{$banner->slug}}">
        </a>
      @else
        <img src="{{url("assets/images/banners/".$banner->image)}}" alt="{{$banner->slug}}" class="d_block d_xs_inline_b m_bottom_20 animate_ftr">
      @endif

      <?php $banner = $banners[7]; ?>
      @if($banner->link)
        <a href="{{$banner->link}}" class="d_block d_xs_inline_b m_xs_left_5 animate_ftr m_mxs_left_0">
          <img src="{{url("assets/images/banners/".$banner->image)}}" alt="{{$banner->slug}}">
        </a>
      @else
        <img src="{{url("assets/images/banners/".$banner->image)}}" alt="{{$banner->slug}}" class="d_block d_xs_inline_b m_xs_left_5 animate_ftr m_mxs_left_0">
      @endif
    </div>
  </div>
</section>
<!--content-->
<div class="page_content_offset">
  <div class="container">
    <!--banners-->
    <section class="row clearfix">
      <div class="col-lg-6 col-md-6 col-sm-6 m_bottom_50 m_sm_bottom_35">
        <?php $banner = $banners[8]; ?>
        @if($banner->link)
          <a href="{{$banner->link}}" class="d_block banner animate_ftr wrapper r_corners relative m_xs_bottom_30">
            <img src="{{url("assets/images/banners/".$banner->image)}}" alt="">
          </a>
        @else
          <img src="{{url("assets/images/banners/".$banner->image)}}" alt="" class="d_block banner animate_ftr wrapper r_corners relative m_xs_bottom_30">
        @endif
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 m_bottom_50 m_sm_bottom_35">
        <?php $banner = $banners[9]; ?>
        @if($banner->link)
          <a href="{{$banner->link}}" class="d_block banner animate_ftr wrapper r_corners relative m_xs_bottom_30">
            <img src="{{url("assets/images/banners/".$banner->image)}}" alt="">
          </a>
        @else
          <img src="{{url("assets/images/banners/".$banner->image)}}" alt="" class="d_block banner animate_ftr wrapper r_corners relative m_xs_bottom_30">
        @endif
      </div>
    </section>
    <div class="row clearfix">
      <h2 class="tt_uppercase m_bottom_20 color_dark heading1 animate_ftr">All Products</h2>
      <!--filter navigation of products-->
      <ul class="horizontal_list clearfix tt_uppercase isotope_menu f_size_ex_large">
        <li class="active m_right_5 m_bottom_10 m_xs_bottom_5 animate_ftr"><button class="button_type_2 bg_light_color_1 r_corners tr_delay_hover tt_uppercase box_s_none" data-filter="*">All</button></li>
        <li class="m_right_5 m_bottom_10 m_xs_bottom_5 animate_ftr"><button class="button_type_2 bg_light_color_1 r_corners tr_delay_hover tt_uppercase box_s_none" data-filter=".Featured">Featured</button></li>
        <li class="m_right_5 m_bottom_10 m_xs_bottom_5 animate_ftr"><button class="button_type_2 bg_light_color_1 r_corners tr_delay_hover tt_uppercase box_s_none" data-filter=".New">New</button></li>
        <li class="m_right_5 m_bottom_10 m_xs_bottom_5 animate_ftr"><button class="button_type_2 bg_light_color_1 r_corners tr_delay_hover tt_uppercase box_s_none" data-filter=".Hot">Hot</button></li>
        <li class="m_right_5 m_bottom_10 m_xs_bottom_5 animate_ftr"><button class="button_type_2 bg_light_color_1 r_corners tr_delay_hover tt_uppercase box_s_none" data-filter=".Sale">Sale</button></li>
      </ul>
      <section class="products_container clearfix m_bottom_25 m_sm_bottom_15">
        @foreach(FeaturedType::$values as $type)
          <?php $featured_types = [''=>'', 'Hot'=>'H', 'Sale'=>'S', 'New'=>'N', 'Featured'=>'F']; ?>
          @if(isset($products[$featured_types[$type]]))
            @foreach($products[$featured_types[$type]] as $product)
              <div class="product_item {{$type}}">
                <figure class="r_corners photoframe shadow relative animate_ftb long" style="width:262px;">
                  <!--product preview-->
                  <a href="{{url("product/view/".$product->slug)}}" class="d_block relative wrapper pp_wrap">
                    <img src="{{url("assets/images/products/".$product->image)}}" class="tr_all_hover" alt="" style="max-width:242px; max-height: 320px;">
                  </a>
                  <!--description and price of product-->
                  <figcaption>
                    <h5 class="m_bottom_10" style="max-width:262px;"><a href="#" class="color_dark">{{$product->name}}</a></h5>
                    <div class="clearfix m_bottom_15">
                      <p class="scheme_color f_size_large f_left">$57.00</p>
                    </div>
                  </figcaption>
                </figure>
              </div>
            @endforeach
          @endif
        @endforeach
      </section>

      <section class="col-lg-12 col-md-12 col-sm-12">

        <!--banners-->
        <div class="row clearfix m_bottom_45">
          <div class="col-lg-6 col-md-6 col-sm-6">
            <span class="d_block animate_ftb h_md_auto m_xs_bottom_15 banner_type_2 r_corners red t_align_c tt_uppercase vc_child n_sm_vc_child">
              <span class="d_inline_middle">
                <img class="d_inline_middle m_md_bottom_5" src="{{url("assets/flatastic")}}/images/banner_img_3.png" alt="">
                <span class="d_inline_middle m_left_10 t_align_l d_md_block t_md_align_c">
                  <b>100% Satisfaction</b><br><span class="color_dark">Guaranteed</span>
                </span>
              </span>
            </span>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6">
            <span class="d_block animate_ftb h_md_auto m_xs_bottom_15 banner_type_2 r_corners green t_align_c tt_uppercase vc_child n_sm_vc_child">
              <span class="d_inline_middle">
                <img class="d_inline_middle m_md_bottom_5" src="{{url("assets/flatastic")}}/images/banner_img_4.png" alt="">
                <span class="d_inline_middle m_left_10 t_align_l d_md_block t_md_align_c">
                  <b>Free<br class="d_none d_sm_block"> Delivery</b><br><span class="color_dark">For Orders >= ${{Cache::get('settings_cache')["freedeliveryaboveorequalto"]}}</span>
                </span>
              </span>
            </span>
          </div>
        </div>
        <div class="clearfix">
          <h2 class="color_dark tt_uppercase f_left m_bottom_15 f_mxs_none heading5 animate_ftr">New Collection</h2>
          <div class="f_right clearfix nav_buttons_wrap animate_fade f_mxs_none m_mxs_bottom_5">
            <button class="button_type_7 bg_cs_hover box_s_none f_size_ex_large t_align_c bg_light_color_1 f_left tr_delay_hover r_corners nc_prev"><i class="fa fa-angle-left"></i></button>
            <button class="button_type_7 bg_cs_hover box_s_none f_size_ex_large t_align_c bg_light_color_1 f_left m_left_5 tr_delay_hover r_corners nc_next"><i class="fa fa-angle-right"></i></button>
          </div>
        </div>
        <!--bestsellers carousel-->
        <div class="nc_carousel m_bottom_30 m_sm_bottom_20">
          <figure class="r_corners photoframe animate_ftb long tr_all_hover type_2 t_align_c shadow relative">
            <!--product preview-->
            <a href="#" class="d_block relative pp_wrap m_bottom_15">
              <!--hot product-->
              <span class="hot_stripe type_2"><img src="{{url("assets/flatastic")}}/images/hot_product_type_2.png" alt=""></span>
              <img src="{{url("assets/flatastic")}}/images/product_img_5.jpg" class="tr_all_hover" alt="">
              <span role="button" data-popup="#quick_view_product" class="button_type_5 box_s_none color_light r_corners tr_all_hover d_xs_none">Quick View</span>
            </a>
            <!--description and price of product-->
            <figcaption class="p_vr_0">
              <h5 class="m_bottom_10"><a href="#" class="color_dark">Aliquam erat volutpat</a></h5>
              <div class="clearfix">
                <!--rating-->
                <ul class="horizontal_list d_inline_b m_bottom_10 type_2 clearfix rating_list tr_all_hover">
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
                <p class="scheme_color f_size_large m_bottom_15">$102.00</p>
              </div>
              <button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0 m_bottom_15">Add to Cart</button>
              <div class="clearfix m_bottom_5">
                <ul class="horizontal_list d_inline_b l_width_divider">
                  <li class="m_right_15 f_md_none m_md_right_0"><a href="#" class="color_dark">Add to Wishlist</a></li>
                  <li class="f_md_none"><a href="#" class="color_dark">Add to Compare</a></li>
                </ul>
              </div>
            </figcaption>
          </figure>
          <figure class="r_corners photoframe animate_ftb long tr_all_hover type_2 t_align_c shadow relative">
            <!--product preview-->
            <a href="#" class="d_block relative pp_wrap m_bottom_15">
              <img src="{{url("assets/flatastic")}}/images/product_img_8.jpg" class="tr_all_hover" alt="">
              <span role="button" data-popup="#quick_view_product" class="button_type_5 box_s_none color_light r_corners tr_all_hover d_xs_none">Quick View</span>
            </a>
            <!--description and price of product-->
            <figcaption class="p_vr_0">
              <h5 class="m_bottom_10"><a href="#" class="color_dark">Eget elementum vel</a></h5>
              <div class="clearfix">
                <!--rating-->
                <ul class="horizontal_list d_inline_b m_bottom_10 type_2 clearfix rating_list tr_all_hover">
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
                <p class="scheme_color f_size_large m_bottom_15">$102.00</p>
              </div>
              <button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0 m_bottom_15">Add to Cart</button>
              <div class="clearfix m_bottom_5">
                <ul class="horizontal_list d_inline_b l_width_divider">
                  <li class="m_right_15 f_md_none m_md_right_0"><a href="#" class="color_dark">Add to Wishlist</a></li>
                  <li class="f_md_none"><a href="#" class="color_dark">Add to Compare</a></li>
                </ul>
              </div>
            </figcaption>
          </figure>
          <figure class="r_corners photoframe animate_ftb long type_2 t_align_c shadow relative tr_all_hover">
            <!--product preview-->
            <a href="#" class="d_block relative pp_wrap m_bottom_15">
              <!--sale product-->
              <span class="hot_stripe type_2"><img src="{{url("assets/flatastic")}}/images/sale_product_type_2.png" alt=""></span>
              <img src="{{url("assets/flatastic")}}/images/product_img_4.jpg" class="tr_all_hover" alt="">
              <span role="button" data-popup="#quick_view_product" class="button_type_5 box_s_none color_light r_corners tr_all_hover d_xs_none">Quick View</span>
            </a>
            <!--description and price of product-->
            <figcaption class="p_vr_0">
              <h5 class="m_bottom_10"><a href="#" class="color_dark">Ut tellus dolor dapibus</a></h5>
              <div class="clearfix m_bottom_15">
                <!--rating-->
                <ul class="horizontal_list d_inline_b m_bottom_10 type_2 clearfix rating_list tr_all_hover">
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
                <p class="scheme_color f_size_large">$57.00</p>
              </div>
              <button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0 m_bottom_15">Add to Cart</button>
              <div class="clearfix m_bottom_5">
                <ul class="horizontal_list d_inline_b l_width_divider">
                  <li class="m_right_15 f_md_none m_md_right_0"><a href="#" class="color_dark">Add to Wishlist</a></li>
                  <li class="f_md_none"><a href="#" class="color_dark">Add to Compare</a></li>
                </ul>
              </div>
            </figcaption>
          </figure>
          <figure class="r_corners photoframe animate_ftb long tr_all_hover type_2 t_align_c shadow relative">
            <!--product preview-->
            <a href="#" class="d_block relative wrapper pp_wrap m_bottom_15">
              <img src="{{url("assets/flatastic")}}/images/product_img_6.jpg" class="tr_all_hover" alt="">
              <span role="button" data-popup="#quick_view_product" class="button_type_5 box_s_none color_light r_corners tr_all_hover d_xs_none">Quick View</span>
            </a>
            <!--description and price of product-->
            <figcaption class="p_vr_0">
              <h5 class="m_bottom_10"><a href="#" class="color_dark">Aliquam erat volutpat</a></h5>
              <div class="clearfix">
                <!--rating-->
                <ul class="horizontal_list d_inline_b m_bottom_10 type_2 clearfix rating_list tr_all_hover">
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
                <p class="scheme_color f_size_large m_bottom_15">$36.00</p>
              </div>
              <button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0 m_bottom_15">Add to Cart</button>
              <div class="clearfix m_bottom_5">
                <ul class="horizontal_list d_inline_b l_width_divider">
                  <li class="m_right_15 f_md_none m_md_right_0"><a href="#" class="color_dark">Add to Wishlist</a></li>
                  <li class="f_md_none"><a href="#" class="color_dark">Add to Compare</a></li>
                </ul>
              </div>
            </figcaption>
          </figure>
        </div>
        <div class="clearfix m_bottom_25 m_sm_bottom_20">
          <h2 class="tt_uppercase color_dark f_left heading2 animate_fade f_mxs_none m_mxs_bottom_15">Brands</h2>
          <div class="f_right clearfix nav_buttons_wrap animate_fade f_mxs_none">
            <button class="button_type_7 bg_cs_hover box_s_none f_size_ex_large t_align_c bg_light_color_1 f_left tr_delay_hover r_corners pb_prev"><i class="fa fa-angle-left"></i></button>
            <button class="button_type_7 bg_cs_hover box_s_none f_size_ex_large t_align_c bg_light_color_1 f_left m_left_5 tr_delay_hover r_corners pb_next"><i class="fa fa-angle-right"></i></button>
          </div>
        </div>
        <!--product brands carousel-->
        <div class="product_brands with_sidebar m_bottom_45 m_sm_bottom_35">
          @foreach($brands as $brand)
            <a href="{{url('product/brand/'.$brand->slug)}}" class="d_block t_align_c animate_fade"><img src="{{url("assets/images/brands/".$brand->image)}}" alt=""></a>
          @endforeach
        </div>

        <div class="row clearfix m_bottom_45 m_sm_bottom_35">
          <div class="col-lg-12 col-md-12 col-sm-12 ti_animate animate_ftr">
            <div class="clearfix m_bottom_25 m_sm_bottom_20">
              <h2 class="tt_uppercase color_dark f_left f_mxs_none m_mxs_bottom_15">What Our Customers Say</h2>
              <div class="f_right clearfix nav_buttons_wrap f_mxs_none">
                <button class="button_type_7 bg_cs_hover box_s_none f_size_ex_large bg_light_color_1 f_left tr_delay_hover r_corners ti_prev"><i class="fa fa-angle-left"></i></button>
                <button class="button_type_7 bg_cs_hover box_s_none f_size_ex_large bg_light_color_1 f_left m_left_5 tr_delay_hover r_corners ti_next"><i class="fa fa-angle-right"></i></button>
              </div>
            </div>
            <!--testimonials carousel-->
            <div class="testiomials_carousel">
              @foreach($testimonials as $testimonial)
                <div>
                  <blockquote class="r_corners shadow f_size_large relative m_bottom_15 @if(array_first($testimonials) == $testimonial) animate_ftr @endif">
                    {{$testimonial->testimonial}}
                  </blockquote>
                  <div class="d_inline_middle m_left_15 @if(array_first($testimonials) == $testimonial) animate_ftr @endif">
                    <h5 class="color_dark"><b>{{$testimonial->name}}</b></h5>
                    <p>{{$testimonial->location}}</p>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>
@endsection