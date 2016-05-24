@extends('template')

@section('content')
  <div class="page_content_offset">
    <div class="container">
      <div class="row clearfix">
        <div class="col-md-12">

          <h2 class="tt_uppercase color_dark m_bottom_15">Thank you!</h2>

          Your order #{{session()->get('sale_no')}} has been received.
          <br><br>

          An order confirmation email has been sent to your email {{session()->get('email')}}.
          <br><br>

          After payment, it will be delivered within 1-3 working days.
          <br><br>

          You can view your order history by going to your <a href="{{url('account#tab-orders')}}">Account</a>.
          <br><br>

          If you have any questions or encounter any issues, please email us at admin@pawfamily.sg or contact us at +65 9026 4166.
          <br><br>

          Regards,<br>
          Pawfamily
        </div>
      </div>
    </div>
  </div>
@endsection