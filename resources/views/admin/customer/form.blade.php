<?php use App\Models\Enums\CustomerStat; ?>

@extends("admin.template", [
  "title"=>"Update Customer",
  "action"=>"update",
  "controller"=>"product"
])

@section("content")
  <div class="tabbable">
    <ul class="nav nav-tabs">
      <li class="active">
        <a href="#tab-general" data-toggle="tab">
          General </a>
      </li>
      <li>
        <a href="#tab-pets" data-toggle="tab">Pets</a>
      </li>
      <li>
        <a href="#tab-orders" data-toggle="tab">Orders</a>
      </li>
      <li>
        <a href="#tab-password" data-toggle="tab">Change Password</a>
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
                  {!! Form::text('name', $customer->name, ['class'=>'form-control']) !!}
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Status <span class="required">*</span></label>
                <div class="col-md-9">
                  {!! Form::select('stat', [''=>'']+CustomerStat::$values, $customer->stat, ['class'=>'form-control']) !!}
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Email <span class="required">*</span></label>
                <div class="col-md-9">
                  {!! Form::text('email', $customer->email, ['class'=>'form-control']) !!}
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Birthday</label>
                <div class="col-md-9">
                  {!! Form::text('birthday', CommonHelper::formatDate($customer->birthday), ['class'=>'form-control']) !!}
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Mobile <span class="required">*</span></label>
                <div class="col-md-9">
                  {!! Form::text('mobile', $customer->mobile, ['class'=>'form-control']) !!}
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Phone</label>
                <div class="col-md-9">
                  {!! Form::text('phone', $customer->phone, ['class'=>'form-control']) !!}
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Address</label>
                <div class="col-md-9">
                  {!! Form::textarea('address', $customer->address, ['class'=>'form-control', 'rows'=>2]) !!}
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Postal</label>
                <div class="col-md-9">
                  {!! Form::text('postal', $customer->postal, ['class'=>'form-control']) !!}
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Last Login On</label>
                <label class="form-control-static col-md-9">
                  {{ CommonHelper::formatDateTime($customer->last_login_on) }}
                </label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Joined On</label>
                <label class="form-control-static col-md-9">
                  {{ CommonHelper::formatDateTime($customer->joined_on) }}
                </label>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane" id="tab-pets">
        <table class="table table-bordered">
          <thead>
          <tr>
            <th>Name</th>
            <th>Species</th>
            <th>Breed</th>
            <th>Adopted</th>
            <th>Birthday</th>
          </tr>
          </thead>
          <tbody>
          @foreach($customer->pets as $pet)
            <tr>
              <td>{{$pet->name}}</td>
              <td>{{\App\Models\Enums\PetSpecies::$values[$pet->species]}}</td>
              <td>{{$pet->breed}}</td>
              <td>@if($pet->adopted == "Y") Yes @else No @endif</td>
              <td>{{CommonHelper::formatDate($pet->birthday)}}</td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
      <div class="tab-pane" id="tab-orders">
        <table class="table table-bordered">
          <thead>
          <tr>
            <th>Date</th>
            <th>Code</th>
            <th>Status</th>
            <th>Payment Type</th>
            <th>Gross</th>
            <th>Product Discount</th>
            <th>Promo Discount</th>
            <th>Flat Discount</th>
            <th>Delivery Fee</th>
            <th>Nett</th>
          </tr>
          </thead>
          <tbody>
          @foreach($customer->sales as $sale)
            <tr>
              <td>{{CommonHelper::formatDateTime($sale->sale_on)}}</td>
              <td><a href="{{url("admin/sale/save/".$sale->sale_id)}}">{{$sale->sale_no}}</a></td>
              <td>{{\App\Models\Enums\SaleStat::$values[$sale->stat]}}</td>
              <td>{{\App\Models\Enums\PaymentType::$values[$sale->payment_type]}}</td>
              <td>{{$sale->gross_total}}</td>
              <td>{{$sale->product_discount}}</td>
              <td>{{$sale->promo_discount}}</td>
              <td>{{$sale->flat_discount}}</td>
              <td>{{$sale->delivery_fee}}</td>
              <td>{{$sale->nett_total}}</td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
      <div class="tab-pane" id="tab-password">

      </div>
    </div>
  </div>
@endsection