function toTwoDecimal(decimal) {
  return parseFloat(Math.round(decimal * 100) / 100).toFixed(2);
}

function redirect(url) {
  window.location.replace(url);
}

function getObjectSize(object) {
  return Object.keys(object).length
}