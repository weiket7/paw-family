<?php

use App\Models\Enums\DiscountType;
use App\Models\Entities\SaleProduct;

class CommonHelper {
  public static function formatDateTime($date) {
    return date('d M Y, h:i a', strtotime($date));
  }

  public static function formatDate($date, $birthday = false) {
    if ($date == '') {
      return '';
    }
    if ($birthday) {
      return date('d-m-Y', strtotime($date));
    }
    return date('d M Y', strtotime($date));
  }

  public static function formatDateDay($date) {
    return date('d M Y, l', strtotime($date));
  }

  public static function showDiscountAmt($discount_amount, $discount_percentage) {
    if ($discount_percentage > 0) {
      return "$".$discount_amount." (".$discount_percentage."%)";
    }
    return "$".$discount_amount;
  }

  public static function formatNumber($number) {
    if (abs($number - round($number)) < 0.0001) { //whole number
      return round($number);
    }
    return number_format(round($number, 2), 2);
  }

  public static function arraySetKey($data, $key_name) {
    $res = [];
    foreach($data as $d) {
      $res[$d->$key_name] = $d;
    }
    return $res;
  }

  public static function getDiscountAmtPercentage($price, $discount_percentage) {
    return floor($price / 100 * $discount_percentage * 100) / 100;
  }

  public static function arrayForDropdown($arr, $key_name, $value_name, $with_empty = true) {
    $res = [];
    foreach($arr as $a) {
      $res[$a->$key_name] = $a->$value_name;
    }
    if ($with_empty) {
      return [''=>'']+$res;
    }
    return $res;
  }

  public static function getIdFromArr($arr, $id_name) {
    $data = [];
    foreach($arr as $a) {
      if ($a->$id_name != '' && $a->$id_name != null) {
        $data[] = $a->$id_name;
      }
    }
    return $data;
  }

  public static function getCartTotal($products) {
    $total = 0;
    /* @var $product SaleProduct */
    foreach($products as $product) {
      $total += $product->subtotal;
    }
    return CommonHelper::formatNumber($total);
  }

  public static function getCartCount($products) {
    $count = 0;
    /* @var $product SaleProduct */
    foreach($products as $product) {
      $count += $product->quantity;
    }
    return $count;
  }

  /*public static function toTwoDecimalRounddown($decimal) {
    return round($decimal, 2, PHP_ROUND_HALF_DOWN);
  }*/

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
}
