<?php use App\Models\Enums\ProductDescType; ?>

@extends("admin.template", [
  "title"=>ucfirst($action) . " Description",
  "action"=>$action,
])

@section("content")
  <div class="form-body">
    <div class="form-group">
      <label class="control-label col-md-2">Product</label>
      <label class="form-control-static col-md-10">{{ $product_name }}</label>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2">Type</label>
      <div class="col-md-10">
        {!! Form::select('type', ProductDescType::$values, $product_desc->type, ['class'=>'form-control']) !!}
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2">Value</label>
      <div class="col-md-10">
        {!! Form::textarea('value', $product_desc->value, ['class'=>'form-control']) !!}
      </div>
    </div>
  </div>
@stop

