<?php use App\Models\Enums\DeliveryChoice; ?>
<?php use App\Models\Enums\DeliveryTime; ?>
<?php use App\Models\Enums\PaymentType; ?>

@extends('template')

@section('content')
  @if(Session::has('login'))
    <div class="container">
      <div class="alert_box r_corners color_green success">
        <i class="fa fa-smile-o"></i><p>Welcome {{$customer->name}}! </p>
      </div>
    </div>
  @endif

  <div class="page_content_offset">
    <div class="container">
      <div class="row clearfix">
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
                    <div class="row">
                      <div class="col-md-3">
                        <a href="{{url("product/view/".$p->slug)}}"><img src="{{url('assets/images/products/'.$p->image)}}" alt="" class="m_md_bottom_5 d_xs_block d_xs_centered" style="max-height: 100px"></a>
                      </div>
                      <div class="col-md-9">
                        <a href="{{url("product/view/".$p->slug)}}">{{$p->name}}</a>
                        @if($p->size_id > 0)
                          <br>Size: {{$p->size_name}}
                        @endif
                        @if($p->option_id > 0)
                          <br>Repack: {{$p->option_name}} - ${{CommonHelper::formatNumber($p->option_price)}}
                        @endif
                      </div>
                    </div>
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
                      <span class="link color_dark" onclick="updateCart('{{$p->product_id}}')">
                        <i class="fa fa-check f_size_medium m_right_5"></i>Update
                      </span><br>
                      <span class="link color_dark" onclick="removeFromCart('{{$p->product_id}}')">
                        <i class="fa fa-times f_size_medium m_right_5"></i>Remove
                      </span>
                    </div>
                  </td>
                  <td>
                    <p id='product{{$p->product_id}}-subtotal' class="subtotal f_size_large fw_medium scheme_color">${{CommonHelper::formatNumber($p->subtotal)}}</p>
                  </td>
                </tr>
                <?php $gross_total += $p->subtotal; ?>
              @endforeach

              <tr>
                <td colspan="3" class="v_align_m">
                  <!--coupon-->
                  <p class="f_size_large t_align_r">
                    <input type="text" placeholder="Promo Code" name="" class="r_corners f_size_medium">
                    <button class="button_type_4 r_corners bg_light_color_2 m_left_5 mw_0 tr_all_hover color_dark" style="margin-right: 20px">Save</button>
                    <span class="fw_medium d_inline_middle">Promo Discount: </span>
                  </p>
                </td>
                <td colspan="1" class="v_align_m">
                  <?php $promo_total = 0; ?>
                  <?php $total = $gross_total - 0; ?>
                  <p class="fw_medium f_size_large m_xs_bottom_10">${{CommonHelper::formatNumber($promo_total)}}</p>
                </td>
              </tr>
              <tr>
                <td colspan="3" class="v_align_m">
                  <p class="fw_medium f_size_large t_align_r t_xs_align_c scheme_color">Total:</p>
                </td>
                <td colspan="1" class="v_align_m">
                  <p class="fw_medium f_size_large scheme_color m_xs_bottom_10" id="p-total">${{CommonHelper::formatNumber($total)}}</p>
                </td>
              </tr>
              </tbody>
            </table>

            @if(! auth()->check())
              <div class="alert_box r_corners info m_bottom_10">
                <i class="fa fa-info-circle"></i><p>Please login or register to proceed</p>
              </div>

              <div class="tabs m_bottom_45">
                <!--tabs navigation-->
                <nav>
                  <ul class="tabs_nav horizontal_list clearfix">
                    <li><a href="#tab-login" class="bg_light_color_1 color_dark tr_delay_hover r_corners d_block">Login</a></li>
                    <li><a href="#tab-register" class="bg_light_color_1 color_dark tr_delay_hover r_corners d_block">Register</a></li>
                  </ul>
                </nav>
                <section class="tabs_content shadow r_corners">
                  <div id="tab-login">
                    <form method="post" action="login">
                      {{csrf_field()}}

                      @if ($errors->login->has())
                        <div class="alert_box r_corners error m_bottom_10">
                          <i class="fa fa-exclamation"></i>
                          <p>
                            @foreach ($errors->login->all() as $error)
                              {{ $error }}<br>
                            @endforeach
                          </p>
                        </div>
                      @endif

                      <input type="hidden" name="referrer" value="checkout">
                      <ul>
                        <li class="clearfix m_bottom_15">
                          <div class="half_column type_2 f_left">
                            <label for="username" class="m_bottom_5 d_inline_b">Email</label>
                            <input type="text" name="email" class="r_corners full_width m_bottom_5">
                          </div>
                          <div class="half_column type_2 f_left">
                            <label for="pass" class="m_bottom_5 d_inline_b">Password</label>
                            <input type="password" name="password" class="r_corners full_width m_bottom_5">
                          </div>
                        </li>
                        <li class="clearfix m_bottom_10">
                          <div class="half_column type_2 f_left">
                            <button type="submit" class="button_type_4 r_corners bg_scheme_color color_light tr_all_hover">Log In</button>
                          </div>
                          <div class="half_column type_2 f_left">
                            <a href="#" class="color_dark f_size_medium">Forgot your password?</a>
                          </div>
                        </li>
                      </ul>
                    </form>
                  </div>
                  <div id="tab-register">
                    <form method="post" action="register">
                      {{csrf_field()}}
                      <input type="hidden" name="referrer" value="checkout">
                      @include('register-form')
                    </form>
                  </div>
                </section>
              </div>

              <h2 class="tt_uppercase color_dark m_bottom_15 checkout-header-disabled">Delivery Address</h2>
              <h2 class="tt_uppercase color_dark m_bottom_15 checkout-header-disabled">Delivery Time</h2>
              <h2 class="tt_uppercase color_dark m_bottom_15 checkout-header-disabled">Payment Type</h2>
              <h2 class="tt_uppercase color_dark m_bottom_15 checkout-header-disabled">Remarks</h2>
            @else

              @if ($errors->checkout->has())
                <div class="alert_box r_corners error m_bottom_20">
                  <i class="fa fa-exclamation"></i>
                  <p>
                    @foreach ($errors->checkout->all() as $error)
                      {{ $error }}<br>
                    @endforeach
                  </p>
                </div>
              @endif

              <form method="post" action="">
                {{ csrf_field() }}
                <h2 class="tt_uppercase color_dark m_bottom_15">
                  Delivery Address
                  @if($errors->has('delivery_choice')) <span class="error">(Required)</span> @endif
                </h2>
                <div class="bs_inner_offsets bg_light_color_3 shadow r_corners m_bottom_45">
                  <figure class="block_select clearfix relative m_bottom_15">
                    {{Form::radio("delivery_choice", DeliveryChoice::CurrentAddress, '', ['class'=>'d_none'])}}
                    <figcaption>
                      <h5 class="color_dark fw_medium m_bottom_15 m_sm_bottom_5">{{$customer->address}}</h5>
                    </figcaption>
                  </figure>
                  <hr class="m_bottom_20">
                  <figure class="block_select clearfix relative">
                    {{Form::radio("delivery_choice", DeliveryChoice::OtherAddress, '', ['class'=>'d_none'])}}
                    <figcaption>
                      <h5 class="color_dark fw_medium m_bottom_15 m_sm_bottom_5">
                        Other address
                        @if($errors->has('address_other')) <span class="error">(Required)</span> @endif
                      </h5>
                      <p>
                        {{Form::text("address_other", '', ['id'=>'address_other', 'class'=>'r_corners full_width m_bottom_5', 'tabindex'=>2])}}
                      </p>
                    </figcaption>
                  </figure>
                  <hr class="m_bottom_20">
                  <figure class="block_select clearfix relative">
                    {{Form::radio("delivery_choice", DeliveryChoice::SelfCollect, '', ['class'=>'d_none'])}}
                    <figcaption>
                      <h5 class="color_dark fw_medium m_bottom_15 m_sm_bottom_5">Self collect at Upper Paya Lebar, between 11am-2pm, Tues to Thurs</h5>
                    </figcaption>
                  </figure>
                </div>

                <h2 class="tt_uppercase color_dark m_bottom_15">
                  Delivery Time
                  @if($errors->has('delivery_time')) <span class="error">(Required)</span> @endif
                </h2>

                <div class="bs_inner_offsets bg_light_color_3 shadow r_corners m_bottom_45">
                  <figure class="block_select clearfix relative">
                    {{Form::radio("delivery_time", DeliveryTime::AnyTime, '', ['class'=>'d_none'])}}
                    <figcaption>
                      <h5 class="color_dark fw_medium m_bottom_15 m_sm_bottom_5">Any time</h5>
                    </figcaption>
                  </figure>
                  <hr class="m_bottom_20">
                  <figure class="block_select clearfix relative">
                    {{Form::radio("delivery_time", DeliveryTime::Oneto430, '', ['class'=>'d_none'])}}
                    <figcaption>
                      <h5 class="color_dark fw_medium m_bottom_15 m_sm_bottom_5">1pm - 4.30pm</h5>
                    </figcaption>
                  </figure>
                  <hr class="m_bottom_20">
                  <figure class="block_select clearfix relative">
                    {{Form::radio("delivery_time", DeliveryTime::Four30to8, '', ['class'=>'d_none'])}}
                    <figcaption>
                      <h5 class="color_dark fw_medium m_bottom_15 m_sm_bottom_5">4.30pm - 8pm</h5>
                    </figcaption>
                  </figure>
                </div>

                <h2 class="tt_uppercase color_dark m_bottom_15">
                  Payment Type
                  @if($errors->has('payment_type')) <span class="error">(Required)</span> @endif
                </h2>
                <div class="bs_inner_offsets bg_light_color_3 shadow r_corners m_bottom_45">
                  <figure class="block_select clearfix relative m_bottom_15" onclick="selectPayment('{{PaymentType::Bank}}')">
                    {{Form::radio("payment_type", PaymentType::Bank, '', ['data-payment'=>PaymentType::Bank, 'class'=>'d_none'])}}
                    <figcaption>
                      <h5 class="color_dark fw_medium m_bottom_15 m_sm_bottom_5">Bank transfer through internet or ATM</h5>
                      <p id="payment-{{PaymentType::Bank}}" style="display:none">
                        DBS Bank - Saving Plus, 017-0-098022<br>
                        Bank Code:7171 | Branch Code:	017<br>
                        <br>
                        OCBC Corporate Current Account, 815529-001<br>
                        Bank Code: 7339 | Branch Code:	557
                      </p>
                    </figcaption>
                  </figure>
                  <hr class="m_bottom_20">
                  <figure class="block_select clearfix relative" onclick="selectPayment('{{PaymentType::Cash}}')">
                    {{Form::radio("payment_type", PaymentType::Cash, '', ['data-payment'=>PaymentType::Cash, 'class'=>'d_none'])}}
                    <figcaption>
                      <h5 class="color_dark fw_medium m_bottom_15 m_sm_bottom_5">Cash on delivery</h5>
                      <p id="payment-{{PaymentType::Cash}}" style="display:none">Please provide exact cash amount which will be appreciated</p>
                    </figcaption>
                  </figure>
                  <hr class="m_bottom_20">
                  <figure class="block_select clearfix relative" onclick="selectPayment('{{PaymentType::Cheque}}')">
                    {{Form::radio("payment_type", PaymentType::Cheque, '', ['data-payment'=>PaymentType::Cheque, 'class'=>'d_none'])}}
                    <figcaption>
                      <h5 class="color_dark fw_medium m_bottom_15 m_sm_bottom_5">Cheque</h5>
                      <p id="payment-{{PaymentType::Cheque}}" style="display:none">
                        Please make cheque payable to: PAW FAMILY and cross 'Bearer'
                      </p>
                    </figcaption>
                  </figure>
                  <hr class="m_bottom_20">
                  <figure class="block_select clearfix relative">
                    {{Form::radio("payment_type", PaymentType::Paypal, '', ['data-payment'=>PaymentType::Paypal, 'class'=>'d_none'])}}
                    <figcaption>
                      <h5 class="color_dark fw_medium m_bottom_15 m_sm_bottom_5">Paypal</h5>
                    </figcaption>
                  </figure>
                </div>

                <h2 class="tt_uppercase color_dark m_bottom_15">Remarks</h2>
                <table class="table_type_5 full_width r_corners wraper shadow t_align_l m_bottom_30">
                  <tr>
                    <td>
                      {{Form::textarea('customer_remark', '', ['class'=>'r_corners notes full_width'])}}
                    </td>
                  </tr>
                  <tr>
                    <td>
                      {{Form::checkbox("leave_outside_door", 'Y', '', ['id'=>'leave_outside_door', 'class'=>'d_none'])}}
                      <label for="leave_outside_door" class="m_bottom_15">Can leave products in front of the door (A picture of the items placed outside as evidence of delivery will be sent)
                      </label><br>
                      {{Form::checkbox("gift_wrap", 'Y', '', ['id'=>'gift_wrap', 'class'=>'d_none'])}}
                      <label for="gift_wrap" class="m_bottom_15">As the items will be a gift, please wrap nicely
                      </label>
                    </td>
                  </tr>
                </table>

                <button type="submit" class="button_type_6 bg_scheme_color f_size_large r_corners tr_all_hover color_light m_bottom_20">Confirm Purchase</button>
              </form>
            @endif
          @endif
        </section>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    $(document).ready(function() {
      var payment_type = $("input[name='payment_type']:checked").val();
      if (isDefined(payment_type)) {
        selectPayment(payment_type);
      }
    });

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
    
    function updateTotal() {
      var total = 0;

      $(".subtotal").each(function() {
        var subtotal = removeDollarAndToFloat($(this).text());
        //console.log('subtotal='+subtotal+' typeof='+typeof subtotal);
        total += subtotal;
      });
      //console.log(total);
      $("#p-total").text("$" + toTwoDecimal(total));
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
      updateTotal();
    }

    function getQuantity(product_id) {
      var quantity = parseFloat($("#product"+product_id + "-quantity").val());
      return quantity;
    }

    function updateSubtotal(product_id) {
      var price = parseFloat($("#product"+product_id+"-discounted-price").attr('data-discounted-price'));
      var quantity = getQuantity(product_id);
      var subtotal = price * quantity;
      //console.log('price='+price + ' quantity='+quantity + ' subtotal='+subtotal);
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
          updateTotal();
        },
        error: function(  ) {
          alert("An error has occurred, please contact admin@pawfamily.sg");
        }
      });
    }

    function selectPayment(type) {
      console.log(type);
      $("#payment-{{PaymentType::Bank}}").hide();
      $("#payment-{{PaymentType::Cheque}}").hide();
      $("#payment-{{PaymentType::Cash}}").hide();
      $("#payment-"+type).show();
    }
  </script>
@endsection