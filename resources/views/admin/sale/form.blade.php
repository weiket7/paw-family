<?php use App\Models\Enums\SaleStat; ?>
<?php use App\Models\Enums\PaymentType; ?>
<?php use App\Models\Enums\DeliveryChoice; ?>

@extends("admin.template", [
  "title"=>"Size",
  "action"=>"index",
  "controller"=>"product"
])

@section("content")
  <div class="form-body">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">Order No</label>
          <label class="form-control-static col-md-9">{{$sale->sale_no}}</label>
        </div>

      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">Customer</label>
          <label class="form-control-static col-md-9">{{$sale->customer_id}}</label>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">Date</label>
          <label class="form-control-static col-md-9">{{CommonHelper::formatDate($sale->sale_on)}}</label>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">Status</label>
          <div class="col-md-9">
            {{ Form::select("stat", SaleStat::$values, $sale->stat, ['class'=>'form-control']) }}
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">Payment Type</label>
          <div class="col-md-9">
            {{ Form::select("payment_type", PaymentType::$values, $sale->payment_type, ['class'=>'form-control']) }}
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3"></label>
          <div class="col-md-9">

          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">Gross Total</label>
          <label class="form-control-static col-md-9">{{$sale->gross_total}}</label>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">Nett Total</label>
          <label class="form-control-static col-md-9">{{$sale->nett_total}}</label>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">Product Discount</label>
          <label class="form-control-static col-md-9">{{$sale->product_discount}}</label>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">Promo Discount</label>
          <label class="form-control-static col-md-9">{{$sale->promo_discount}}</label>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">Delivery Choice</label>
          <label class="form-control-static col-md-9">{{DeliveryChoice::$values[$sale->delivery_choice]}}</label>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">Delivery Address</label>
          <label class="form-control-static col-md-9">{{$sale->delivery_address}}</label>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">Delivery Time</label>
          <label class="form-control-static col-md-9">{{$sale->delivery_time}}</label>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3"></label>
          <label class="form-control-static col-md-9">{{$sale->delivery_address}}</label>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">Customer Remark</label>
          <label class="form-control-static col-md-9">{{$sale->customer_remark}}</label>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">Operator Remark</label>
          <label class="form-control-static col-md-9">{{$sale->delivery_address}}</label>
        </div>
      </div>
    </div>
  </div>
@endsection