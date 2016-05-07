@extends('template', [
  "breadcrumbs"=>$breadcrumbs,
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
        redirect("{{url('product/category/'.$current_main_category.'/'.$current_category.'?brands=')}}"+brands);
      });
    })
  </script>
@endsection

@section('content')
  @include("grid", [
  "breadcrumbs"=>$breadcrumbs,
  "products"=>$products,
  "brands"=>$brands,
  "categories"=>$categories,
  "current_main_category"=>$current_main_category,
  "selected_brand_ids"=>$selected_brand_ids
  ])
@endsection