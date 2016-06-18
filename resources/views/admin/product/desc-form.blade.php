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
        <p class="help-block" id="div-video">
          For videos, paste the part after watch?=v<br>
          https://www.youtube.com/watch?v=<b>5SXqYtbqhOM</b>
        </p>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2">Value</label>
      <div class="col-md-10">
        {!! Form::textarea('value', $product_desc->value, ['class'=>'form-control', 'rows'=>20]) !!}
      </div>
    </div>
  </div>
@stop

