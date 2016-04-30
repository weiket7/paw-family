<?php

use App\Models\Enums\DiscountType;

class CommonHelper {
  public static function formatDateTime($date) {
    return date('d M Y, h:i a', strtotime($date));
  }

  public static function formatDate($date) {
    return date('d M Y', strtotime($date));
  }

  public static function getPriceAfterDiscount($price, $discount_amt, $discount_type) {
    if ($discount_type == null || $discount_type == DiscountType::Amount) {
      return $price - $discount_amt;
    }
    return round($price - ($discount_amt / 100 * $price), 2);
  }

  public static function getDiscountAmt($price, $discount_amt, $discount_type = null) {
    if ($discount_type == null || $discount_type == DiscountType::Amount) {
      return $discount_amt;
    }
    return round($discount_amt / 100 * $price, 2);
  }

  public static function getImageDir() {
    if (App::environment('local')) {
      return $_SERVER['DOCUMENT_ROOT'] . "adoptadog/images/";
    } else if (App::environment('production')) {
      return $_SERVER['DOCUMENT_ROOT'] . "/images/";
    }
  }

  public static function getFileName($name, $file) {
    $fileName = trim($name);
    $fileName = strtolower($fileName);
    $fileName = preg_replace('/[^A-Za-z0-9\-]/', '', $fileName);
    $fileName = str_replace(array(' ', '-'), '_', $fileName);
    $fileName = $fileName.'.'.$file->getClientOriginalExtension();
    return $fileName;
  }

  public static function formatVetTime($time) {
    if ($time == "") {
      return "";
    }
    $time_arr = explode("-", $time);
    return date('g:ia', strtotime($time_arr[0])). " - ". date('g:ia', strtotime($time_arr[1]));
  }
}
