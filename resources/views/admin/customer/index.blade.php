<?php use App\Models\Enums\CustomerStat; ?>

@extends("admin.template", [
  "title"=>"Customers",
  "action"=>"index",
  "controller"=>"customer"
])

@section("content")
  <table class="table table-bordered">
    <thead>
    <tr>
      <th>Status</th>
      <th>Name</th>
      <th>Email</th>
      <th>Mobile</th>
    </tr>
    </thead>
    <tbody>
    <tr>
      <td><input type="text" name="name" class="form-control"></td>
      <td><input type="text" name="name" class="form-control"></td>
      <td><input type="text" name="name" class="form-control"></td>
    </tr>
    </tbody>
    <tfoot>
      <td colspan="3" class="text-center"><button type="submit" class="btn blue">Search</button></td>
    </tfoot>
  </table>

  <hr>

  <table class="table table-bordered table-hover">
    <thead>
    <tr>
      <th>Status</th>
      <th>Name</th>
      <th>Email</th>
      <th>Mobile</th>
      <th>Num of Orders</th>
      <th>Total Amt Spent</th>
    </tr>
    </thead>
    <tbody>
    @foreach($customers as $customer)
      <tr>
        <td>{{CustomerStat::$values[$customer->stat]}}</td>
        <td width="450px"><a href="{{url("admin/customer/save/".$customer->customer_id)}}">{{ $customer->name }}</a></td>
        <td>{{$customer->email}}</td>
        <td>{{$customer->mobile}}</td>
        <td>{{$customer->order_count}}</td>
        <td>{{$customer->spent_amt_total}}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
@endsection