<?php use App\Models\Enums\SaleStat; ?>
<?php use App\Models\Enums\PaymentType; ?>

@extends("admin.template", [
  "title"=>"Orders",
  "action"=>"index",
  "controller"=>"product"
])

@section("content")
  <table class="table table-bordered">
    <thead>
    <tr>
      <th>Status</th>
      <th>Customer</th>
      <th>Payment</th>
      <th>Date</th>
    </tr>
    </thead>
    <tbody>
    <tr>
      <td>
        {!! Form::select('stat', SaleStat::$values, '', ['class'=>'form-control', 'id'=>'stat']) !!}
      </td>
      <td>{!! Form::text('name', '', ['class'=>'form-control', 'id'=>'name']) !!}</td>
      <td>
        {!! Form::select('payment', PaymentType::$values, '', ['class'=>'form-control', 'id'=>'brand_id']) !!}
      </td>
      <td>

      </td>
      </tr>
    </tbody>
    <tfoot>
    <td colspan="4" class="text-center">
      <button type="submit" class="btn blue">Search</button>
      <button type="button" class="btn green" onclick="clearSearchProduct()">Clear</button>
    </td>
    </tfoot>
  </table>
  <br>

  @if(Session::has('search_result'))
    <div class="alert alert-success ">
      {{ Session::get('search_result') }}
    </div>
  @endif

  <table class="table table-bordered table-hover">
    <thead>
    <tr>
      <th width="100px">Status</th>
      <th width="200px">Customer</th>
      <th width="100px">Gross</th>
      <th width="100px">Product Discount</th>
      <th width="100px">Promo Discount</th>
      <th width="100px">Nett</th>
      <th width="100px">Payment</th>
      <th>Date</th>
    </tr>
    </thead>
    <tbody>
      @foreach($sales as $sale)
        <tr>
          <td>
            <a href="{{url("admin/sale/save/".$sale->sale_id)}}">
              {{ SaleStat::$values[$sale->stat] }}
            </a>
          </td>
          <td>
            <a href="{{url("admin/customer/save/".$sale->customer_id)}}">
              {{$sale->name}}
            </a>
          </td>
          <td>${{$sale->gross_total}}</td>
          <td>${{$sale->product_discount}}</td>
          <td>${{$sale->promo_discount}}</td>
          <td>${{$sale->nett_total}}</td>
          <td>{{PaymentType::$values[$sale->payment_type]}}</td>
          <td>{{CommonHelper::formatDateTime($sale->sale_on)}}</td>
        </tr>
      @endforeach
    </tbody>
  </table>


@endsection