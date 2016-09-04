
@extends("admin.template", [
  "title"=>"District Postals",
  "action"=>"update",
  "controller"=>"setting",
  'hide_delete'=>true,
])

@section("content")

  <table class="table table-bordered">
    <tr>
      <td width="100px">District</td>
      <td width="100px">Postal</td>
      <td>CBD</td>
    </tr>
    @foreach($district_postals as $dp)
      <tr>
        <td>{{$dp->district}}</td>
        <td>{{$dp->postal}}</td>
        <td>
          <div class="radio-list">
            <label class="radio-inline">
              {{Form::radio('cbd'.$dp->district_postal_id, 1, $dp->cbd == 1)}} Yes
            </label>
            <label class="radio-inline">
              {{Form::radio('cbd'.$dp->district_postal_id, 0, $dp->cbd == 0)}} No
            </label>
          </div>
        </td>
      </tr>
    @endforeach
  </table>
@endsection