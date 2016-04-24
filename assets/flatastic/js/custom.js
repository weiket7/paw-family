function toTwoDecimal(decimal) {
  return parseFloat(Math.round(decimal * 100) / 100).toFixed(2);
}