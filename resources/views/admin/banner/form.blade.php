<?php use App\Models\Enums\BannerStat; ?>
<?php use App\Models\Enums\BannerType; ?>

@extends("admin.template", [
  "title"=>ucfirst($action)." Banner",
  "action"=>$action,
  "hide_delete"=>true,
])

@section("content")
  <div class="form-body">
    <div class="form-group">
      <label class="control-label col-md-2">Identifier</label>
      <label class="form-control-static col-md-10">{{ $banner->identifier }}</label>
    </div>

    <div class="form-group">
      <label class="control-label col-md-2">Name</label>
      <div class="col-md-10">
        {!! Form::text('name', $banner->name, ['class'=>'form-control']) !!}
        <p class="help-block">
          Good name will be helpful for SEO
        </p>
      </div>
    </div>

    @if(str_contains(strtolower($banner->name), 'main'))
      <div class="form-group">
        <label class="control-label col-md-2">Status</label>
        <div class="col-md-10">
          {!! Form::select('stat', BannerStat::$values, $banner->stat, ['class'=>'form-control']) !!}
        </div>
      </div>
    @endif

    <div class="form-group">
      <label class="control-label col-md-2">Link</label>
      <div class="col-md-10">
        {!! Form::text('link', $banner->link, ['class'=>'form-control']) !!}
        <p class="help-block">
          Paste the part after pawfamily.sg<br>
          http://pawfamily.sg/<b>product/view/addiction-viva-la-venison</b>
        </p>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-md-2">Dimensions</label>
      <label class="form-control-static col-md-10">{{ $banner->dimension }}</label>
    </div>

    <div class="form-group">
      <label class="control-label col-md-2">Product Count</label>
      <div class="col-md-10">
        @if(strlen($banner->image) > 0)
          <img src="{{url("assets/images/banners/".$banner->image)}}" class='thumbnail' style="max-height:200px;"/>
        @endif
        <input type='file' name='image'>
      </div>
    </div>
  </div>
@endsection