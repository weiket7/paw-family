<?php use App\Models\Enums\DiscountType; ?>

@extends("admin.template", [
  "title"=>ucfirst($action) . " Size",
  "action"=>$action,
])

@section("content")
  <div class="form-body">
    <div class="form-group">
      <label class="control-label col-md-2">Product</label>
      <label class="form-control-static col-md-10">{{ $product_name }}</label>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2">Name</label>
      <div class="col-md-10">
        {!! Form::text('name', $size->name, ['class'=>'form-control']) !!}
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2">Quantity</label>
      <div class="col-md-10">
        {!! Form::text('quantity', $size->quantity, ['class'=>'form-control']) !!}
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2">Price</label>
      <div class="col-md-10">
        {!! Form::text('price', $size->price, ['class'=>'form-control']) !!}
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2">Discount Amount</label>
      <div class="col-md-10">
        {!! Form::text('discount_amt', $size->discount_amt, ['class'=>'form-control']) !!}
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2">Discount Type</label>
      <div class="col-md-10">
        {!! Form::select('discount_type', DiscountType::$values, $size->discount_type, ['class'=>'form-control']) !!}
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2">Weight (lbs)</label>
      <div class="col-md-10">
        {!! Form::text('weight_lb', $size->weight_lb, ['class'=>'form-control']) !!}
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2">Weight (kgs)</label>
      <div class="col-md-10">
        {!! Form::text('weight_kg', $size->weight_kg, ['class'=>'form-control']) !!}
      </div>
    </div>
  </div>
@stop

