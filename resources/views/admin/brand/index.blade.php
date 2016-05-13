
@extends("admin.template", [
  "title"=>"Brands",
  "action"=>"index",
  "controller"=>"brand"
])

@section("content")
<table class="table table-bordered">
  <thead>
    <tr>
      <th width="150px">Name</th>
      <th width="100px">Product Count</th>
      <th width="250px">Image</th>
      <th>Order</th>
    </tr>
  </thead>
  <tbody>
  @foreach($brands as $brand)
    <tr>
      <td><a href="{{(url("admin/brand/save/".$brand->brand_id))}}">{{$brand->name}}</a></td>
      <td>{{$brand->product_count}}</td>
      <td><img src="{{url("assets/images/brands/".$brand->image)}}" style="max-height: 177px;"></td>
      <td>{{$brand->pos}}</td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection