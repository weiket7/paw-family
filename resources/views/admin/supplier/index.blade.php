<?php use App\Models\Enums\MainCategory; ?>

@extends("admin.template", [
  "title"=>"Suppliers",
  "action"=>"index",
  "controller"=>"supplier"
])

@section("content")
  <table class="table table-bordered">
    <thead>
    <tr>
      <th width="200px">Name</th>
      <th>Product Count</th>
    </tr>
    </thead>
    <tbody>
    @foreach($suppliers as $supplier)
      <tr>
        <td><a href="{{(url("admin/supplier/save/".$supplier->supplier_id))}}">{{$supplier->name}}</a></td>
        <td>{{$supplier->product_count}}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
@endsection