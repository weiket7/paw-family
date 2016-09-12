<?php use App\Models\Enums\ProductStat; ?>

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
      <th>Name</th>
      <th>Brand</th>
      <th>Category</th>
      {{--<th>Discounted Price</th>--}}
    </tr>
    </thead>
    <tbody>
    <tr>
      <td>
        {!! Form::select('stat', ProductStat::$values, '', ['class'=>'form-control', 'id'=>'stat']) !!}
      </td>
      <td>{!! Form::text('name', '', ['class'=>'form-control', 'id'=>'name']) !!}</td>
      <td>
        {!! Form::select('brand_id', $brands, '', ['class'=>'form-control', 'id'=>'brand_id']) !!}
      </td>
      <td>
        {!! Form::select('category_id', $categories, '', ['class'=>'form-control', 'id'=>'category_id']) !!}
      </td>
      {{--<td>
        <input type="text" class="form-control" placeholder="From">
        <input type="text" class="form-control" placeholder="To">
      </td>--}}
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

  <div class="table-responsive">
  <table class="table table-bordered table-hover">
    <thead>
    <tr>
      <th>Status</th>
      <th>Name</th>
      <th>Brand</th>
      <th>Category</th>
      {{--<th>Supplier</th>--}}
      <th>Discounted Price</th>
      <th>Price</th>
      <th>Discount</th>
      <th>Size</th>
    </tr>
    </thead>
    <tbody>
    <?php $categories = array_flatten($categories); ?>
    @foreach($products as $p)
      <tr>
        <td>{{ProductStat::$values[$p->stat]}}</td>
        <td width="450px"><a href="{{url("admin/product/save/".$p->product_id)}}">{{ $p->name }}</a></td>
        <td>
          @if(isset($brands[$p->brand_id]))
            {{ $brands[$p->brand_id] }}
          @endif
        </td>
        <td>
          @if(isset($categories[$p->category_id]))
            {{ $categories[$p->category_id] }}
          @endif
        </td>
        {{--<td>{{ $suppliers[$p->supplier_id] }}</td>--}}
        <td>${{ $p->discounted_price }}</td>
        <td>${{ $p->price }}</td>
        <td>{{ CommonHelper::showDiscountAmt($p->discount_amt, $p->discount_percentage) }}</td>
        <td>
          <table class="tbl_size">
            @foreach($p->sizes as $size)
              <tr>
                <td>{{ $size->name }}</td>
                <td>{{ $size->weight_lb }} lbs</td>
                <td>${{ $size->price }}</td>
                <td>
                  @if(isset($p->repacks[$size->size_id]))
                    {{ implode(", ", array_pluck($p->repacks[$size->size_id], "name")) }}
                  @endif
                </td>
              </tr>
            @endforeach
          </table>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
  </div>
@endsection

@section('script')
  <script type="text/javascript">
  function clearSearchProduct() {
    $("#stat").val('');
    $("input[name='name']").val('');
    $("#brand_id").val('');
    $("#category_id").val('');
  }
  </script>
@endsection
