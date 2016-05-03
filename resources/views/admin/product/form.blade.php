<?php use App\Models\Enums\MainCategory; ?>
<?php use App\Models\Enums\ProductStat; ?>
<?php use App\Models\Enums\DiscountType; ?>

@extends("admin.template", [
  "title"=>ucfirst($action) . " Product",
  "action"=>$action,
])

@section("content")

  <div class="tabbable">
    <ul class="nav nav-tabs">
      <li class="active">
        <a href="#tab_general" data-toggle="tab">
          General </a>
      </li>
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
                <label class="control-label col-md-3">Name <span class="required">*</span></label>
                <div class="col-md-9">
                  {!! Form::text('name', $product->name, ['class'=>'form-control']) !!}
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Status <span class="required">*</span></label>
                <div class="col-md-9">
                  {!! Form::select('stat', [''=>'']+ProductStat::$values, $product->stat, ['class'=>'form-control']) !!}
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Brand <span class="required">*</span></label>
                <div class="col-md-9">
                  {!! Form::select('brand_id', $brands, $product->brand_id, ['class'=>'form-control']) !!}
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Category <span class="required">*</span></label>
                <div class="col-md-9">
                  {!! Form::select('category_id', $categories, $product->category_id, ['class'=>'form-control']) !!}
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
                  {!! Form::select('discount_type', DiscountType::$values, $product->discount_type, ['class'=>'form-control']) !!}
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
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Supplier</label>
                <div class="col-md-9">
                  {!! Form::select('supplier_id', $suppliers, $product->supplier_id, ['class'=>'form-control']) !!}
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">SKU</label>
                <div class="col-md-9">
                  {!! Form::text('sku', $product->sku, ['class'=>'form-control']) !!}
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Short Description</label>
                <div class="col-md-9">
                  {!! Form::text('desc_short', $product->desc_short, ['class'=>'form-control']) !!}
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Image</label>
                <div class="col-md-9">
                  @if(strlen($product->image) > 0)
                      <img src="{{url("assets/images/products/".$product->image)}}" class='thumbnail' style="max-height:200px;"/>
                  @endif
                  <input type='file' name='image'>
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
        <a href="{{url("admin/size/save?product_id=".$product->product_id)}}"><button type="button" class="btn blue btn-create">Create Size</button></a>
        <br>
        <table class="table table-bordered">
          <thead>
          <tr>
            <th width="150px">Name</th>
            <th width="100px">Quantity</th>
            <th width="140px">Discounted Price</th>
            <th width="100px">Price</th>
            <th width="150px">Discount Amount</th>
            <th width="100px">Weight (lbs)</th>
            <th>Weight (kgs)</th>
          </tr>
          </thead>
          <tbody>
          @foreach($product->sizes as $size)
            <tr>
              <td><a href="{{url("admin/size/save/".$size->size_id)}}">{{$size->name}}</a></td>
              <td>{{$size->quantity}}</td>
              <td>${{$size->discounted_price}}</td>
              <td>${{$size->price}}</td>
              <td>
                @if($size->discount_percentage > 0)
                  {{$size->discount_percentage}}%
                  (${{$size->discount_amt}})
                @else
                  ${{$size->discount_amt}}
                @endif
              </td>
              <td>{{$size->weight_lb}}</td>
              <td>{{$size->weight_kg}}</td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
      <div class="tab-pane" id="tab_repacks">
        <a href="{{url("admin/option/save?product_id=".$product->product_id)}}"><button type="button" class="btn blue btn-create">Create Repack</button></a>
        <br>
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
                    <td rowspan="{{count($product->repacks[$size->size_id])}}">
                      <a href="{{url("admin/option/save/".$r->option_id)}}">{{ $size->name }}</a></td>
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