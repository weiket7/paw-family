@extends("admin.template", [
  "title"=>"Products",
  "form"=>false,
])

@section("content")
<table class="table table-bordered table-hover">
    <thead>
    <tr>
      <th>Name</th>
      <th>Brand</th>
      <th>Category</th>
      <th>Price</th>
      <th>Discount</th>
      <th>Size</th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $p)
      <tr>
        <td width="450px"><a href="{{url("admin/product/save/".$p->product_id)}}">{{ $p->name }}</a></td>
        <td>{{ $p->brand_name }}</td>
        <td>{{ $p->category_name }}</td>
        <td>${{ $p->price }}</td>
        <td>${{ CommonHelper::getDiscountAmt($p->price, $p->discount_amt, $p->discount_type) }}</td>
        <td>
          <table class="tbl_size">
              @foreach($p->sizes as $size)
              <tr>
                <td>{{ $size->name }}</td>
                <td>{{ $size->weight_lb }} lbs</td>
                <td>${{ $size->price }}</td>
                <td>
                  @if(isset($p->repacks[$size->size_id]))
                    {{ implode(", ", array_pluck($p->repacks[$size->size_id], "name")) }}
                  @endif
                </td>
              </tr>
              @endforeach
          </table>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
@endsection