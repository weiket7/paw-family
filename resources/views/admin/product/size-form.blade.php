<?php use App\Models\Enums\DiscountType; ?>

@extends("admin.template", [
  "title"=>ucfirst($action) . " Size",
  "action"=>$action,
  "back_link"=>url('admin/product/save/'.$product->product_id)
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
  <div class="form-body">
    <div class="form-group">
      <label class="control-label col-md-2">Product</label>
      <label class="form-control-static col-md-10">{{ $product->name }}</label>
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
      <label class="control-label col-md-2">Cost Price</label>
      <div class="col-md-10">
        <div class="input-icon">
          <i class="fa fa-dollar"></i>
          {!! Form::text('cost_price', $size->cost_price, ['class'=>'form-control']) !!}
        </div>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2">Price</label>
      <div class="col-md-10">
        <div class="input-icon">
          <i class="fa fa-dollar"></i>
          {!! Form::text('price', $size->price, ['class'=>'form-control']) !!}
        </div>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2">Discounted Price</label>
      <div class="col-md-10">
        <div class="input-icon">
          <i class="fa fa-dollar"></i>
          {!! Form::text('discounted_price', $size->discounted_price, ['class'=>'form-control']) !!}
          <button class="btn green" type="button" id="btn-calculate">Calculate</button>
          &nbsp;&nbsp;&nbsp;<label><input type="checkbox" id='round-up-to-first-decimal' name="round-up-to-first-decimal" class="form-control"> Round up to nearest 10 cents</label>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2">Discount Amount</label>
      <div class="col-md-10">
        <div class="input-icon">
          <i class="fa fa-dollar"></i>
          {!! Form::text('discount_amt', $size->discount_amt, ['class'=>'form-control']) !!}
        </div>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2">Discount Percentage</label>
      <div class="col-md-10">
        <div class="input-icon">
          <i class="fa fa-percent"></i>
          {!! Form::text('discount_percentage', $size->discount_percentage, ['class'=>'form-control']) !!}
        </div>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2">Weight<br><small>(2 decimal places)</small></label>
      <div class="col-md-10">
        {!! Form::text('weight', $size->weight, ['class'=>'form-control']) !!}
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2">Weight UOM</label>
      <div class="col-md-10">
        {!! Form::text('weight_uom', $size->weight_uom, ['class'=>'form-control']) !!}
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2">SKU</label>
      <div class="col-md-10">
        {!! Form::text('sku', $size->sku, ['class'=>'form-control']) !!}
      </div>
    </div>
  </div>
@stop

