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

  <?php $logged_in = auth()->check(); ?>

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
                  <td data-title="Product">
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

                        <br>Bulk Discount:
                          @if($p->bulk_discount_applicable)
                            Applicable
                          @else
                            Not Applicable
                          @endif
                      </div>
                    </div>
                  </td>
                  <td data-title="Price">
                    @if($p->price > $p->discounted_price)
                      <s>${{$p->price}}</s>
                    @endif
                    <span class="scheme_color fw_medium" id="product{{$p->product_id}}-size{{$p->size_id}}-discounted-price" data-discounted-price="{{$p->discounted_price}}">${{$p->discounted_price}}</span>
                  </td>
                  <td data-title="Quantity">
                    <div class="clearfix quantity r_corners d_inline_middle f_size_medium color_dark m_bottom_10">
                      <button class="bg_tr d_block f_left" data-direction="down" onclick="updateQuantity(this)">-</button>
                      <input type="text" id="product{{$p->product_id}}-size{{$p->size_id}}-quantity" value="{{$p->quantity}}" class="f_left">
                      <button class="bg_tr d_block f_left" data-direction="up" onclick="updateQuantity(this)">+</button>
                    </div>
                    <div>
                      <span class="link color_dark" onclick="updateCart('{{$p->product_id}}', '{{$p->size_id}}')">
                        <i class="fa fa-check f_size_medium m_right_5"></i>Update
                      </span><br>
                      <span class="link color_dark" onclick="removeFromCart('{{$p->product_id}}', '{{$p->size_id}}')">
                        <i class="fa fa-times f_size_medium m_right_5"></i>Remove
                      </span>
                    </div>
                  </td>
                  <td data-title="Subtotal">
                    <p id='product{{$p->product_id}}-size{{$p->size_id}}-subtotal' data-bulk-discount-applicable='{{$p->bulk_discount_applicable}}' class="subtotal f_size_large fw_medium scheme_color">
                      ${{CommonHelper::formatNumber($p->subtotal)}}
                    </p>
                  </td>
                </tr>
                <?php $gross_total += $p->subtotal; ?>
              @endforeach

              @if($logged_in)
                <?php $can_redeem_points = $customer->points >= 1200; ?>
                <?php $points_colspan = $can_redeem_points ? 1 : 3; ?>
                <tr>
                  <td colspan="{{$points_colspan}}" class="v_align_m t_align_r">
                    <p class="f_size_large">
                      <span class="d_inline_middle">
                        You have: <span id="current-points">{{$customer->points}}</span> Paw Points<br>
                        You will earn: <span id="earned-points"></span> Paw Points<br>
                        <span id="spend-points"></span>
                        You will have: <span id="result-points"></span> Paw Points
                      </span>
                    </p>
                  </td>
                  @if($can_redeem_points)
                    <td colspan="2" class="v_align_m t_align_r">
                      <input type="radio" id="points-1200" name="radio-redeemed-points" data-redeemed-amt='10' class="d_none" value="1200" onclick="redeemPoints()">
                      <label for="points-1200">1200 Paw Points = $10 discount</label><br>
                      @if($customer->points >= 3000)
                        <input type="radio" id="points-3000" name="radio-redeemed-points" data-redeemed-amt='25' class="d_none" value="3000" onclick="redeemPoints()">
                        <label for="points-3000">3000 Paw Points = $25 discount</label><br>
                      @endif
                      @if($customer->points >= 5000)
                        <input type="radio" id="points-5000" name="radio-redeemed-points" data-redeemed-amt='50' class="d_none" value="5000" onclick="redeemPoints()">
                        <label for="points-5000">5000 Paw Points = $50 discount</label>
                      @endif
                    </td>
                    <td colspan="1" class="v_align_m">
                      <span id='redeemed-amt' class="f_size_large m_xs_bottom_10" style="padding-top:5px;">$0</span><br>
                      <span id='span-redeem-clear' class="link color_dark" style="display:none"><i class="fa fa-times f_size_medium m_right_5"></i>Clear</span>
                    </td>
                  @else
                    <td colspan="1" class="v_align_m"></td>
                  @endif
                </tr>
              @else
                <tr>
                  <td colspan="3" class="v_align_m t_align_r">
                    <p class="f_size_large">You will earn: <span id="earned-points-not-logged-in"></span> Paw Points</p>
                  </td>
                  <td colspan="1" class="v_align_m t_align_r">

                  </td>
                </tr>
              @endif
              <?php $promo_total = 0; ?>
              <?php $total = $gross_total - 0; ?>
              {{--<tr>
                <td colspan="3" class="v_align_m">
                  <p class="f_size_large t_align_r">
                    <input type="text" placeholder="Promo Code" name="" class="r_corners f_size_medium">
                    <button class="button_type_4 r_corners bg_light_color_2 m_left_5 mw_0 tr_all_hover color_dark" style="margin-right: 20px">Save</button>
                    <span class="fw_medium d_inline_middle">Promo Discount: </span>
                  </p>
                <td colspan="1" class="v_align_m">

                  <p class="fw_medium f_size_large m_xs_bottom_10">${{CommonHelper::formatNumber($promo_total)}}</p>
                </td>
              </tr>--}}
              <tr id='tr-delivery-fee'>
                <td colspan="3" class="v_align_m">
                  <p class="f_size_large t_align_r t_xs_align_c">Delivery Fee:<br>
                  <small>(Free delivery for orders $80 and above)</small>  </p>
                </td>
                <td colspan="1" class="v_align_m">
                  <p class="f_size_large m_xs_bottom_10" id="delivery-fee"></p>
                </td>
              </tr>
              <tr id='tr-cbd-surcharge' style="display:none">
                <td colspan="3" class="v_align_m">
                  <p class="f_size_large t_align_r t_xs_align_c">CBD ERP surcharge:</p>
                </td>
                <td colspan="1" class="v_align_m">
                  <p class="f_size_large m_xs_bottom_10">+$5</p>
                </td>
              </tr>
              <tr id='tr-bulk-discount'>
                <td colspan="3" class="v_align_m">
                  <p class="f_size_large t_align_r t_xs_align_c">Bulk Discount:<br>
                  <small>$300 and above: 6% discount<br>
                  $800 and above: 7% discount<br>
                  $1000 and above: 8% discount</small>
                  </p>
                </td>
                <td colspan="1" class="v_align_m">
                  <p class="f_size_large m_xs_bottom_10" id="bulk-discount">$0</p>
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

            @if(! $logged_in)
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
              <h2 class="tt_uppercase color_dark m_bottom_15 checkout-header-disabled">Delivery Date</h2>
              <h2 class="tt_uppercase color_dark m_bottom_15 checkout-header-disabled">Delivery Time</h2>
              <h2 class="tt_uppercase color_dark m_bottom_15 checkout-header-disabled">Payment Type</h2>
              <h2 class="tt_uppercase color_dark m_bottom_15 checkout-header-disabled">Remarks</h2>
            @else

              <form method="post" action="">
                {{ csrf_field() }}
                <input type="hidden" id='redeemed_points' name="redeemed_points">

                <h2 class="tt_uppercase color_dark m_bottom_15">
                  Delivery Address
                  @if($errors->checkout->has('delivery_choice')) <span class="error">(Required)</span> @endif
                </h2>
                <div class="bs_inner_offsets bg_light_color_3 shadow r_corners m_bottom_45">
                  <figure class="block_select clearfix relative m_bottom_15" onclick="selectCurrentAddress()">
                    {{Form::radio("delivery_choice", DeliveryChoice::CurrentAddress, '', ['id'=>'radio-current-address', 'class'=>'d_none'])}}
                    <figcaption>
                      <h5 class="color_dark fw_medium m_bottom_15 m_sm_bottom_5" id="h5-current-address">
                        Current address: {{$customer->address}}, <span id="current-address-postal">{{$customer->postal}}</span>
                        @if($customer->building)
                          , Building {{$customer->building}}
                        @endif
                        @if($customer->lift_lobby)
                          , Lift Lobby {{$customer->lift_lobby}}
                        @endif
                      </h5>
                      @if($postal_is_cbd)
                        <p>
                          As this postal code is in <a href="{{url('cbd-area')}}" target="_blank">CBD area</a>, there will be $5 ERP surcharge which has been included above.
                        </p>
                      @endif
                    </figcaption>
                  </figure>
                  <hr class="m_bottom_20">
                  <figure class="block_select clearfix relative" onclick="selectOtherAddress()">
                    {{Form::radio("delivery_choice", DeliveryChoice::OtherAddress, '', ['id'=>'radio-other-address', 'class'=>'d_none'])}}
                    <figcaption>
                      <h5 class="color_dark fw_medium m_bottom_15 m_sm_bottom_5" id="h5-other-address">
                        Other address
                      </h5>
                      <div class="row">
                        <div class="col-md-1">
                          <label class='required'>Address</label> @if($errors->checkout->has('address_other')) <span class="error">(Required)</span> @endif
                        </div>
                        <div class="col-md-5">
                          <?php $bank_ref_style = $errors->checkout->has('address_other') ? 'border-color: #cb2700' : ''; ?>
                          {{Form::text("address_other", '', ['id'=>'address_other', 'class'=>'r_corners full_width m_bottom_5'])}}
                        </div>
                        <div class="col-md-1">
                          <label class="'required">Postal</label> @if($errors->checkout->has('postal_other')) <span class="error">(Required)</span> @endif
                        </div>
                        <div class="col-md-5">
                          <?php $bank_ref_style = $errors->checkout->has('postal_other') ? 'border-color: #cb2700' : ''; ?>
                          {{Form::text("postal_other", '', ['id'=>'postal_other', 'class'=>'r_corners full_width m_bottom_5'])}}
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-1">
                          Building
                        </div>
                        <div class="col-md-5">
                          {{Form::text("building_other", '', ['id'=>'building_other', 'class'=>'r_corners full_width m_bottom_5'])}}
                        </div>
                        <div class="col-md-1">
                          Lift Lobby
                        </div>
                        <div class="col-md-5">
                          {{Form::text("lift_lobby_other", '', ['id'=>'lift_lobby_other', 'class'=>'r_corners full_width m_bottom_5'])}}
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-1">
                          Contact Person
                        </div>
                        <div class="col-md-5">
                          {{Form::text("contact_person_other", '', ['id'=>'contact_person_other', 'class'=>'r_corners full_width m_bottom_5'])}}
                        </div>
                        <div class="col-md-1">
                          Contact Number
                        </div>
                        <div class="col-md-5">
                          {{Form::text("contact_number_other", '', ['id'=>'contact_number_other', 'class'=>'r_corners full_width m_bottom_5'])}}
                        </div>
                      </div>
                      <p id="p-postal-other-cbd" style="display:none">
                        As this postal code is in <a href="{{url('cbd-area')}}" target="_blank">CBD area</a>, there will be $5 ERP surcharge which has been included above.
                      </p>
                    </figcaption>
                  </figure>
                  <hr class="m_bottom_20">
                  <figure class="block_select clearfix relative" onclick="selectSelfCollect()">
                    {{Form::radio("delivery_choice", DeliveryChoice::SelfCollect, '', ['id'=>'radio-self-collect', 'class'=>'d_none'])}}
                    <figcaption>
                      <h5 class="color_dark fw_medium m_bottom_15 m_sm_bottom_5" id="h5-self-collect">Self collect at Upper Paya Lebar, between 11am-2pm, Tues to Thurs</h5>
                    </figcaption>
                  </figure>
                </div>

                <div id="div-delivery-date-time">

                  <h2 class="tt_uppercase color_dark m_bottom_15">
                    Delivery Date
                    @if($errors->checkout->has('delivery_date')) <span class="error">(Required)</span> @endif
                  </h2>

                  <div class="bs_inner_offsets bg_light_color_3 shadow r_corners m_bottom_45">
                    <?php $count = 1; ?>
                    @foreach($delivery_dates as $date)
                      <figure class="block_select clearfix relative">
                        {{Form::radio("delivery_date", $date->date_value, '', ['class'=>'d_none'])}}
                        <figcaption>
                          <h5 class="color_dark fw_medium m_bottom_15 m_sm_bottom_5" id="h5-delivery-day-{{$date->date_value}}">
                            {{CommonHelper::formatDateDay($date->date_value)}} &nbsp;-&nbsp; {{$date->area}}
                          </h5>
                        </figcaption>
                      </figure>
                      @if($count < count($delivery_dates)) <hr class="m_bottom_20"> @endif
                      <?php $count++; ?>
                    @endforeach
                  </div>

                  <h2 class="tt_uppercase color_dark m_bottom_15">
                    Delivery Time
                    @if($errors->checkout->has('delivery_time')) <span class="error">(Required)</span> @endif
                  </h2>

                  <div class="bs_inner_offsets bg_light_color_3 shadow r_corners m_bottom_45">
                    <figure class="block_select clearfix relative">
                      {{Form::radio("delivery_time", DeliveryTime::AnyTime, '', ['class'=>'d_none'])}}
                      <figcaption>
                        <h5 class="color_dark fw_medium m_bottom_15 m_sm_bottom_5" id="h5-any-time">Any time</h5>
                      </figcaption>
                    </figure>
                    <hr class="m_bottom_20">
                    <figure class="block_select clearfix relative">
                      {{Form::radio("delivery_time", DeliveryTime::Oneto430, '', ['class'=>'d_none'])}}
                      <figcaption>
                        <h5 class="color_dark fw_medium m_bottom_15 m_sm_bottom_5" id="h5-1-430">1pm - 4.30pm</h5>
                      </figcaption>
                    </figure>
                    <hr class="m_bottom_20">
                    <figure class="block_select clearfix relative">
                      {{Form::radio("delivery_time", DeliveryTime::Four30to8, '', ['class'=>'d_none'])}}
                      <figcaption>
                        <h5 class="color_dark fw_medium m_bottom_15 m_sm_bottom_5" id="h5-430-8">4.30pm - 8pm</h5>
                      </figcaption>
                    </figure>
                  </div>

                </div>

                <h2 class="tt_uppercase color_dark m_bottom_15">
                  Payment Type
                  @if($errors->checkout->has('payment_type')) <span class="error">(Required)</span> @endif
                </h2>
                <div class="bs_inner_offsets bg_light_color_3 shadow r_corners m_bottom_45">
                  <figure class="block_select clearfix relative m_bottom_15" onclick="selectPayment('{{PaymentType::Bank}}')">
                    {{Form::radio("payment_type", PaymentType::Bank, '', ['data-payment'=>PaymentType::Bank, 'class'=>'d_none'])}}
                    <figcaption>
                      <h5 class="color_dark fw_medium m_bottom_15 m_sm_bottom_5" id="h5-bank">Bank transfer through internet or ATM</h5>
                      <p id="payment-{{PaymentType::Bank}}" style="display:none">
                        DBS Bank - Saving Plus, 017-0-098022<br>
                        Bank Code:7171 | Branch Code:	017<br>
                        <br>
                        OCBC Corporate Current Account, 815529-001<br>
                        Bank Code: 7339 | Branch Code:	557<br><br>
                        <b>Bank Reference Number</b> @if($errors->checkout->has('bank_ref')) <span class="error">(Required)</span> @endif
                        <?php $bank_ref_style = $errors->checkout->has('bank_ref') ? 'border-color: #cb2700' : ''; ?>
                        {{Form::text("bank_ref", '', ['class'=>"r_corners full_width m_bottom_5", 'tabindex'=>2, 'style'=>$bank_ref_style])}}

                      </p>
                    </figcaption>
                  </figure>
                  <hr class="m_bottom_20">
                  <figure class="block_select clearfix relative" onclick="selectPayment('{{PaymentType::Cash}}')">
                    {{Form::radio("payment_type", PaymentType::Cash, '', ['data-payment'=>PaymentType::Cash, 'class'=>'d_none'])}}
                    <figcaption>
                      <h5 class="color_dark fw_medium m_bottom_15 m_sm_bottom_5" id="h5-cash">Cash on delivery</h5>
                      <p id="payment-{{PaymentType::Cash}}" style="display:none">Please provide exact cash amount which will be appreciated</p>
                    </figcaption>
                  </figure>
                  <hr class="m_bottom_20">
                  <figure class="block_select clearfix relative" onclick="selectPayment('{{PaymentType::Cheque}}')">
                    {{Form::radio("payment_type", PaymentType::Cheque, '', ['data-payment'=>PaymentType::Cheque, 'class'=>'d_none'])}}
                    <figcaption>
                      <h5 class="color_dark fw_medium m_bottom_15 m_sm_bottom_5" id="h5-cheque">Cheque</h5>
                      <p id="payment-{{PaymentType::Cheque}}" style="display:none">
                        Please make cheque payable to: PAW FAMILY and cross 'Bearer'
                      </p>
                    </figcaption>
                  </figure>
                  <hr class="m_bottom_20">
                  <figure class="block_select clearfix relative">
                    {{Form::radio("payment_type", PaymentType::Paypal, '', ['data-payment'=>PaymentType::Paypal, 'class'=>'d_none'])}}
                    <figcaption>
                      <h5 class="color_dark fw_medium m_bottom_15 m_sm_bottom_5" id="h5-paypal">Paypal</h5>
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
  <script src="{{url("assets/flatastic/js/cart.js")}}" type="text/javascript"></script>

  <script>
    var postal_cbd = {{json_encode($postal_cbd)}}

    $(document).ready(function() {
      var payment_type = $("input[name='payment_type']:checked").val();
      if (isDefined(payment_type)) {
        selectPayment(payment_type);
      }
      updateTotal();

      $("input[name='postal_other']").keyup(function (){
        if ($(this).val().length >= 6) {
          updateErpSurcharge();
        }
      });

      $("#span-redeem-clear").click(function() {
        $("input[name='radio-redeemed-points']:checked").prop('checked', false);
        redeemPoints();
      });
    });

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
    }
    
    function updateTotal() {
      updatePoints();
      updateDeliveryFee();
      updateBulkDiscount();
      var erp_surcharge = updateErpSurcharge();

      var raw_total = getRawTotal();
      var redeemed_amt = getRedeemedAmt();
      var delivery_fee = getDeliveryFee();
      var bulk_discount = getBulkDiscount();
      var total = raw_total - redeemed_amt + erp_surcharge + delivery_fee - bulk_discount;
      //console.log('total='+total+' redeemed_amt='+redeemed_amt+ ' erp_surcharge='+erp_surcharge + ' delivery_fee=' + delivery_fee + ' bulk discount='+bulk_discount);
      $("#p-total").text("$" + toTwoDecimal(total));

      refreshCartButton();
    }

    function updateErpSurcharge() {
      var delivery_choice = getRadioValueByName('delivery_choice');
      var postal = 0;
      var other_address = false;
      if (delivery_choice == '{{DeliveryChoice::CurrentAddress}}') {
        postal = getCurrentAddressPostal();
      } else if (delivery_choice == '{{DeliveryChoice::OtherAddress}}') {
        postal = getOtherAddressPostal();
        other_address = true;
      }
      //console.log('delivery_choice=' + delivery_choice + ' postal=' + postal);

      $("#p-postal-other-cbd").hide();
      $("#tr-cbd-surcharge").hide();
      if (postal.length > 0) {
        var postal_is_cbd = postalIsCbd(postal);
        //console.log('postal_is_cbd='+postal_is_cbd);
        if (postal_is_cbd) {
          $("#tr-cbd-surcharge").show();
          if (other_address) {
            $("#p-postal-other-cbd").show();
          }
          return 5;
        }
      }
      return 0;
    }

    function selectCurrentAddress() {
      $("#div-delivery-date-time").show();
      updateTotal();
    }

    function selectOtherAddress() {
      $("#div-delivery-date-time").show();
      updateTotal();
    }

    function getRawTotal() {
      var raw_total = 0;
      $(".subtotal").each(function() {
        var subtotal = removeMinusDollarAndToFloat($(this).text());
        //console.log('subtotal='+subtotal+' typeof='+typeof subtotal);
        raw_total += subtotal;
      });
      return raw_total;
    }

    function updateCart(product_id, size_id) {
      var prefix = getElementPrefix(product_id, size_id);
      var quantity_txt = $(prefix+"quantity");
      if (validateQuantity(quantity_txt) == false) {
        return;
      }

      var data = {
        quantity: getQuantity(product_id, size_id),
        product_id: product_id,
        size_id: size_id,
        _token: $("input[name='_token']").val(),
      };

      //console.log(data);

      $.ajax({
        type: "POST",
        url: "{{ url("update-cart") }}",
        data: data,
        success: function(response) {
          updateSubtotal(product_id, size_id);
          updateTotal();
        },
        error: function(  ) {
          popupError();
        }
      });
    }

    function updateSubtotal(product_id, size_id) {
      var price = getDiscountedPrice(product_id, size_id);
      var quantity = getQuantity(product_id, size_id);
      var subtotal = price * quantity;
      //console.log('product_id='+product_id+' size_id='+size_id+' price='+price + ' quantity='+quantity + ' subtotal='+subtotal);
      var prefix = getElementPrefix(product_id, size_id);
      $(prefix+"subtotal").text("$"+toTwoDecimal(subtotal));
    }

    function removeFromCart(product_id, size_id) {
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
          var prefix = getElementPrefix(product_id, size_id);
          $(prefix+"discounted-price").closest("tr").remove();
          updateTotal();
        },
        error: function(  ) {
          popupError();
        }
      });
    }

    function postalIsCbd(postal) {
      var postal = postal.substring(0,2);
      postal = parseFloat(postal);
      //console.log('postal='+postal);
      if (postal_cbd.indexOf(postal) === -1) {
        return false;
      }
      return true;
    }

    function selectPayment(type) {
      //console.log(type);
      $("#payment-{{PaymentType::Bank}}").hide();
      $("#payment-{{PaymentType::Cheque}}").hide();
      $("#payment-{{PaymentType::Cash}}").hide();
      $("#payment-"+type).show();
      if(type == "{{PaymentType::Bank}}") {
        $("input[name='bank_ref']").focus();
      }
      $("#payment-"+type).show();
    }

    function redeemPoints() {
      var redeemed_amt = getRedeemedAmt();
      //console.log('redeemed_amt'+redeemed_amt);
      if (redeemed_amt == 0) {
        $("#span-redeem-clear").hide();
        $("#spend-points").html('');
        $("#redeemed-amt").text('$0');
        updateTotal();
        return;
      }
      $("#redeemed-amt").text('-$'+redeemed_amt);
      var redeemed_points = getRedeemedPoints();
      $("#spend-points").html("<b>You will spend " + redeemed_points + " Paw Points</b><br>");
      $("#redeemed_points").val(redeemed_points);
      $("#span-redeem-clear").show();

      updateTotal();
    }

    function updatePoints() {
      var total = getRawTotal();
      var earned_points = Math.floor(total);
      $("#earned-points").text(earned_points);
      $("#earned-points-not-logged-in").text(earned_points);
      var redeemed_points = getRedeemedPoints();
      var result_points = getCurrentPoints() + earned_points - redeemed_points;
      //console.log('total=' + total + ' earned_points=' + earned_points + 'result_points='+result_points);
      $("#result-points").text(result_points);
    }

    function selectSelfCollect() {
      $("#div-delivery-date-time").hide();
    }

    function updateDeliveryFee() {
      var raw_total = getRawTotal();
      var redeem_amt = getRedeemedAmt();
      var delivery_fee = 0;
      if (raw_total - redeem_amt < 80) {
        delivery_fee = '+$10';
      } else {
        delivery_fee = '$0';
      }
      //console.log('total=' + raw_total + ' delivery_fee=' + delivery_fee);
      $("#delivery-fee").text(delivery_fee);
    }
    
    function updateBulkDiscount() {
      var raw_total = 0;
      $(".subtotal").each(function() {
        var bulk_discount_applicable = $(this).attr('data-bulk-discount-applicable') == 1;
        if (bulk_discount_applicable) {
          raw_total += removeMinusDollarAndToFloat($(this).text());
        }
      });

      var bulk_discount = 0;
      if (raw_total >= 1000) {
        bulk_discount = raw_total * 0.08;
      } else if (raw_total >= 800) {
        bulk_discount = raw_total * 0.07;
      } else if (raw_total >= 300) {
        bulk_discount = raw_total * 0.06;
      }
      if (bulk_discount == 0) {
        bulk_discount = '$0';
      } else {
        bulk_discount = '-$'+toTwoDecimal(bulk_discount);
      }
      //console.log('total=' + raw_total + ' bulk discount='+bulk_discount);
      $("#bulk-discount").text(bulk_discount);
    }

    function getElementPrefix(product_id, size_id) {
      return "#product"+product_id+"-size"+size_id+"-";
    }
    function getDiscountedPrice(product_id, size_id) {
      var prefix = getElementPrefix(product_id, size_id);
      return parseFloat($(prefix+"discounted-price").attr('data-discounted-price'));
    }
    function getRedeemedAmt() {
      return parseFloat($("input[name='radio-redeemed-points']:checked").attr('data-redeemed-amt')) | 0;
    }
    function getRedeemedPoints() {
      return parseFloat($("input[name='radio-redeemed-points']:checked").val()) | 0;
    }
    function getEarnedPoints() {
      return parseFloat($("#earned-points").text());
    }
    function getCurrentPoints() {
      return parseFloat($("#current-points").text());
    }
    function getCurrentAddressPostal() {
      return $("#current-address-postal").text();
    }
    function getOtherAddressPostal() {
      return $("input[name='postal_other']").val();
    }
    function getDeliveryFee() {
      var delivery_fee = $("#delivery-fee").text();
      return removeMinusDollarAndToFloat(delivery_fee);
    }
    function getBulkDiscount() {
      var bulk_discount = $("#bulk-discount").text();
      return removeMinusDollarAndToFloat(bulk_discount);
    }
    function getQuantity(product_id, size_id) {
      var prefix = getElementPrefix(product_id, size_id);
      //console.log('getQuantity - product_id='+product_id+' size_id='+size_id);
      return parseFloat($(prefix+"quantity").val());
    }
  </script>
@endsection