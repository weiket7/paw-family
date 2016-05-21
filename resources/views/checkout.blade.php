@extends('template')

@section('content')

  <div class="page_content_offset">
    <div class="container">
      <div class  ="row clearfix">
        <section class="col-lg-12 col-md-12 col-sm-12 m_xs_bottom_30">
          <h2 class="tt_uppercase color_dark m_bottom_20">Cart</h2>
          @if(count($products) == 0)
            <div class="bs_inner_offsets bg_light_color_3 shadow r_corners m_bottom_30">
              Your cart is empty<br>
            </div>
          @else
            {{ csrf_field() }}

            <table class="table_type_4 responsive_table full_width r_corners wraper shadow t_align_l t_xs_align_c m_bottom_30">
              <thead>
              <tr class="f_size_large">
                <th>Product </th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
              </tr>
              </thead>
              <tbody>
              <?php $gross_total = 0; ?>

              @foreach($products as $p)
                <tr>
                  <td>
                    <img src="{{url('assets/images/products/'.$p->image)}}" alt="" class="m_md_bottom_5 d_xs_block d_xs_centered" style="max-height: 100px">
                    <a href="">{{$p->name}}</a>
                  </td>
                  <td>
                    @if($p->price > $p->discounted_price)
                      <s>${{$p->price}}</s>
                    @endif
                    <span class="scheme_color fw_medium" id="product{{$p->product_id}}-discounted-price" data-discounted-price="{{$p->discounted_price}}">${{$p->discounted_price}}</span>
                  </td>
                  <td>
                    <div class="clearfix quantity r_corners d_inline_middle f_size_medium color_dark m_bottom_10">
                      <button class="bg_tr d_block f_left" data-direction="down" onclick="updateQuantity(this)">-</button>
                      <input type="text" id="product{{$p->product_id}}-quantity" value="{{$p->quantity}}" class="f_left">
                      <button class="bg_tr d_block f_left" data-direction="up" onclick="updateQuantity(this)">+</button>
                    </div>
                    <div>
                      <a href="#" class="color_dark" onclick="updateCart('{{$p->product_id}}')">
                        <i class="fa fa-check f_size_medium m_right_5"></i>Update
                      </a><br>
                      <a href="#" class="color_dark" onclick="removeFromCart('{{$p->product_id}}')">
                        <i class="fa fa-times f_size_medium m_right_5"></i>Remove
                      </a>
                    </div>
                  </td>
                  <td>
                    <p id='product{{$p->product_id}}-subtotal' class="f_size_large fw_medium scheme_color">${{CommonHelper::formatNumber($p->subtotal)}}</p>
                  </td>
                </tr>
                <?php $gross_total += $p->subtotal; ?>
              @endforeach

              <tr>
                <td colspan="3" class="v_align_m d_ib_offset_large t_xs_align_l" style="padding: 10px 20px">
                  <!--coupon-->
                  <form class="d_ib_offset_0 d_inline_middle half_column d_xs_block w_xs_full m_xs_bottom_5">
                    <input type="text" placeholder="Enter your coupon code" name="" class="r_corners f_size_medium">
                    <button class="button_type_4 r_corners bg_light_color_2 m_left_5 mw_0 tr_all_hover color_dark">Save</button>
                  </form>
                  <p class="fw_medium f_size_large t_align_r  p_xs_hr_0 d_inline_middle half_column d_ib_offset_normal d_xs_block w_xs_full t_xs_align_c">Promo Discount:</p>
                </td>
                <td colspan="1" class="v_align_m">
                  <p class="fw_medium f_size_large m_xs_bottom_10">$101.05</p>
                </td>
              </tr>
              <tr>
                <td colspan="3">
                  <p class="fw_medium f_size_large t_align_r t_xs_align_c">Gross Total:</p>
                </td>
                <td colspan="1">
                  <p class="fw_medium f_size_large color_dark">${{$gross_total}}</p>
                </td>
              </tr>
              <tr>
                <td colspan="3" class="v_align_m d_ib_offset_large t_xs_align_l">
                  <!--coupon-->
                  <form class="d_ib_offset_0 d_inline_middle half_column d_xs_block w_xs_full m_xs_bottom_5">
                    <input type="text" placeholder="Enter your coupon code" name="" class="r_corners f_size_medium">
                    <button class="button_type_4 r_corners bg_light_color_2 m_left_5 mw_0 tr_all_hover color_dark">Save</button>
                  </form>
                  <p class="fw_medium f_size_large t_align_r scheme_color p_xs_hr_0 d_inline_middle half_column d_ib_offset_normal d_xs_block w_xs_full t_xs_align_c">Total:</p>
                </td>
                <td colspan="1" class="v_align_m">
                  <p class="fw_medium f_size_large scheme_color m_xs_bottom_10">$101.05</p>
                </td>
              </tr>
              </tbody>
            </table>

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
                  <form>
                    <ul>
                      <li class="clearfix m_bottom_15">
                        <div class="half_column type_2 f_left">
                          <label for="username" class="m_bottom_5 d_inline_b">Email</label>
                          <input type="text" id="username" name="" class="r_corners full_width m_bottom_5">
                        </div>
                        <div class="half_column type_2 f_left">
                          <label for="pass" class="m_bottom_5 d_inline_b">Password</label>
                          <input type="password" id="pass" name="" class="r_corners full_width m_bottom_5">
                        </div>
                      </li>
                      <li class="clearfix m_bottom_10">
                        <div class="half_column type_2 f_left">
                          <button class="button_type_4 r_corners bg_scheme_color color_light tr_all_hover">Log In</button>
                        </div>
                        <div class="half_column type_2 f_left">
                          <a href="#" class="color_dark f_size_medium">Forgot your password?</a>
                        </div>
                      </li>
                    </ul>
                  </form>
                </div>
                <div id="tab-2">
                  <form>
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-6 m_xs_bottom_30">
                        <ul>
                          <li class="m_bottom_15">
                            <label for="email" class="d_inline_b m_bottom_5 required" tabindex="1">Name</label>
                            {{Form::text("name", '', ['id'=>'name', 'class'=>'r_corners full_width m_bottom_5', 'tabindex'=>1])}}
                          </li>
                          <li class="m_bottom_15">
                            <label for="email" class="d_inline_b m_bottom_5 required" tabindex="1">Email</label>
                            {{Form::text("email", '', ['id'=>'email', 'class'=>'r_corners full_width m_bottom_5', 'tabindex'=>2])}}
                          </li>
                          <li class="m_bottom_15">
                            <label for="password" class="d_inline_b m_bottom_5 required">Password</label>
                            <input type="password" name="password" autocomplete="off" class="r_corners full_width" tabindex="6">
                          </li>
                          <li class="m_bottom_25">
                            <label for="password_confirmation" class="d_inline_b m_bottom_5 required">Confirm Password</label>
                            <input type="password" id="password_confirmation" autocomplete="off" name="password_confirmation" class="r_corners full_width" tabindex="7">
                          </li>
                          <li><button type="submit" class="button_type_4 r_corners bg_scheme_color color_light tr_all_hover" tabindex="3">Save</button></li>
                        </ul>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 m_xs_bottom_30">
                        <ul>
                          <li class="m_bottom_15">
                            <label for="email" class="d_inline_b m_bottom_5 required" tabindex="1">Mobile</label>
                            {{Form::text("mobile", '', ['id'=>'mobile', 'class'=>'r_corners full_width m_bottom_5', 'tabindex'=>2])}}
                          </li>
                          <li class="m_bottom_15">
                            <label for="email" class="d_inline_b m_bottom_5 required" tabindex="1">Address</label>
                            {{Form::text("address", '', ['id'=>'address', 'class'=>'r_corners full_width m_bottom_5', 'tabindex'=>2])}}
                          </li>
                          <li class="m_bottom_15">
                            <label for="email" class="d_inline_b m_bottom_5 required" tabindex="1">Postal</label>
                            {{Form::text("postal", '', ['id'=>'postal', 'class'=>'r_corners full_width m_bottom_5', 'tabindex'=>2])}}
                          </li>
                        </ul>
                      </div>
                    </div>
                  </form>
                </div>
              </section>
            </div>

            <h2 class="tt_uppercase color_dark m_bottom_30">Delivery Address</h2>
            <div class="bs_inner_offsets bg_light_color_3 shadow r_corners m_bottom_45">
              <figure class="block_select clearfix relative m_bottom_15">
                <input type="radio" name="radio_1" class="d_none">
                <figcaption>
                  <h5 class="color_dark fw_medium m_bottom_15 m_sm_bottom_5">Blk 134, Bedok Reservoir Rd, #08-1227</h5>
                  <p>Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Donec sit amet eros. Lorem ipsum dolor sit amet, consecvtetuer. </p>
                </figcaption>
              </figure>
              <hr class="m_bottom_20">
              <figure class="block_select clearfix relative">
                <input type="radio" name="radio_1" class="d_none">
                <figcaption>
                  <h5 class="color_dark fw_medium m_bottom_15 m_sm_bottom_5">Another address</h5>
                  <p>
                    {{Form::text("mobile", '', ['id'=>'mobile', 'class'=>'r_corners full_width m_bottom_5', 'tabindex'=>2])}}
                  </p>
                </figcaption>
              </figure>
              <hr class="m_bottom_20">
              <figure class="block_select clearfix relative">
                <input type="radio" name="radio_1" class="d_none">
                <figcaption>
                  <h5 class="color_dark fw_medium m_bottom_15 m_sm_bottom_5">Self collect at Upper Paya Lebar, between 11am-2pm, Tues to Thurs</h5>
                </figcaption>
              </figure>
            </div>

            <h2 class="tt_uppercase color_dark m_bottom_30">Delivery Time</h2>
            <div class="bs_inner_offsets bg_light_color_3 shadow r_corners m_bottom_45">
              <figure class="block_select clearfix relative">
                <input type="radio" name="radio_1" class="d_none">
                <figcaption>
                  <h5 class="color_dark fw_medium m_bottom_15 m_sm_bottom_5">Any time</h5>
                </figcaption>
              </figure>
              <hr class="m_bottom_20">
              <figure class="block_select clearfix relative">
                <input type="radio" name="radio_1" class="d_none">
                <figcaption>
                  <h5 class="color_dark fw_medium m_bottom_15 m_sm_bottom_5">1pm - 4.30pm</h5>
                </figcaption>
              </figure>
              <hr class="m_bottom_20">
              <figure class="block_select clearfix relative">
                <input type="radio" name="radio_1" class="d_none">
                <figcaption>
                  <h5 class="color_dark fw_medium m_bottom_15 m_sm_bottom_5">4.30pm - 8pm</h5>
                </figcaption>
              </figure>
            </div>

            <h2 class="tt_uppercase color_dark m_bottom_30">Payment</h2>
            <div class="bs_inner_offsets bg_light_color_3 shadow r_corners m_bottom_45">
              <figure class="block_select clearfix relative m_bottom_15">
                <input type="radio" name="radio_2" class="d_none">
                <figcaption>
                  <h5 class="color_dark fw_medium m_bottom_15 m_sm_bottom_5">Bank transfer through internet or ATM</h5>
                  <p id="p-cash" style="display:none">Lorem ipsum dolor sit amet, consecvtetuer adipiscing elit. Mauris fermentum dictum magna.
                    Sed laoreet aliquam leo. Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit.</p>{{--</div>--}}
                </figcaption>
              </figure>
              <hr class="m_bottom_20">
              <figure class="block_select clearfix relative">
                <input type="radio" name="radio_2" class="d_none">
                <figcaption>
                  <h5 class="color_dark fw_medium m_bottom_15 m_sm_bottom_5">Cash on delivery</h5>
                  <p id="p-cash" style="display:none">Lorem ipsum dolor sit amet, consecvtetuer adipiscing elit. Mauris fermentum dictum magna.
                    Sed laoreet aliquam leo. Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit.</p>
                </figcaption>
              </figure>
              <hr class="m_bottom_20">
              <figure class="block_select clearfix relative">
                <input type="radio" name="radio_2" class="d_none">
                <figcaption>
                  <h5 class="color_dark fw_medium m_bottom_15 m_sm_bottom_5">Cheque</h5>
                  <p id="p-cheque" style="display:none">Lorem ipsum dolor sit amet, consecvtetuer adipiscing elit. Mauris fermentum dictum magna.
                    Sed laoreet aliquam leo. Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit.</p>
                </figcaption>
              </figure>
              <hr class="m_bottom_20">
              <figure class="block_select clearfix relative">
                <input type="radio" name="radio_2" class="d_none">
                <figcaption>
                  <h5 class="color_dark fw_medium m_bottom_15 m_sm_bottom_5">Paypal</h5>
                  <p id="p-paypal" style="display:none">Lorem ipsum dolor sit amet, consecvtetuer adipiscing elit. Mauris fermentum dictum magna.
                    Sed laoreet aliquam leo. Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit.</p>
                </figcaption>
              </figure>
            </div>

            <h2 class="tt_uppercase color_dark m_bottom_30">Remarks</h2>
            <table class="table_type_5 full_width r_corners wraper shadow t_align_l m_bottom_30">
              <tr>
                <td>
                  <textarea id="notes" class="r_corners notes full_width"></textarea>
                </td>
              </tr>
              <tr>
                <td>
                  <input type="checkbox" class="d_none" name="checkbox_9" id="checkbox_9">
                  <label for="checkbox_9" style="margin-bottom: 15px">Can leave products in front of the door (A picture of the items placed outside as evidence of delivery will be sent)
                  </label>
                </td>
              </tr>
            </table>

            <button class="button_type_6 bg_scheme_color f_size_large r_corners tr_all_hover color_light m_bottom_20">Confirm Purchase</button>
          @endif
        </section>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    function updateQuantity(element) {
      var data = $(element).data('direction'),
        i = $(element).parent().children('input[type="text"]'),
        val = i.val();
      if(data == "up"){
        val++;
        i.val(val);
      }else if(data == "down"){
        if(val == 1) return;
        val--;
        i.val(val);
      }
    }
    
    function updateTotals() {

    }

    function updateCart(product_id) {
      var data = {
        quantity: getQuantity(product_id),
        product_id: product_id,
        _token: $("input[name='_token']").val(),
      };

      //console.log(data);

      $.ajax({
        type: "POST",
        url: "{{ url("update-cart") }}",
        data: data,
        success: function(response) {

        },
        error: function(  ) {
          alert("An error has occurred, please contact admin@pawfamily.sg");
        }
      });

      updateSubtotal(product_id);
      updateTotals();
    }

    function getQuantity(product_id) {
      var quantity = parseFloat($("#product"+product_id + "-quantity").val());
      return quantity;
    }

    function updateSubtotal(product_id) {
      var price = parseFloat($("#product"+product_id+"-discounted-price").attr('data-discounted-price'));
      var quantity = getQuantity(product_id);
      var subtotal = price * quantity;
      console.log('price='+price + ' quantity='+quantity + ' subtotal='+subtotal);
      $("#product"+product_id+"-subtotal").text("$"+toTwoDecimal(subtotal));
    }

    function removeFromCart(product_id) {
      var data = {
        product_id: product_id,
        size_id: 0, //TODO
        _token: $("input[name='_token']").val(),
      };

      $.ajax({
        type: "POST",
        url: "{{ url("remove-from-cart") }}",
        data: data,
        success: function(response) {
          $("#product"+product_id+'-discounted-price').closest("tr").remove();
        },
        error: function(  ) {
          alert("An error has occurred, please contact admin@pawfamily.sg");
        }
      });
    }
  </script>
@endsection