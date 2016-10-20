<?php use App\Models\Enums\SaleStat; ?>
<?php use App\Models\Enums\PaymentType; ?>

@extends("admin.template", [
  "title"=>"Orders",
  "action"=>"index",
  "controller"=>"product"
])

@section("content")
  <input type="hidden" id="action" name="action">

  <table class="table table-bordered">
    <thead>
    <tr>
      <th>Status</th>
      <th>Customer</th>
      <th>Payment Type</th>
      <th>Date</th>
    </tr>
    </thead>
    <tbody>
    <tr>
      <td>
        {!! Form::select('stat', SaleStat::$values, '', ['class'=>'form-control']) !!}
      </td>
      <td>{!! Form::text('name', '', ['class'=>'form-control', 'id'=>'name']) !!}</td>
      <td>
        {!! Form::select('payment_type', PaymentType::$values, '', ['class'=>'form-control']) !!}
      </td>
      <td>
        <div class="input-group input-daterange">
          {!! Form::text('start', '', ['class'=>'form-control']) !!}
          <span class="input-group-addon"> and </span>
          {!! Form::text('end', '', ['class'=>'form-control']) !!}
        </div>
      </td>
      </tr>
    </tbody>
    <tfoot>
    <td colspan="4" class="text-center">
      <button type="button" class="btn blue" onclick="searchOrder()">Search</button>
      <button type="button" class="btn green">Clear</button>
    </td>
    </tfoot>
  </table>
  <br>

  @if(Session::has('search_result'))
    <div class="alert alert-success ">
      {{ Session::get('search_result') }}
    </div>
  @endif

  <div class="row">
    <div class="col-md-12 text-center">
      <button class="btn btn-primary" type="button" onclick="printOrder()">
        Print
      </button>
    </div>
  </div>
  <br>

  <div class="table-responsive">
  <table class="table table-bordered table-hover">
    <thead>
    <tr>
      <th width="50px">Print</th>
      <th width="150px">Status</th>
      <th width="200px">Customer</th>
      <th width="100px">Payment Type</th>
      <th width="100px">Gross</th>
      <th width="100px">Product Discount</th>
      <th width="100px">Promo Discount</th>
      <th width="100px">Nett</th>
      <th>Date</th>
    </tr>
    </thead>
    <tbody>
      @foreach($sales as $sale)
        <tr>
          <td>
            <input type="checkbox" value="{{$sale->sale_id}}" name="print[]" class="form-control">
          </td>
          <td>
            <a href="{{url("admin/sale/view/".$sale->sale_id)}}">
              {{ SaleStat::$values[$sale->stat] }}
            </a>
          </td>
          <td>
            <a href="{{url("admin/customer/save/".$sale->customer_id)}}">
              {{$sale->name}}
          </a>
          </td>
          <td>{{PaymentType::$values[$sale->payment_type]}}</td>
          <td>${{$sale->gross_total}}</td>
          <td>${{$sale->product_discount}}</td>
          <td>${{$sale->promo_discount}}</td>
          <td>${{$sale->nett_total}}</td>
          <td>{{CommonHelper::formatDateTime($sale->sale_on)}}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
  </div>

  <div class="row">
    <div class="col-md-12 text-center">
      <button class="btn btn-primary" type="button" onclick="printOrder()">
        Print
      </button>
    </div>
  </div>
@endsection

@section('script')
  <script>
    $('.input-daterange').datepicker({
      todayHighlight: true,
      format : "dd M yy",
      autoclose: true,
      endDate: '+0d'
    });

    function searchOrder() {
      $("#action").val('search');
      $("form").submit();
    }

    function printOrder() {
      $("#action").val('print');
      $("form").submit();
    }
  </script>
@endsection