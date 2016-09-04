@extends("admin.template", [
  "title"=>"Delivery Dates",
  "action"=>"view",
  "controller"=>"delivery"
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
      <th>Status</th>
      <th>Area</th>
    </tr>
    </thead>
    <tbody>
    <tr>
      <td>
        <div class="radio-list">
          <label><input type="radio" name='stat' value="1" class="form-control"> Enable</label>
          <label><input type="radio" name='stat' value="0" class="form-control"> Disable</label>
        </div>
      </td>
      <td>
        <input type="text" name='area' class="form-control">
      </td>
    </tr>
    </tbody>
    <tfoot>
    <td colspan="3" class="text-center">
      <button type="submit" class="btn blue">Submit</button>
    </td>
    </tfoot>
  </table>
  <br>

  <div class="table-responsive">
  <table class="table table-bordered table-hover">
    <thead>
    <tr>
      <th width="50px"></th>
      <th width="150px">Date</th>
      <th width="150px">Day</th>
      <th>Area</th>
    </tr>
    </thead>
    <tbody>
    <?php $days = [1=>'Monday', 2=>'Tuesday', 3=>'Wednesday', 4=>'Thursday', 5=>'Friday', 6=>'Saturday', 7=>'Sunday']; ?>
    @foreach($dates as $date)
      <tr>
        <td><input type="checkbox" name="dates[]" class="form-control" value="{{$date->date_value}}"></td>
        <td>
          @if($date->stat)
            <span class="font-green-meadow">{{CommonHelper::formatDate($date->date_value)}}</span>
          @else
            <span class="font-grey-salsa">{{CommonHelper::formatDate($date->date_value)}}</span>
          @endif
        </td>
        <td>{{$days[$date->day]}}</td>
        <td>{{$date->area}}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
  </div>
@endsection