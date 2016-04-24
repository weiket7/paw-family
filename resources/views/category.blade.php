<?php use App\Models\Enums\ProductFeaturedStat; ?>
<?php use App\Models\Enums\MainCategory; ?>

@extends('template')

@section('script')

@endsection

@section('content')

<!--<section class="breadcrumbs">-->
  <div class="container">
    <ul class="horizontal_list clearfix bc_list f_size_medium"  style="background-color:#f2f4f5; padding: 9px;">
      <li class="m_right_10 current">
        Home<i class="fa fa-angle-right d_inline_middle m_left_10"></i>
      </li>
      <li class="m_right_10 current">
        {{MainCategory::$values[$category->main_category]}}<i class="fa fa-angle-right d_inline_middle m_left_10"></i>
      </li>
      <li><a href="#" class=""><b>{{$category->name}}</b></a></li>
    </ul>
  </div>
<!--</section>-->

<div class="page_content_offset">
  <div class="container">
    <div class="row clearfix">
      <!--left content column-->
      <section class="col-lg-9 col-md-9 col-sm-9">
        <div class="row clearfix m_bottom_10">
          <div class="col-lg-7 col-md-8 col-sm-12 m_sm_bottom_10">
            <p class="d_inline_middle f_size_medium">Sort By:</p>
            <div class="clearfix d_inline_middle m_left_10">
              <!--product name select-->
              <div class="custom_select f_size_medium relative f_left">
                <div class="select_title r_corners relative color_dark">Popularity</div>
                <ul class="select_list d_none"></ul>
                <select name="product_name">
                  <option value="Product Price">Bestsellers</option>
                  <option value="Product Price">Lowest Price</option>
                  <option value="Product ID">Highest Price</option>
                  <option value="Product ID">Latest Arrival</option>
                  <option value="Product ID">Discount</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-lg-5 col-md-4 col-sm-12 t_align_r t_sm_align_l">
            <p class="d_inline_middle f_size_medium d_xs_block m_xs_bottom_5">Showing {{count($products)}} products</p>
          </div>
          {{--<div class="col-lg-5 col-md-4 col-sm-12 t_align_r t_sm_align_l">
            <!--grid view or list view-->
            <p class="d_inline_middle f_size_medium m_right_5">View as:</p>
            <div class="clearfix d_inline_middle">
              <button class="button_type_7 bg_scheme_color color_light tr_delay_hover r_corners mw_0 box_s_none bg_cs_hover f_left"><i class="fa fa-th m_left_0 m_right_0"></i></button>
              <button class="button_type_7 bg_light_color_1 color_dark tr_delay_hover r_corners mw_0 box_s_none bg_cs_hover f_left m_left_5"><i class="fa fa-th-list m_left_0 m_right_0"></i></button>
            </div>
          </div>--}}
        </div>
        <hr class="m_bottom_10 divider_type_3">

        <!--products-->
        <section class="products_container category_grid clearfix m_bottom_15">
          @foreach($products as $product)
            <div class="product_item hit w_xs_full">
              <figure class="r_corners photoframe animate_ftb type_2 t_align_c tr_all_hover shadow relative">
                <!--product preview-->
                <a href="{{url("product/view/".$product->slug)}}" class="d_block relative pp_wrap m_bottom_15">
                  @if($product->product_featured_stat == ProductFeaturedStat::Hot)
                    <span class="hot_stripe"><img src="{{url("assets/flatastic")}}/images/hot_product.png" alt=""></span>
                  @elseif($product->product_featured_stat == ProductFeaturedStat::Sale)
                    <span class="hot_stripe"><img src="{{url("assets/flatastic")}}/images/sale_product.png" alt=""></span>
                  @endif
                  <img src="{{url("assets/images/products/".$product->image)}}" class="tr_all_hover" alt="">
                </a>
                <figcaption>
                  <h5 class="m_bottom_10"><a href="#" class="color_dark">{{$product->name}}</a></h5>
                  <p class="scheme_color f_size_large m_bottom_15">$102.00</p>
                </figcaption>
              </figure>
            </div>
          @endforeach
        </section>
      </section>
      <!--right column-->
      <aside class="col-lg-3 col-md-3 col-sm-3">
        <!--widgets-->
        <figure class="widget shadow r_corners wrapper m_bottom_30">
          <figcaption>
            <h3 class="color_light">Filter</h3>
          </figcaption>
          <div class="widget_content">
            <!--filter form-->
            <form>
              <!--checkboxes-->
              <fieldset class="m_bottom_15">
                <legend class="default_t_color f_size_large m_bottom_15 clearfix full_width relative">
                  <b class="f_left">Brands</b>
                </legend>
                <input type="checkbox" name="" id="checkbox_1" class="d_none"><label for="checkbox_1">Chanel</label><br>
                <input type="checkbox" checked name="" id="checkbox_2" class="d_none"><label for="checkbox_2">Calvin Klein</label><br>
                <input type="checkbox" name="" id="checkbox_3" class="d_none"><label for="checkbox_3">Prada</label><br>
              </fieldset>
              <!--price-->
              <fieldset class="m_bottom_20">
                <legend class="default_t_color f_size_large m_bottom_15 clearfix full_width relative">
                  <b class="f_left">Price</b>
                </legend>
                <div id="price" class="m_bottom_10"></div>
                <div class="clearfix range_values">
                  <input class="f_left first_limit" readonly name="" type="text" value="$0">
                  <input class="f_right last_limit t_align_r" readonly name="" type="text" value="$250">
                </div>
              </fieldset>
              <!--size-->
              <fieldset class="m_bottom_15">
                <legend class="default_t_color f_size_large m_bottom_15 clearfix full_width relative">
                  <b class="f_left">Size</b>
                </legend>
                <input type="radio" name="size" id="radio_1" class="d_none"><label for="radio_1">S</label><br>
                <input type="radio" name="size" checked id="radio_2" class="d_none"><label for="radio_2">M</label><br>
                <input type="radio" name="size" id="radio_3" class="d_none"><label for="radio_3">L</label><br>
              </fieldset>
              <fieldset class="m_bottom_25">
                <legend class="default_t_color f_size_large m_bottom_15 clearfix full_width relative">
                  <b class="f_left">Weight</b>
                </legend>
                <div class="clearfix">
                  <input type="text" name="" class="r_corners f_left type_2">
                  <input type="text" name="" class="r_corners f_left type_2 m_left_10">
                </div>
              </fieldset>
              <button type="reset" class="color_dark bg_tr text_cs_hover tr_all_hover"><i class="fa fa-refresh lh_inherit m_right_10"></i>Reset</button>
            </form>
          </div>
        </figure>
      </aside>
    </div>
  </div>
</div>
<!--markup footer-->

@endsection