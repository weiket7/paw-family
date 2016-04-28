
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