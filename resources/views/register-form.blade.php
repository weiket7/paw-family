<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 m_xs_bottom_30">
    <ul>
      <li class="m_bottom_15">
        <label for="name" class="d_inline_b m_bottom_5 required">Name</label>
        {{Form::text("name", '', ['id'=>'name', 'class'=>'r_corners full_width m_bottom_5', 'tabindex'=>1])}}
      </li>
      <li class="m_bottom_15">
        <label for="email" class="d_inline_b m_bottom_5 required">Email</label>
        {{Form::text("email", '', ['id'=>'email', 'class'=>'r_corners full_width m_bottom_5', 'tabindex'=>2])}}
      </li>
      <li class="m_bottom_15">
        <label for="password" class="d_inline_b m_bottom_5 required">Password</label>
        <input type="password" name="password" autocomplete="off" class="r_corners full_width" tabindex="3">
      </li>
      <li class="m_bottom_25">
        <label for="password_confirmation" class="d_inline_b m_bottom_5 required">Confirm Password</label>
        <input type="password" id="password_confirmation" autocomplete="off" name="password_confirmation" class="r_corners full_width" tabindex="4">
      </li>
      <li><button type="submit" class="button_type_4 r_corners bg_scheme_color color_light tr_all_hover">Save</button></li>
    </ul>
  </div>
  <div class="col-lg-6 col-md-6 col-sm-6 m_xs_bottom_30">
    <ul>
      <li class="m_bottom_15">
        <label for="mobile" class="d_inline_b m_bottom_5 required">Mobile</label>
        {{Form::text("mobile", '', ['id'=>'mobile', 'class'=>'r_corners full_width m_bottom_5', 'tabindex'=>5])}}
      </li>
      <li class="m_bottom_15">
        <label for="address" class="d_inline_b m_bottom_5 required">Address</label>
        {{Form::text("address", '', ['id'=>'address', 'class'=>'r_corners full_width m_bottom_5', 'tabindex'=>6])}}
      </li>
      <li class="m_bottom_15">
        <label for="postal" class="d_inline_b m_bottom_5 required">Postal</label>
        {{Form::text("postal", '', ['id'=>'postal', 'class'=>'r_corners full_width m_bottom_5', 'tabindex'=>7])}}
      </li>
      <li class="m_bottom_15">
        <label for="email" class="d_inline_b">Promotions</label><br>
        <input type="checkbox" class="d_none" name="subscribe" id="subscribe"><label for="subscribe">Yes, I would like to receive emails about promotions</label>
      </li>
    </ul>
  </div>
</div>