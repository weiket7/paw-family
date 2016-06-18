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
@endsection