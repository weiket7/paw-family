<?php namespace App\Models;

use Eloquent, DB, Validator, Input;

class Size extends Eloquent
{
  public $table = 'size';
  protected $primaryKey = 'size_id';
  protected $validation;

  public function getSize($size_id) {
    $s = "SELECT size_id, s.name, p.name as product_name, s.price, s.quantity, s.weight_lb, s.weight_kg, s.discount_amt, s.discount_type
    from size as s
    inner join product as p on s.product_id = p.product_id
    where size_id = :size_id";
    $p['size_id'] = $size_id;
    $data = DB::select($s, $p);
    return $data[0];
  }
}