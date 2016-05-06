
function checkCheckboxByElement(element, checked) {
  if (checked === true) {
    $(element).prop("checked", "checked");
    $(element).parent().addClass("checked")
  } else {
    $(element).prop("checked", "");
    $(element).parent().removeClass("checked")
  }
}

function isCheckedByElement(element) {
  return $(element).is(":checked");
}

function toTwoDecimal(decimal) {
  return parseFloat(Math.round(decimal * 100) / 100).toFixed(2);
}

function toFloat(decimal) {
  return parseFloat(decimal) | 0;
}