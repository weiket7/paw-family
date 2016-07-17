
@extends("admin.template", [
  "title"=>"District Postals",
  "action"=>"index",
  "controller"=>"setting"
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
          @if($dp->cbd)
            <span class="font-green-seagreen sbold">Yes</span>
          @else
            No
          @endif
        </td>
      </tr>
    @endforeach
  </table>
@endsection