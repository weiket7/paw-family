<?php namespace App\Models;

use Carbon\Carbon;
use CommonHelper;
use Eloquent, DB, Validator, Input;

class DeliveryDate extends Eloquent
{
  public $table = 'delivery_date';
  protected $primaryKey = 'date';
  protected $validation;
  public $timestamps = false;

  private $rules = [
    'name'=>'required',
  ];

  private $messages = [
    'name.required'=>'Name is required',
  ];

  public function getDeliveryDate($advance) {
    $today = Carbon::now();
    $s = "SELECT * from delivery_date where date_value >= :from_date and date_value < :to_date order by date_value";
    $p['from_date'] = $today->format('Y-m-d');
    $p['to_date'] = $today->addDay($advance + 1)->format('Y-m-d');
    return DB::select($s, $p);
  }

  public function getAvailableDeliveryDate() {
    $today = Carbon::now();
    $advance = 7;
    $s = "SELECT * from delivery_date where date_value >= :from_date and date_value < :to_date and stat = :stat order by date_value";
    $p['from_date'] = $today->format('Y-m-d');
    $p['to_date'] = $today->addDay($advance + 1)->format('Y-m-d');
    $p['stat'] = 1;
    return DB::select($s, $p);
  }

  public function saveTemplate($input) {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    if ( $this->validation->fails() ) {
      return false;
    }

    $this->name = $input['name'];
    $this->save();
    return true;
  }


  public function getValidation() {
    return $this->validation;
  }
}