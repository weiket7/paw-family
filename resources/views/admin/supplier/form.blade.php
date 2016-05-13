<?php use App\Models\Enums\MainCategory; ?>

@extends("admin.template", [
  "title"=>ucfirst($action)." Supplier",
  "action"=>$action,
])

@section("content")
  <div class="form-body">

    <div class="form-group">
      <label class="control-label col-md-2">Name</label>
      <div class="col-md-10">
        {!! Form::text('name', $supplier->name, ['class'=>'form-control']) !!}
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-md-2">Product Count</label>
      <label class="form-control-static col-md-10">{{ $supplier->product_count }}</label>
    </div>
  </div>
@endsection