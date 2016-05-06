
@extends("admin.template", [
  "title"=>"Repack",
  "action"=>$action,
  "controller"=>"option",
  "back"=>'',
])

@section("content")
  <div class="form-body">
    <div class="form-group">
      <label class="control-label col-md-2">Product</label>
      <label class="form-control-static col-md-10">{{ $product_name }}</label>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2">Size</label>
      <div class="col-md-10">
        @if($action=="update")
          <label class="form-control-static">{{ $size_name }}</label>
        @else
          {!! Form::select('size_id', $sizes, $option->name, ['class'=>'form-control']) !!}
        @endif
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2">Name</label>
      <div class="col-md-10">
        {!! Form::text('name', $option->name, ['class'=>'form-control']) !!}
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2">Price</label>
      <div class="col-md-10">
        {!! Form::text('price', $option->price, ['class'=>'form-control']) !!}
      </div>
    </div>
  </div>
@endsection