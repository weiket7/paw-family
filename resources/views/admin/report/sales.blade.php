<?php use App\Models\Enums\SaleStat; ?>

@extends("admin.template", [
  "title"=>"Products",
  "action"=>"index",
  "controller"=>"product"
])

@section("content")
  <table class="table table-bordered">
    <thead>
    <tr>
      <th>Status</th>
      <th>Date</th>
    </tr>
    </thead>
    <tbody>
    <tr>
      <td>
        <div class="checkbox-list">
          @foreach(SaleStat::$values as $key => $value)
          <label>
            <input type="checkbox" value="{{$key}}"> {{$value}}
          </label>
          @endforeach
        </div>
      </td>
      <td>
        <input type="text" class="form-control" placeholder="From">
        <input type="text" class="form-control" placeholder="To">
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
      <th>Status</th>
      <th>Name</th>
      <th>Brand</th>
      <th>Category</th>
      {{--<th>Discounted Price</th>--}}
    </tr>
    </thead>
    <tbody>

    </tbody>
  </table>
@endsection
