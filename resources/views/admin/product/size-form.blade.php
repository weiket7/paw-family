<?php use App\Models\Enums\DiscountType; ?>

@extends("admin.template", [
  "title"=>ucfirst($action) . " Size",
  "action"=>$action,
])

@section('script')
  <script type="text/javascript">
    $("#btn-calculate").click(function() {
      var price = parseFloat($("input[name='price']").val());
      var discount_percentage = toFloat($("input[name='discount_percentage']").val());
      var discounted_price = 0;
      if (discount_percentage == 0) {
        var discount_amt = toFloat($("input[name='discount_amt']").val());
        discounted_price = toTwoDecimalAndRoundDown(price - discount_amt);
      } else {
        discount_amt = toTwoDecimalAndRoundDown(price / 100 * discount_percentage);
        $("input[name='discount_amt']").val(discount_amt);
        discounted_price = toTwoDecimalAndRoundDown(price - discount_amt);
      }
      $("input[name='discounted_price']").val(toTwoDecimalAndRoundDown(discounted_price));
      console.log('price='+price+' discount_amt='+discount_amt+' discount_percentage='+discount_percentage+' discounted_price='+discounted_price);
    });
  </script>
@endsection

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

