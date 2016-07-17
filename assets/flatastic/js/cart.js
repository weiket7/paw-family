function validateQuantity(element) {
  var quantity = element.val();
  quantity = toFloat(quantity);
  if(quantity == 0) {
    toastr.error('Enter valid quantity');
    element.addClass('txt-quantity-error');
    return false;
  }
  element.removeClass('txt-quantity-error');
  toastr.clear();
  return true;
}
