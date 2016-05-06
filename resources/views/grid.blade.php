<?php use App\Models\Enums\FeaturedStat; ?>
<?php use App\Models\Enums\MainCategory; ?>

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
                  @if($product->featured_stat == FeaturedStat::Hot)
                    <span class="hot_stripe"><img src="{{url("assets/flatastic")}}/images/hot_product.png" alt=""></span>
                  @elseif($product->featured_stat == FeaturedStat::Sale)
                    <span class="hot_stripe"><img src="{{url("assets/flatastic")}}/images/sale_product.png" alt=""></span>
                  @endif
                  <img src="{{url("assets/images/products/".$product->image)}}" class="tr_all_hover" alt="">
                </a>
                <figcaption>
                  <h5 class="m_bottom_10"><a href="#" class="color_dark">{{$product->name}}</a></h5>
                  <p class="scheme_color f_size_large m_bottom_15">${{$product->price}}</p>
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
            <h3 class="color_light">Brands</h3>
          </figcaption>
          <div class="widget_content">
            <!--filter form-->
            <form>
              <fieldset class="m_bottom_10">
                @foreach($brands as $brand_id => $name)
                  <?php $checked = isset($selected_brand_ids) && in_array($brand_id, $selected_brand_ids) ? "checked" : ""; ?>
                  <input type="checkbox" name="brand" id="checkbox{{$brand_id}}" value="{{$name}}" {{$checked}} class="d_none" >
                  <label for="checkbox{{$brand_id}}">{{ $name }}</label><br>
                @endforeach
              </fieldset>
              <button type="reset" class="color_dark bg_tr text_cs_hover tr_all_hover"><i class="fa fa-refresh lh_inherit m_right_10"></i>Reset</button>
            </form>
          </div>
        </figure>
        <figure class="widget shadow r_corners wrapper m_bottom_30">
          <figcaption>
            <h3 class="color_light">Categories</h3>
          </figcaption>
          <div class="widget_content">
            <!--Categories list-->
            <ul class="categories_list">
              @foreach($categories as $main_category => $categories)
                <?php $active = $current_main_category == MainCategory::$values[$main_category]; ?>
                <?php $main_category_class = $active ? "active" : ""; ?>
                <?php $main_category_color = $active ? "scheme_color" : "color_dark"; ?>
                <li class="{{$main_category_class}}">
                  <a href="#" class="f_size_large {{$main_category_color}} d_block relative">
                    <b>{{MainCategory::$values[$main_category]}}</b>
                    <span class="bg_light_color_1 r_corners f_right color_dark talign_c"></span>
                  </a>
                  <?php $category_class = $active ? "" : "d_none"; ?>
                  <ul class="{{$category_class}}">
                    @foreach($categories as $category)
                      <li><a href="#" class="color_dark d_block">{{$category->name}}</a></li>
                    @endforeach
                  </ul>
                </li>
              @endforeach
            </ul>
          </div>
        </figure>
      </aside>
    </div>
  </div>
</div>