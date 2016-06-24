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
      <td>{!! Form::select('stat', CustomerStat::$values, '', ['class'=>'form-control']) !!}</td>
      <td><input type="text" name="name" class="form-control"></td>
      <td><input type="text" name="email" class="form-control"></td>
      <td><input type="text" name="mobile" class="form-control"></td>
    </tr>
    </tbody>
    <tfoot>
      <td colspan="4" class="text-center"><button type="submit" class="btn blue">Search</button></td>
    </tfoot>
  </table>

  @if(Session::has('search_result'))
    <div class="alert alert-success ">
      {{ Session::get('search_result') }}
    </div>
  @endif

  <table class="table table-bordered table-hover">
    <thead>
    <tr>
      <th>Status</th>
      <th>Name</th>
      <th>Email</th>
      <th>Mobile</th>
      <th>Points</th>
      <th>Spent Total</th>
      <th>Order Count</th>
      <th>Spent Average</th>
    </tr>
    </thead>
    <tbody>
    @foreach($customers as $customer)
      <tr>
        <td>{{CustomerStat::$values[$customer->stat]}}</td>
        <td width="450px"><a href="{{url("admin/customer/save/".$customer->customer_id)}}">{{ $customer->name }}</a></td>
        <td>{{$customer->email}}</td>
        <td>{{$customer->mobile}}</td>
        <td>{{$customer->points}}</td>
        <td>${{CommonHelper::formatNumber($customer->spent_total)}}</td>
        <td>{{$customer->order_count}}</td>
        <td>${{CommonHelper::formatNumber($customer->spent_avg)}}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
@endsection