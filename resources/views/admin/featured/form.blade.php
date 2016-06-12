<?php use App\Models\Enums\FeaturedType; ?>

@extends("admin.template", [
  "title"=>ucfirst($action)." Featured",
  "action"=>$action,
])

@section("content")
  <div class="form-body">
    <div class="form-group">
      <label class="control-label col-md-2">Product</label>
      <div class="col-md-10">
        {{Form::select('product_id', $products, $featured->product_id, ['class'=>'form-control'])}}
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-md-2">Type</label>
      <div class="col-md-10">
        {{Form::select('type', FeaturedType::$values, $featured->type, ['class'=>'form-control'])}}
      </div>
    </div>
  </div>
@endsection