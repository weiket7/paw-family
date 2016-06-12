<?php namespace App\Models;

use App\Models\Enums\DiscountType;
use CommonHelper;
use Eloquent, DB, Validator;

class Featured extends Eloquent
{
  public $table = 'featured';
  protected $primaryKey = 'featured_id';
  protected $validation;
  public $timestamps = false;

  private $rules = [
    'product_id' => 'required',
    'type' => 'required',
  ];

  private $messages = [
    'product_id.required' => 'Product is required',
    'type.required' => 'Type is required',
  ];


  public function saveFeatured($input) {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    if ( $this->validation->fails() ) {
      return false;
    }

    $this->product_id = $input['product_id'];
    $this->type = $input['type'];
    $this->save();
    return true;
  }


  public function getFeaturedAll() {
    $s = "SELECT f.product_id, f.featured_id, p.name, p.desc_short, p.stat as product_stat, p.image, p.slug, f.type as featured_type, pos
      FROM featured AS f
      inner join product as p on f.product_id = p.product_id
      order by pos";
    $data = DB::select($s);

    $res = [];
    foreach($data as $d) {
      $res[$d->featured_type][] = $d;
    }
    return $res;
  }

  public function getValidation()
  {
    return $this->validation;
  }
}