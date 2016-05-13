<?php use App\Models\Enums\MainCategory; ?>

@extends("admin.template", [
  "title"=>"Categories",
  "action"=>"index",
  "controller"=>"category"
])

@section("content")
  <table class="table table-bordered">
    <thead>
    <tr>
      <th width="150px">Name</th>
      <th width="100px">Main Category</th>
      <th width="100px">Product Count</th>
      <th>Order</th>
    </tr>
    </thead>
    <tbody>
    @foreach($categories as $category)
      <tr>
        <td><a href="{{(url("admin/category/save/".$category->category_id))}}">{{$category->name}}</a></td>
        <td>{{ MainCategory::$values[$category->main_category] }}</td>
        <td>{{$category->product_count}}</td>
        <td>{{$category->pos}}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
@endsection