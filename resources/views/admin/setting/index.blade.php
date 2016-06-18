<?php use App\Models\Enums\MainCategory; ?>

@extends("admin.template", [
  "title"=>"Settings",
  'controller'=>'setting',
  "action"=>"view",
])

@section("content")
  <table class="table table-bordered">
    <thead>
    <tr>
      <th width="150px">Name</th>
      <th>Value</th>
    </tr>
    </thead>
    <tbody>
    @foreach($settings as $setting)
      <tr>
        <td>{{$setting->name}}</td>
        <td>{{$setting->value}}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
  <br>

  <div class='row'>
    <div class='col-xs-6'>
      <h3 class="page-title">Delivery Day</h3>
    </div>
    <div class='col-xs-6 text-right'>
      <a href="{{url("admin/setting/save")}}"><button type="button" class="btn blue">Create</button></a>
    </div>
  </div>
  <hr style="margin-top: 0">
  <table class="table table-bordered">
    <thead>
    <tr>
      <th width="150px">Day</th>
      <th>Area</th>
    </tr>
    </thead>
    <tbody>
    @foreach($delivery_days as $day => $area)
      <tr>
        <td>{{$day}}</td><td>{{$area}}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
@endsection