function toTwoDecimal(decimal) {
  return parseFloat(Math.round(decimal * 100) / 100).toFixed(2);
}

function redirect(url) {
  window.location.replace(url);
}

function getObjectSize(object) {
  return Object.keys(object).length
}

function removeDollarAndToFloat(string) {
  string = string.replace('$', '')
  string = string.replace(',', '')
  return parseFloat(string);
}

function isDefined(obj) {
  return typeof obj !== 'undefined';
}

function scrollToAnchor(aid){
  var aTag = $("a[name='"+ aid +"']");
  $('html,body').animate({scrollTop: aTag.offset().top},'slow');
}