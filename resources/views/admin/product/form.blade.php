<?php use App\Models\Enums\MainCategory; ?>
<?php use App\Models\Enums\ProductStat; ?>
<?php use App\Models\Enums\DiscountType; ?>

@extends("admin.template")

@section("content")
  <form method="post" action="" class="form-horizontal">
    {!! csrf_field() !!}
    <div class="portlet light">
      <div class="portlet-title">
        <div class='row'>
          <div class='col-xs-6'>
            <h3 class="page-title">{{ ucfirst(Request::segment(3)) }} Product</h3>
          </div>
          <div class='col-xs-6 text-right'>
            <button class="btn green-haze" type="submit"><i class="fa fa-check"></i> Save</button>
            <button type="button" name="back" class="btn btn-default" onclick="history.go(-1)"><i class="fa fa-angle-left"></i> Back</button>
          </div>
        </div>

        @if(Session::has('msg'))
          <div class="alert alert-success ">
            {{ Session::get('msg') }}
          </div>
        @endif
      </div>
      <div class="portlet-body">
        <div class="form-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Name</label>
                <div class="col-md-9">
                  {!! Form::text('name', $product->name, ['class'=>'form-control']) !!}
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Status</label>
                <div class="col-md-9">
                  {!! Form::select('stat', [''=>'']+ProductStat::$values, $product->stat, ['class'=>'form-control']) !!}
                </div>
              </div>
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
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Price ($)</label>
                <div class="col-md-9">
                  {!! Form::text('price', $product->price, ['class'=>'form-control']) !!}
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Processing Days</label>
                <div class="col-md-9">
                  {!! Form::text('processing_day', $product->processing_day, ['class'=>'form-control']) !!}
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Weight (lbs)</label>
                <div class="col-md-9">
                  {!! Form::text('weight_lb', $product->weight_lb, ['class'=>'form-control']) !!}
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Weight (kgs)</label>
                <div class="col-md-9">
                  {!! Form::text('weight_kg', $product->weight_kg, ['class'=>'form-control']) !!}
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Discount Type</label>
                <div class="col-md-9">
                  {!! Form::select('discount_type', [''=>'']+DiscountType::$values, $product->discount_type, ['class'=>'form-control']) !!}
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Discount Amount</label>
                <div class="col-md-9">
                  {!! Form::text('discount_amt', $product->discount_amt, ['class'=>'form-control']) !!}
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="control-label col-md-2">Short Description</label>
                <div class="col-md-10">
                  {!! Form::text('desc_short', $product->desc_short, ['class'=>'form-control']) !!}
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="control-label col-md-2">Long Description</label>
                <div class="col-md-10">
                  {!! Form::textarea('desc_long', $product->desc_long, ['class'=>'form-control']) !!}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>

@endsection