<?php use App\Models\Enums\MainCategory; ?>
<?php use App\Models\Enums\ProductDescType; ?>

@extends('template', [
  "breadcrumbs"=>[
    0=>MainCategory::$values[$product->main_category],
    1=>$product->category_name,
    2=>$product->name,
  ],
  'meta_keyword'=>$product->meta_keyword,
  'meta_desc'=>$product->meta_desc
])

@section('content')
  <script type="text/javascript">


  </script>

  <!--content-->
  <div class="page_content_offset">
    <div class="container">
      <div class="row clearfix">
        <section class="col-lg-9 col-md-9 col-sm-9 m_xs_bottom_30">
          <div class="row">
            <div class="col-md-5">
              <div class="photoframe type_2 shadow r_corners f_left f_sm_none d_xs_inline_b product_single_preview relative m_right_30 m_bottom_5 m_sm_bottom_20 m_xs_right_0 w_mxs_full">
                <span class="hot_stripe"><img src="{{url("assets/flatastic")}}/images/sale_product.png" alt=""></span>
                <div class="relative d_inline_b m_bottom_10 qv_preview d_xs_block">
                  <img id="zoom_image" src="{{url("assets/images/products/".$product->image)}}" class="tr_all_hover" alt="">
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
                    <td>
                      <a href="{{url("product/brand/".$product->brand_name)}}" class="color_dark">
                        {{ $product->brand_name }}
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>Availability:</td>
                    <td><span class="color_green">In stock</span> {{--20 item(s)--}}</td>
                  </tr>
                  @if(count($product->sizes) == 0)
                  <tr>
                    <td>Weight:</td>
                    <td>{{CommonHelper::formatWeight($product->weight_lb, $product->weight_kg)}}</td>
                  </tr>
                  @endif
                </table>
                <hr class="divider_type_3 m_bottom_10">
                <p class="m_bottom_10">
                  {{$product->desc_short}}
                </p>
                <hr class="divider_type_3 m_bottom_15">

                <table class="description_table type_2 m_bottom_15">
                  @if(count($product->sizes))
                    <tr>
                      <td class="v_align_t">Size:</td>
                      <td class="v_align_m">
                        <table class="size_table">
                          @foreach($product->sizes as $size)
                            <?php $checked = $size->size_id == array_first($product->sizes)->size_id ? "checked" : ""; ?>
                            <tr>
                              <td style="padding-right: 10px;">
                                <input type="radio" name="size" {{$checked}} id="size-{{$size->name}}" class="d_none" value="{{$size->size_id}}" onclick="selectSize()">
                                <label for="size-{{$size->name}}">
                                  {{$size->name}}
                                  <span class="f_size_small">({{CommonHelper::formatWeight($size->weight_lb, $size->weight_kg)}})</span>
                                </label>
                              </td>
                              <td style="padding-right: 10px;">
                                <s>${{$size->price}}</s>
                              </td>
                              <td>
                                ${{$size->discounted_price}}
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
                        <button class="bg_tr d_block f_left" data-direction="down" onclick="updateQuantity(this)">-</button>
                        <input type="text" name="quantity" id="quantity" value="1" class="f_left" >
                        <button class="bg_tr d_block f_left" data-direction="up" onclick="updateQuantity(this)">+</button>
                      </div>
                    </td>
                  </tr>
                  @if(count($product->sizes))
                    <tr>
                      <td class="v_align_m">Repack:</td>
                      <td class="v_align_m">
                        <input type="hidden" name="repack" id="repack">
                        <div class="custom_select f_size_medium relative d_inline_middle">
                          <?php $first_size_id = array_first($product->sizes)->size_id; ?>
                          <?php $first_size_repack = isset($product->repacks[$first_size_id]) ? array_first($product->repacks[$first_size_id])->name : "No repack"; ?>
                          <div class="select_title r_corners relative color_dark" id="repack_options_default">{{$first_size_repack}}</div>
                          <ul class="select_list d_none" id="repack_options"></ul>
                        </div>
                      </td>
                    </tr>
                  @endif
                </table>

                <div class="m_bottom_15">
                  @if(count($product->sizes) == 0)
                    @if($product->price != $product->discounted_price)
                      <s id='price-total' class="v_align_b f_size_ex_large">${{$product->price}}</s>
                    @endif
                    <span id="discounted-price-total" data-discounted-price="{{$product->discounted_price}}" data-price="{{$product->price}}"class="v_align_b f_size_big m_left_5 scheme_color fw_medium">
                      ${{$product->discounted_price}}
                    </span>
                  @else
                    <s id='price-total' class="v_align_b f_size_ex_large">${{array_first($product->sizes)->price}}</s>
                    <span id="discounted-price-total" class="v_align_b f_size_big m_left_5 scheme_color fw_medium">
                      ${{array_first($product->sizes)->discounted_price}}
                    </span>
                  @endif
                </div>
                <div class="d_ib_offset_0 m_bottom_20">
                  {{ csrf_field() }}
                  <button type="button" class="button_type_12 r_corners bg_scheme_color color_light tr_delay_hover d_inline_b f_size_large m_right_5" id="btn-add-to-cart">Add to Cart</button>
                  <button type="button" class="button_type_12 r_corners bg_color_blue color_light tr_delay_hover d_inline_b f_size_large" onclick="history.go(-1)">Back</button>
                </div>
              </div>
            </div>
          </div>
          <!--tabs-->
          <div class="tabs m_bottom_45">
            <!--tabs navigation-->
            <nav>
              <ul class="tabs_nav horizontal_list clearfix">
                @foreach($product->descs as $desc)
                  <li class="f_xs_none"><a href="#tab-desc{{$desc->desc_id}}" class="bg_light_color_1 color_dark tr_delay_hover r_corners d_block">{{ProductDescType::$values[$desc->type]}}</a></li>
                @endforeach
              </ul>
            </nav>
            <section class="tabs_content shadow r_corners">
              @foreach($product->descs as $desc)
              <div id="tab-desc{{$desc->desc_id}}">
                @if($desc->type == ProductDescType::Description || $desc->type == ProductDescType::Ingredient )
                  {!! nl2br($desc->value) !!}
                @elseif($desc->type == ProductDescType::Video)
                  <div class="iframe_video_wrap">
                    <iframe src="http://www.youtube.com/embed/{{$desc->value}}?wmode=transparent"></iframe>
                  </div>
                @endif
              </div>
              @endforeach
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
                </div>
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
                </div>
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
                </div>
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
                </div>
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
                </div>
              </figcaption>
            </figure>
          </div>
        </section>
        <aside class="col-lg-3 col-md-3 col-sm-3">
          <figure class="widget shadow r_corners wrapper m_bottom_30">
            <figcaption>
              <h3 class="color_light">Cart</h3>
            </figcaption>
            <div class="widget_content">
              <div id="div-cart">

              </div>

              <button type="button" id="btn-checkout" class="tr_delay_hover r_corners button_type_15 bg_scheme_color color_light" style="display:none">
                <i class="fa fa-shopping-cart lh_inherit m_right_10"></i>Checkout
              </button>
            </div>
          </figure>
        </aside>
      </div>

    </div>
  </div>
  <!--markup footer-->

@endsection

@section('script')
  <script src="{{url("assets/flatastic/js/cart.js")}}" type="text/javascript"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      refreshCartSidebar();

      $("#btn-add-to-cart").data('powertipjq', $('<p>Product has been added to cart</p>')).powerTip({
        placement: 's',
        manual: true,
        mouseOnToPopup: false
      }).click(function() {

        var quantity_txt = $("#quantity");
        if (validateQuantity(quantity_txt) == false) {
          return;
        }

        var data = {
          quantity: quantity_txt.val(),
          product_id: "{{$product->product_id}}",
          size_id: getSelectedSize(),
          option_id: getSelectedRepack(),
          _token: $("input[name='_token']").val()
        };

        $.ajax({
          type: "POST",
          url: "{{ url("add-to-cart") }}",
          data: data,
          success: function(response) {
            refreshCartSidebar();
            $('#btn-add-to-cart').powerTip('show');
            refreshCartButton();
          },
          error: function(  ) {
            popupError();
          }
        });
      });

      $("#btn-checkout").click(function () {
        redirect('{{url("checkout")}}');
      })
    });

    var repacks_json = '{!! json_encode($product->repacks) !!}';
    var repacks_object = JSON.parse(repacks_json);
    var sizes_json = '{!! json_encode($product->sizes) !!}';
    var sizes_object =  JSON.parse(sizes_json);

    function refreshCartSidebar() {
      $.ajax({
        type: "GET",
        url: "{{ url("get-cart") }}",
        success: function(response) {
          var products = response;
          var html = "";
          if (products.length === 0) {
            $("#div-cart").text("Your cart is empty");
            $("#btn-checkout").hide();
            return;
          }
          for (var key in products) {
            if (products.hasOwnProperty(key)) {
              var product = products[key];
              //console.log(JSON.stringify(product));

              html += '<div class="clearfix m_bottom_15">' +
                '<img src="{{url("assets/images/products")}}/'+product.image+'" alt="" style="max-width: 80px" class="f_left m_right_15 m_sm_bottom_10 f_sm_none f_xs_left m_xs_bottom_0">' +
                ' <a href="{{url("product/view")}}/'+product.slug+'" class="color_dark">'+product.name+'</a>';
              if (product.size_id > 0) {
                html += '<br>Size: '+product.size_name;
              }
              if (product.option_id > 0) {
                html += '<br>Repack: '+product.option_name;
              }
              html += '<br>'+product.quantity + ' x $' + toTwoDecimal(product.discounted_price);
              html += '<p class="scheme_color">$'+toTwoDecimal(product.subtotal)+
                ' <span class="link color_dark" onclick="removeFromCart('+product.product_id+', ' +  product.size_id+', this)"><i class="fa fa-times f_size_medium"></i> Remove' +
                '</span></p></div>'
            }
          }
          $("#div-cart").html(html);
          $("#btn-checkout").show();
        },
        error: function(  ) {
          popupError();
        }
      });
    }

    function selectSize() {
      var size = getSelectedSize();
      var repacks = repacks_object[size];
      //console.log(JSON.stringify(repack_options));
      if (typeof repacks === 'undefined' || repacks.length === 0) {
        $("#repack_options_default").text("No Repack")
        $("#repack_options").html("");
      } else {
        var html = "<li class='tr_delay_hover' onclick='selectRepack(0)'>No Repack</li>";
        for (var key in repacks) {
          if (repacks.hasOwnProperty(key)) {
            html += "<li class='tr_delay_hover' onclick='selectRepack("+repacks[key].option_id+")'>"+repacks[key].name+" - $"+repacks[key].price+"</li>";
          }
        }
        $("#repack_options_default").text("Select Repack")
        $("#repack_options").html(html);
        //console.log(html);
      }

      updatePrice();
    }

    function updateQuantity(element) {
      var quantity_txt = $(element).parent().children('input[type="text"]');
      if (validateQuantity(quantity_txt) == false) {
        return;
      }

      var data = $(element).data('direction');
      var val = quantity_txt.val();
      if(data == "up"){
        val++;
        quantity_txt.val(val);
      }else if(data == "down"){
        if(val == 1) return;
        val--;
        quantity_txt.val(val);
      }

      updatePrice();
    }

    function selectRepack(option_id) {
      //console.log(option_id);
      $("#repack").val(option_id);
      updatePrice();
    }

    function removeFromCart(product_id, size_id, ele) {
      var data = {
        product_id: product_id,
        size_id: size_id,
        _token: $("input[name='_token']").val(),
      };

      $.ajax({
        type: "POST",
        url: "{{ url("remove-from-cart") }}",
        data: data,
        success: function(response) {
          $(ele).closest("div").remove();
          refreshCartButton();
        },
        error: function(  ) {
          popupError();
        }
      });
    }

    function updatePrice() {
      var productHasSizes = getObjectSize(sizes_object) > 0;
      //console.log('productHasSizes=' + productHasSizes);
      var quantity = $("#quantity").val();

      var discounted_price = 0;
      var price = 0;
      var price_total = 0, discounted_price_total = 0;
      if (! productHasSizes) {
        discounted_price = $("#discounted-price-total").attr("data-discounted-price");
        discounted_price = parseFloat(discounted_price);
        price = parseFloat($("#discounted-price-total").attr("data-price"));
        //console.log('quantity='+quantity+' discounted_price='+discounted_price + ' price'+price);
        price_total = price * quantity;
        discounted_price_total = discounted_price * quantity;
      } else {
        var size = getSelectedSize();
        var repack = getSelectedRepack();
        //console.log('quantity='+quantity+' selected_size='+size + ' selected_repack='+repack);

        var sizes = sizes_object[size];
        var price = sizes.price;
        var discounted_price = sizes.discounted_price;

        var repack_options = repacks_object[size];
        var repack_price = 0;
        for (var key in repack_options) {
          if (repack_options.hasOwnProperty(key)) {
            if (repack_options[key].option_id == repack) {
              repack_price = repack_options[key].price;
            }
          }
        }
        //console.log('quantity='+quantity+' discounted_price='+discounted_price+' repack_price='+repack_price);
        price_total = price * quantity + repack_price * quantity;
        discounted_price_total = discounted_price * quantity + repack_price * quantity;
      }

      $("#price-total").text("$"+toTwoDecimal(price_total));
      $("#discounted-price-total").text("$"+toTwoDecimal(discounted_price_total));
    }

    function getSelectedSize() {
      return $('input[name=size]:checked').val();
    }

    function getSelectedRepack() {
      return $("#repack").val()
    }
  </script>
@endsection