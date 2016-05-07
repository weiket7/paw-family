@extends('template', [
  "breadcrumbs"=>[
     0=>$breadcrumbs[0],
     1=>isset($breadcrumbs[1]) ? $breadcrumbs[1] : null,
  ],
])

@section('script')
  <script type="text/javascript">
    $(document).ready(function() {
      $("input[name='brand']").change(function() {
        var brands = [];
        $("input[name='brand']").each(function() {
          var checked = $(this).is(":checked");
          if (checked) {
            brands.push($(this).val());
          }
        });
        brands = brands.join(",");
        //console.log(brands);
        redirect("{{url('product/brand')}}/"+brands);
      });
    })
  </script>
@endsection

@section('content')
  @include("grid", ["products"=>$products, "brands"=>$brands, "selected_brand_ids"=>$selected_brand_ids])
@endsection