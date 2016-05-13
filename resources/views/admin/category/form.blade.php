<?php use App\Models\Enums\MainCategory; ?>

@extends("admin.template", [
  "title"=>ucfirst($action)." Category",
  "action"=>$action,
  'hide_delete'=>true,
])

@section("content")
  <div class="form-body">
    <div class="form-group">
      <label class="control-label col-md-2">Main Category</label>
      <div class="col-md-10">
        {{Form::select('main_category', MainCategory::$values, $category->main_category, ['class'=>'form-control'])}}
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-md-2">Name</label>
      <div class="col-md-10">
        {!! Form::text('name', $category->name, ['class'=>'form-control']) !!}
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-md-2">Product Count</label>
      <label class="form-control-static col-md-10">{{ $category->product_count }}</label>
    </div>
  </div>
@endsection