<?php use App\Models\Enums\MainCategory; ?>

@extends("admin.template")

@section("content")
  <div class="portlet light">
    <div class="portlet-title">
      <div class="caption">
        <span class="caption-subject bold uppercase">Update Product</span>
      </div>
    </div>
    <div class="portlet-body">
      <form method="post" action="" class="form-horizontal">
        <div class="form-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Name</label>
                <div class="col-md-9">
                  <input type="text" class="form-control">
                </div>
              </div>
            </div>
            <div class="col-md-6">

            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Brand</label>
                <div class="col-md-9">
                  {!! Form::select('brand', [''=>'']+$brands, $product->brand_id, ['class'=>'form-control']) !!}
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Category</label>
                <div class="col-md-9">
                  <select class="form-control" name="category">
                    @foreach($categories as $main_category => $category)
                      <optgroup label="{{MainCategory::$values[$main_category]}}">
                        @foreach($category as $c)
                          <?php $selected = $product->category_id == $c->category_id ? "selected" : ""; ?>
                          <option value="{{$c->category_id}}" {{$selected}}>{{$c->name}}</option>
                        @endforeach
                      </optgroup>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection