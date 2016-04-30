
@extends("admin.template", [
  "title"=>"Categories",
  "form"=>false,
])

@section("content")
  <table class="table table-bordered">
    <thead>
    <tr>
      <th width="150px">Name</th>
      <th width="100px">Main Category</th>
      <th>Order</th>
    </tr>
    </thead>
    <tbody>
    @foreach($categories as $main_category => $category)
      @foreach($category as $c)
      <tr>
        <td><a href="{{(url("admin/category/save".$c->category_id))}}">{{$c->name}}</a></td>
        <td>{{ \App\Models\Enums\MainCategory::$values[$main_category] }}</td>
        <td>{{$c->pos}}</td>
      </tr>
      @endforeach
    @endforeach
    </tbody>
  </table>
@endsection