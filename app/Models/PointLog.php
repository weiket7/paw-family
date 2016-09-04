<?php namespace App\Models;

use App\Models\Enums\PointType;
use CommonHelper;
use Eloquent, DB, Validator, Input;

class PointLog extends Eloquent
{
  public $table = 'point_log';
  protected $primaryKey = 'point_log_id';
  protected $validation;
  public $timestamps = false;

  public function savePointLog($customer_id, $current_points, $points, $point_type, $sale_id = '', $sale_no = '') {
    $point_log = [
      'customer_id'=>$customer_id,
      'sale_id'=>$sale_id,
      'sale_no'=>$sale_no,
      'type'=>$point_type,
      'point_change'=>$points,
      'point_before'=>$current_points,
      'created_on'=>date('Y-m-d H:i:s'),
    ];

    if ($point_type == PointType::Overwrite) {
      $point_log['sign'] = '';
      $point_log['point_after'] = $points;
    } else if ($point_type == PointType::Earn) {
      $point_log['sign'] = '+';
      $point_log['point_after'] = $current_points + $points;
    } else {
      $point_log['sign'] = '-';
      $point_log['point_after'] = $current_points + $points;
    }
    DB::table('point_log')->insert($point_log);
  }
}