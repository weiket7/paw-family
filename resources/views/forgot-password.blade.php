@extends('template')

@section('content')
  <div class="page_content_offset">
    <div class="container">
      <div class="row clearfix">
        <section class="col-lg-12 col-md-12 col-sm-12 m_xs_bottom_30">
          <h2 class="tt_uppercase color_dark m_bottom_20">Forgot Password</h2>

          <p class="m_bottom_20">Please enter your email and a new password will be emailed to you.<br>
          If you still encounter issues, please email admin@pawfamily.sg.</p>

          @if ($errors->has())
            <div class="alert_box r_corners error m_bottom_10">
              <i class="fa fa-exclamation"></i>
              <p>
                @foreach ($errors->all() as $error)
                  {{ $error }}<br>
                @endforeach
              </p>
            </div>
          @endif

          <form method="post" action="">
            {{csrf_field()}}
          <ul>
            <li class="m_bottom_15">
              <label for="email" class="d_inline_b m_bottom_5 required">Email</label>
              <input type="text" name="email" class="r_corners full_width m_bottom_5">
            </li>
            <li><button type="submit" class="button_type_4 r_corners bg_scheme_color color_light tr_all_hover">Reset Password</button></li>
          </ul>
          </form>
        </section>
      </div>
    </div>
  </div>
@endsection

@section('script')
<script>
  $(document).ready(function() {
    $("input[name='email']").focus();
  });
</script>
@endsection
