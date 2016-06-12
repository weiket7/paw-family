<?php use App\Models\Enums\FeaturedType; ?>

@extends("admin.template", [
  "title"=>"Featured",
  "action"=>"index",
  "controller"=>"featured"
])

@section("content")
  <table class="table table-bordered">
    <thead>
    <tr>
      <th width="400px">Product</th>
      <th width="150px">Type</th>
      <th>Order</th>
    </tr>
    </thead>
    <tbody>
    @foreach($featured as $featured_type => $features)
      @foreach($features as $f)
        <tr>
          <td><a href="{{url("admin/featured/save/".$f->featured_id)}}">{{$f->name}}</a></td>
          <td>{{FeaturedType::$values[$featured_type]}}</td>
          <td>{{$f->pos}}</td>
        </tr>
      @endforeach

    @endforeach
    </tbody>
  </table>
@endsection
