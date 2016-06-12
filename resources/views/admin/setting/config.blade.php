<?php use App\Models\Enums\MainCategory; ?>

@extends("admin.template", [
  "title"=>"Configs",
  "action"=>"config",
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
    <tr>
      <td>Laravel</td>
      <td>{{$laravel}}</td>
    </tr>
    <tr>
      <td>PHP</td>
      <td>{{$php}}</td>
    </tr>
    <tr>
      <td>Env</td>
      <td>{{$env}}</td>
    </tr>
    <tr>
      <td>Email</td>
      <td>{{$email}}</td>
    </tr>
  </table>
@endsection