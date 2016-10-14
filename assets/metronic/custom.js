
function checkCheckboxByElement(element, checked) {
  if (checked === true) {
    $(element).prop("checked", "checked");
    $(element).parent().addClass("checked")
  } else {
    $(element).prop("checked", "");
    $(element).parent().removeClass("checked")
  }
}

function isCheckedById(id) {
  return $("#"+id).is(":checked");
}

function toTwoDecimalAndRoundDown(decimal) {
  return +(Math.floor(decimal * 100) / 100).toFixed(2);
}

function roundUpToFirstDecimal(decimal) {
  return +(Math.ceil(decimal * 10) / 10).toFixed(2);
}

function countDecimals(number) {
  if(Math.floor(number.valueOf()) === number.valueOf()) return 0;
  return number.toString().split(".")[1].length || 0;
}

function toTwoDecimal(decimal) {
  return decimal.toFixed(2);
}

function toFloat(decimal) {
  return parseFloat(decimal) | 0;
}

function poundToKg(pound) {
  return pound * 0.45359237;
}

function kgToPound(kg) {
  return kg / 0.45359237;
}