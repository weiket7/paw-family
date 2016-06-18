<?php use App\Models\Enums\SaleStat; ?>

@extends("admin.template", [
  "title"=>"Daily Sales",
  "action"=>"view",
])

@section('script')
  <script type="text/javascript">
    $(document).ready(function() {
      $(".date-picker").datepicker({
        format: "dd-mm-yyyy",
        orientation: "bottom",
      });
    })
  </script>
@endsection


@section("content")
  <table class="table table-bordered">
    <thead>
    <tr>
      <th>Date</th>
    </tr>
    </thead>
    <tbody>
    <tr>
      <td>
        <div class="input-group input-large date-picker input-daterange">
          <input type="text" class="form-control" name="from_date" value="{{$from_date}}">
          <span class="input-group-addon"> to </span>
          <input type="text" class="form-control" name="to_date" value="{{$to_date}}"> </div>
      </td>
    </tr>
    </tbody>
    <tfoot>
    <td colspan="4" class="text-center">
      <button type="submit" class="btn blue">Search</button>
      <button type="button" class="btn green" onclick="clearSearchProduct()">Clear</button> {{--TODO--}}
    </td>
    </tfoot>
  </table>
  <br>

  @if(Session::has('search_result'))
    <div class="alert alert-success ">
      {{ Session::get('search_result') }}
    </div>
  @endif

  @if(isset($rows) && count($rows))
    <table class="table table-bordered table-hover">
      <thead>
      <tr>
        <th>Date</th>
        <th>Gross Total</th>
        <th>Product Discount</th>
        <th>Promo Discount</th>
        <th>Nett Total</th>
      </tr>
      </thead>
      <tbody>
      @foreach($rows as $row)
        <tr>
          <td>{{CommonHelper::formatDate($row->sale_on)}}</td>
          <td>${{CommonHelper::formatNumber($row->gross_total)}}</td>
          <td>${{CommonHelper::formatNumber($row->product_discount)}}</td>
          <td>${{CommonHelper::formatNumber($row->promo_discount)}}</td>
          <td>${{CommonHelper::formatNumber($row->nett_total)}}</td>
        </tr>
      @endforeach
      </tbody>
    </table>
  @endif
@endsection
