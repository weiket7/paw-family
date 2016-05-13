<?php use App\Models\Enums\MainCategory; ?>

@extends("admin.template", [
  "title"=>"Banners",
  "action"=>"index",
  "controller"=>"banner"
])

@section("content")
  <table class="table table-bordered">
    <thead>
    <tr>
      <th width="200px">
        Name<br>
        (Dimensions)<br>
        Link
      </th>
      <th>Image</th>
    </tr>
    </thead>
    <tbody>
    @foreach($banners as $banner)
      <tr>
        <td>
          <a href="{{(url("admin/banner/save/".$banner->banner_id))}}">{{$banner->name}}</a><br>
          {{$banner->dimension}}<br><br>
          <a href="{{url($banner->link)}}">{{$banner->link}}</a>
        </td>
        <td><img src="{{url('assets/images/banners/'.$banner->image)}}" style="max-height: 150px"></td>
      </tr>
    @endforeach
    </tbody>
  </table>
@endsection