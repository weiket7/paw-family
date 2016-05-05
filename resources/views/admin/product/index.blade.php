@extends("admin.template", [
  "title"=>"Products",
  "action"=>"index",
  "controller"=>"product"
])

@section("content")
  <table class="table table-bordered">
    <thead>
    <tr>
      <th>Name</th>
      <th>Brand</th>
      <th>Category</th>
      <th>Price</th>
    </tr>
    </thead>
    <tbody>
    <tr>
      <td><input type="text" name="name" class="form-control"></td>
      <td>
        {!! Form::select('brand_id', $brands, '', ['class'=>'form-control']) !!}
      </td>
      <td>
        {!! Form::select('category_id', $categories, '', ['class'=>'form-control']) !!}
      </td>
      <td>
        <input type="text" class="form-control" placeholder="From">
        <input type="text" class="form-control" placeholder="To">
      </td>
    </tr>
    </tbody>
    <tfoot>
    <td colspan="4" class="text-center"><button type="submit" class="btn blue">Search</button></td>
    </tfoot>
  </table>

  <hr>

  <table class="table table-bordered table-hover">
    <thead>
    <tr>
      <th>Name</th>
      <th>Brand</th>
      <th>Category</th>
      <th>Supplier</th>
      <th>Discounted Price</th>
      <th>Price</th>
      <th>Discount</th>
      <th>Size</th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $p)
      <tr>
        <td width="450px"><a href="{{url("admin/product/save/".$p->product_id)}}">{{ $p->name }}</a></td>
        <td>{{ $p->brand_name }}</td>
        <td>{{ $p->category_name }}</td>
        <td>{{ $p->supplier_id }}</td>
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
@endsection