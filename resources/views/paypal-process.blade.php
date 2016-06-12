<html>
<head>

</head>
<body onload="document.form.submit()">
{{--<body>--}}

<form name="form" action="{{$paypal_url}}" method="post">
  <input type="hidden" name="cmd" value="_xclick">
  <input type="hidden" name="business" value="{{$business}}">
  <input type="hidden" name="lc" value="SG">
  <input type="hidden" name="item_name" value="Pawfamily.sg - Order #{{$sale_no}}">
  <input type="hidden" name="amount" value="{{$amount}}">
  <input type="hidden" name="currency_code" value="SGD">
  <input type="hidden" name="no_note" value="1">
  <input type="hidden" name="no_shipping" value="1">
  <input type="hidden" name="return" value="{{$return}}">
  <input type="hidden" name="custom" value="{{$sale_no}}">
</form>

</body>
</html>