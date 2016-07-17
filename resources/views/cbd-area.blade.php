@extends('template')

@section('content')
  <div class="page_content_offset">
    <div class="container">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="row clearfix">
          <h2 class="tt_uppercase color_dark m_bottom_15">
            CBD Areas
          </h2>

          <img src="{{url('assets/images/district-postal.png')}}">
          <br>
          <small>Image source: <a href="http://propertyinvestmentsingapore.sg/blog/singapore-district-map/" target="_blank">http://propertyinvestmentsingapore.sg/blog/singapore-district-map/</a></small>

          <br><br>
          <p>
            Districts 9, 10 and 11 are CBD areas.<br><br>

            These districts consist of postal codes starting with 22, 23, 24, 25, 26, 27, 28, 29 and 30.<br><br>

            For these postal codes, there will be $5 CBD ERP surcharge.<br><br>

            <button id='btn-back' type='button' class="r_corners button_type_14 bg_color_blue color_light">Back</button>
          </p>
        </div>
      </div>
    </div>
  </div>
@endsection