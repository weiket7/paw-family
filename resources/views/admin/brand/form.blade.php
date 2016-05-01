
@extends("admin.template", [
  "title"=>"Brand",
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
  </div>
@endsection