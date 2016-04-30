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

  public static function uploadImage($folder, $name, $image) {
    if (App::environment('local')) {
      $base_path = $_SERVER['DOCUMENT_ROOT'] . "/pawfamily/assets/images/";
    } else {
      $base_path = $_SERVER['DOCUMENT_ROOT'] . "/assets/images/";
    }

    $destination_path = $base_path . $folder . "/";
    $file_name = str_slug($name).'.'.$image->getClientOriginalExtension();
    $image->move($destination_path, $file_name);
    return $file_name;
  }

  public static function formatVetTime($time) {
    if ($time == "") {
      return "";
    }
    $time_arr = explode("-", $time);
    return date('g:ia', strtotime($time_arr[0])). " - ". date('g:ia', strtotime($time_arr[1]));
  }
}
