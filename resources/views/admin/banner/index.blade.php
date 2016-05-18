<?php use App\Models\Enums\BannerStat; ?>

@extends("admin.template", [
  "title"=>"Banners",
  "action"=>"index",
  "controller"=>"banner"
])

@section("content")
  <table class="table table-bordered">
    <thead>
    <tr>
      <th width="100px">Status</th>
      <th width="100px">Identifier</th>
      <th width="200px">Name</th>
      <th width="300px">Link</th>
      <th>Image</th>
    </tr>
    </thead>
    <tbody>
    @foreach($banners as $banner)
      <tr>
        <td>{{BannerStat::$values[$banner->stat]}}</td>
        <td>
          <a href="{{(url("admin/banner/save/".$banner->banner_id))}}">{{$banner->identifier}}</a>
        </td>
        <td>{{$banner->name}}</td>
        <td><a href="{{url($banner->link)}}">{{$banner->link}}</a></td>
        <td>
          @if($banner->image)
            <img src="{{url('assets/images/banners/'.$banner->image)}}" style="max-height: 150px">
          @endif
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
@endsection