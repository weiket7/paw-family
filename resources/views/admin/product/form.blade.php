<?php use App\Models\Enums\MainCategory; ?>
<?php use App\Models\Enums\ProductStat; ?>
<?php use App\Models\Enums\DiscountType; ?>

@extends("admin.template", [
  "title"=>ucfirst($action) . " Product",
  "form"=>true,
])

@section("content")

  <div class="tabbable">
    <ul class="nav nav-tabs">
      <li class="active">
        <a href="#tab_general" data-toggle="tab">
          General </a>
      </li>
      {{--<li>--}}
      {{--<a href="#tab_details" data-toggle="tab">--}}
      {{--Details </a>--}}
      {{--</li>--}}
      <li>
        <a href="#tab_sizes" data-toggle="tab">Sizes</a>
      </li>
      <li>
        <a href="#tab_repacks" data-toggle="tab">Repacks</a>
      </li>
    </ul>
    <div class="tab-content no-space">
      <div class="tab-pane active" id="tab_general">
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
      <div class="tab-pane" id="tab_sizes">
        <table class="table table-bordered">
          <thead>
          <tr>
            <th width="150px">Name</th>
            <th width="100px">Quantity</th>
            <th width="100px">Price</th>
            <th width="150px">Discount Amount</th>
            <th width="150px">Discount Type</th>
            <th width="100px">Weight (lbs)</th>
            <th>Weight (kgs)</th>
          </tr>
          </thead>
          <tbody>
          @foreach($product->sizes as $size)
            <tr>
              <td><a href="{{url("admin/size/save/".$size->size_id)}}">{{$size->name}}</a></td>
              <td>{{$size->quantity}}</td>
              <td>{{$size->price}}</td>
              <td>{{$size->discount_amt}}</td>
              <td>{{DiscountType::$values[$size->discount_type]}}</td>
              <td>{{$size->weight_lb}}</td>
              <td>{{$size->weight_kg}}</td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
      <div class="tab-pane" id="tab_repacks">
        <table class="table table-bordered">
          <thead>
          <tr>
            <th width="150px">Size</th>
            <th width="200px">Name</th>
            <th>Price</th>
          </tr>
          </thead>
          <tbody>
          @foreach($product->sizes as $size)
            <?php $size_shown = false ?>
            @if(isset($product->repacks[$size->size_id]))
              @foreach($product->repacks[$size->size_id] as $r)
                <tr>
                  @if($size_shown == false)
                    <td rowspan="{{count($product->repacks[$size->size_id])}}">{{ $size->name }}</td>
                    <?php $size_shown = true; ?>
                  @endif
                  <td>
                    {{ $r->name}}
                  </td>
                  <td>
                    ${{ $r->price}}
                  </td>
                </tr>
              @endforeach
            @endif
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

@endsection