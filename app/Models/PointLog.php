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

  public function savePointLog($customer_id, $current_points, $points, $point_type, $sale_id, $sale_no) {
    $point_log = [
      'customer_id'=>$customer_id,
      'sale_id'=>$sale_id,
      'sale_no'=>$sale_no,
      'sign'=>$point_type == PointType::Earn ? '+' : '-',
      'type'=>$point_type,
      'point_change'=>$points,
      'point_before'=>$current_points,
      'point_after'=>$current_points + $points,
      'created_on'=>date('Y-m-d H:i:s'),
    ];
    DB::table('point_log')->insert($point_log);
  }
}