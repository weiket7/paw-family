
@extends("admin.template", [
  "title"=>"Brands",
  "action"=>"index",
  "controller"=>"brand"
])

@section("content")
  <div class="row">
    <div class="col-md-12 text-center">
      <button type="submit" class="btn btn-success">Save</button>
    </div>
  </div>
  <br>

  <table class="table table-bordered">
    <thead>
    <tr>
      <th width="50px">Position</th>
      <th width="150px">Name</th>
      <th width="100px">Product Count</th>
      <th>Image</th>
    </tr>
    </thead>
    <tbody>
    @foreach($brands as $brand)
      <tr>
        <td><input type="text" name="pos{{$brand->brand_id}}" value="{{$brand->pos}}" class="form-control txt-num"></td>
        <td><a href="{{(url("admin/brand/save/".$brand->brand_id))}}">{{$brand->name}}</a></td>
        <td>{{$brand->product_count}}</td>
        <td><img src="{{url("assets/images/brands/".$brand->image)}}" style="max-height: 177px;"></td>
      </tr>
    @endforeach
    </tbody>
  </table>

  <div class="row">
    <div class="col-md-12 text-center">
      <button type="submit" class="btn btn-success">Save</button>
    </div>
  </div>
  <br>
@endsection