<?php use App\Models\Enums\MainCategory; ?>

@extends("admin.template", [
  "title"=>"Settings",
  "action"=>"index",
  "controller"=>"setting"
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
        <td><a href="{{(url("admin/setting/save/".$setting->setting_id))}}">{{$setting->name}}</a></td>
        <td>{{$setting->value}}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
@endsection