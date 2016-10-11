
@extends("admin.template", [
  "title"=>ucfirst($action) . " Brand",
  "form"=>$action,
])

@section("content")
  <div class="form-body">
    <div class="form-group">
      <label class="control-label col-md-2">Brand</label>
      <div class="col-md-10">
        {!! Form::text('name', $brand->name, ['class'=>'form-control']) !!}
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2">Image</label>
      <div class="col-md-10">
        @if(strlen($brand->image) > 0)
          <img src="{{url("assets/images/brands/".$brand->image)}}" class='thumbnail' style="max-height:200px;"/>
        @endif
        {!! Form::file('image') !!}
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2">Meta Keyword</label>
      <div class="col-md-10">
        {!! Form::text('meta_keyword', $brand->meta_keyword, ['class'=>'form-control']) !!}
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2">Meta Description</label>
      <div class="col-md-10">
        {!! Form::text('meta_desc', $brand->meta_desc, ['class'=>'form-control']) !!}
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-md-2">Product Count</label>
      <label class="form-control-static col-md-10">{{ $brand->product_count }}</label>
    </div>
  </div>
@endsection