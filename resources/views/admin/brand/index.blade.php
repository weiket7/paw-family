
@extends("admin.template", [
  "title"=>"Brands",
])

@section("content")
<table class="table table-bordered">
  <thead>
    <tr>
      <th width="150px">Name</th>
      <th width="250px">Image</th>
      <th>Order</th>
    </tr>
  </thead>
  <tbody>
  @foreach($brands as $brand)
    <tr>
      <td><a href="{{(url("admin/brand/save".$brand->brand_id))}}">{{$brand->name}}</a></td>
      <td><img src="{{url("assets/images/brands/".$brand->image)}}"></td>
      <td>{{$brand->pos}}</td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection