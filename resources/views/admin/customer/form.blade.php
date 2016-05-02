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
        <a href="#tab_general" data-toggle="tab">
          General </a>
      </li>
      <li>
        <a href="#tab_sizes" data-toggle="tab">Orders</a>
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
      <div class="tab-pane" id="tab_sizes">

      </div>
      <div class="tab-pane" id="tab_repacks">

      </div>
    </div>
  </div>
@endsection