<?php use App\Models\Enums\MainCategory; ?>
<?php use App\Models\Enums\ProductDescType; ?>
<?php use App\Models\Enums\ProductStat; ?>
<?php use App\Models\Enums\DiscountType; ?>
<?php use App\Models\Enums\ProductTag; ?>

@extends("admin.template", [
  "title"=>ucfirst($action) . " Product",
  "action"=>$action,
])

@section('script')
  <script type="text/javascript">
    $("#btn-calculate").click(function() {
      var price = parseFloat($("input[name='price']").val());
      var discount_percentage = toFloat($("input[name='discount_percentage']").val());
      var discounted_price = 0;
      var round_up_to_first_decimal = isCheckedById('round-up-to-first-decimal');
      if (discount_percentage == 0) {
        var discount_amt = toFloat($("input[name='discount_amt']").val());
        discounted_price = toTwoDecimalAndRoundDown(price - discount_amt);
      } else {
        discount_amt = toTwoDecimalAndRoundDown(price / 100 * discount_percentage);
        $("input[name='discount_amt']").val(discount_amt);
        discounted_price = toTwoDecimalAndRoundDown(price - discount_amt);
      }
      if (round_up_to_first_decimal) {
        discounted_price = roundUpToFirstDecimal(discounted_price);
        discount_amt = toTwoDecimal(price - discounted_price);
        //console.log('price=' + price + ' discounted_price=' + discounted_price + 'discount_amt=' + discount_amt);
        $("input[name='discount_amt']").val(discount_amt);
      }

      //console.log('round_up_to_ten_cent=' + round_up_to_ten_cent);
      //console.log('price='+price+' discount_amt='+discount_amt+' discount_percentage='+discount_percentage+' discounted_price='+discounted_price);
      $("input[name='discounted_price']").val(discounted_price);
    });
  </script>
@endsection

@section("content")
  <div class="tabbable">
    <ul class="nav nav-tabs">
      <li class="active">
        <a href="#tab-general" data-toggle="tab">
          General </a>
      </li>
      <li>
        <a href="#tab-sizes" data-toggle="tab">Sizes</a>
      </li>
      <li>
        <a href="#tab-repacks" data-toggle="tab">Repacks</a>
      </li>
      <li>
        <a href="#tab-descriptions" data-toggle="tab">Descriptions</a>
      </li>
    </ul>
    <div class="tab-content no-space">
      <div class="tab-pane active" id="tab-general">
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
                <label class="control-label col-md-3">Cost Price</label>
                <div class="col-md-9">
                  <div class="input-icon">
                    <i class="fa fa-dollar"></i>
                    {!! Form::text('cost_price', $product->cost_price, ['class'=>'form-control']) !!}
                  </div>
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
                <label class="control-label col-md-3">Selling Price</label>
                <div class="col-md-9">
                  <div class="input-icon">
                    <i class="fa fa-dollar"></i>
                    {!! Form::text('price', $product->price, ['class'=>'form-control']) !!}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Discount Amount</label>
                <div class="col-md-9">
                  <div class="input-icon">
                    <i class="fa fa-dollar"></i>
                    {!! Form::text('discount_amt', $product->discount_amt, ['class'=>'form-control']) !!}
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Discounted Price</label>
                <div class="col-md-9">
                  <div class="input-icon">
                    <i class="fa fa-dollar"></i>
                    {!! Form::text('discounted_price', $product->discounted_price, ['class'=>'form-control']) !!}
                    <button class="btn green" type="button" id="btn-calculate">Calculate</button>
                    &nbsp;&nbsp;&nbsp;
                    <label>
                      {{ Form::checkbox('round_up_ten_cent', 1, $product->round_up_ten_cent, ['id'=>'round-up-to-first-decimal', 'class'=>'form-control']) }} Round up to nearest 10 cents
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Discount Percentage</label>
                <div class="col-md-9">
                  <div class="input-icon">
                    <i class="fa fa-percent"></i>
                    {!! Form::text('discount_percentage', $product->discount_percentage, ['class'=>'form-control']) !!}
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Bulk Discount</label>
                <div class="col-md-9">
                  <div class="radio-list">
                    <label class="radio-inline">
                      {{ Form::radio('bulk_discount_applicable', 1, $product->bulk_discount_applicable==1) }} Applicable
                    </label>
                    <label class="radio-inline">
                      {{ Form::radio('bulk_discount_applicable', 0, $product->bulk_discount_applicable==0) }} Not Applicable
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Product Tag</label>
                <div class="col-md-9">
                  {!! Form::select('tag', [''=>'']+ProductTag::$values, $product->tag, ['class'=>'form-control']) !!}
                  </div>
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
                <label class="control-label col-md-3">Weight<br><small>(2 decimal places)</small></label>
                <div class="col-md-9">
                  {!! Form::text('weight', $product->weight, ['class'=>'form-control']) !!}
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Weight UOM</label>
                <div class="col-md-9">
                  {!! Form::text('weight_uom', $product->weight_uom, ['class'=>'form-control']) !!}
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Meta Keywords</label>
                <div class="col-md-9">
                  {!! Form::textarea('meta_keyword', $product->meta_keyword, ['class'=>'form-control', 'rows'=>5]) !!}
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Meta Description</label>
                <div class="col-md-9">
                  {!! Form::textarea('meta_desc', $product->meta_desc, ['class'=>'form-control', 'rows'=>5]) !!}
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
                <label class="control-label col-md-3">
                  Image<br>
                  <span class="help-block"> 242px width x 322px height</span>
                </label>
                <div class="col-md-9">
                  @if(strlen($product->image) > 0)
                    <img src="{{url("assets/images/products/".$product->image)}}" class='thumbnail' style="max-height:200px;"/>
                  @endif
                  <input type='file' name='image'>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane" id="tab-sizes">
        <a href="{{url("admin/product/size/save?product_id=".$product->product_id)}}"><button type="button" class="btn blue btn-create">Create Size</button></a>
        <br>
        <table class="table table-bordered">
          <thead>
          <tr>
            <th width="100px">Position</th>
            <th width="150px">Name</th>
            <th width="100px">Quantity</th>
            <th width="140px">Discounted Price</th>
            <th width="100px">Price</th>
            <th width="150px">Discount Amount</th>
            <th width="100px">Weight</th>
            <th width="120px">Weight UOM</th>
            <th>SKU</th>
          </tr>
          </thead>
          <tbody>
          @foreach($product->sizes as $size)
            <tr>
              <td><input type="text" name="pos{{$size->size_id}}" value="{{$size->pos}}" class="form-control txt-num"></td>
              <td><a href="{{url("admin/product/size/save/".$size->size_id)}}">{{$size->name}}</a></td>
              <td>{{$size->quantity}}</td>
              <td>${{$size->discounted_price}}</td>
              <td>${{$size->price}}</td>
              <td>
                {{ CommonHelper::showDiscountAmt($size->discount_amt, $size->discount_percentage) }}
              </td>
              <td>{{$size->weight}}</td>
              <td>{{$size->weight_uom}}</td>
              <td>{{$size->sku}}</td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
      <div class="tab-pane" id="tab-repacks">
        <a href="{{url("admin/product/option/save?product_id=".$product->product_id)}}"><button type="button" class="btn blue btn-create">Create Repack</button></a>
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
                      <a href="{{url("admin/product/option/save/".$r->option_id)}}">{{ $size->name }}</a></td>
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
      <div class="tab-pane" id="tab-descriptions">
        <a href="{{url("admin/product/desc/save?product_id=".$product->product_id)}}"><button type="button" class="btn blue btn-create">Create Description</button></a>
        <br>
        <table class="table table-bordered">
          <thead>
          <tr>
            <th width="150px">Type</th>
            <th>Value</th>
          </tr>
          </thead>
          <tbody>
          @foreach($product->descs as $desc)
            <tr>
              <td><a href="{{url("admin/product/desc/save/".$desc->desc_id)}}">{{ProductDescType::$values[$desc->type]}}</a></td>
              <td>{!! nl2br($desc->value) !!}</td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

@endsection