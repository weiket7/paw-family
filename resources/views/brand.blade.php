@extends('template', [
  'meta_keyword'=>$brand->meta_keyword,
  'meta_desc'=>$brand->meta_desc
])

@section('content')
  <div class="page_content_offset">
    <div class="container">
      <div class="row clearfix">
        <section class="col-lg-12 col-md-12 col-sm-12 m_xs_bottom_30">
          <h2 class="tt_uppercase color_dark m_bottom_30">Brands</h2>
          <div class="bg_light_color_3 r_corners shadow manufacturers t_xs_align_c">
            <?php $cur = 1; $count = count($brands); $column_in_row = 4;?>
            @foreach($brands as $brand)
              @if(($cur-1) % 4 == 0)
                @if($cur == 1)
                  <div class="row clearfix m_bottom_25 m_xs_bottom_0">
                @else
                  <div class="row clearfix">
                @endif
              @endif

              <figure class="col-lg-3 col-md-3 col-sm-3 col-xs-6 m_xs_bottom_25 t_align_c">
                <a href="{{url('product/brand/'.$brand->slug)}}" class="m_image_wrap d_block m_bottom_15 d_xs_inline_b d_mxs_block">
                  <img src="{{url("assets/images/brands/".$brand->image)}}" alt="">
                </a>
                <figcaption>
                  <h5><a href="{{url('product/brand/'.$brand->slug)}}" class="color_dark fw_medium">{{$brand->name}} ({{$brand->product_count}})</a></h5>
                </figcaption>
              </figure>

              @if($cur % 4 == 0 || $cur == $count)
                </div>
              @endif
              <?php $cur++; ?>
            @endforeach
          </div>
        </section>
      </div>
    </div>
  </div>
@endsection