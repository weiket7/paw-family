<?php namespace App\Models;

use Carbon\Carbon;
use CommonHelper;
use Eloquent, DB, Validator, Input;

class DeliveryDate extends Eloquent
{
  public $table = 'delivery_date';
  protected $primaryKey = 'date_value';
  protected $validation;
  public $timestamps = false;

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

  public function saveDeliveryDate($input) {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    if ( isset($input['stat']) == false && $input['area'] == '') {
      $this->validation->errors()->add("input", "Select status or enter area");
      return false;
    }

    if ( isset($input['dates']) == false) {
      $this->validation->errors()->add("input", "Select dates");
      return false;
    }

    foreach($input['dates'] as $date) {
      $p['date'] = $date;
      if ((isset($input['stat']) && $input['stat'] != '') && $input['area'] != '') {
        $s = "UPDATE delivery_date set stat = :stat, area = :area where date_value = :date";
        $p['stat'] = $input['stat'];
        $p['area'] = $input['area'];
        DB::update($s, $p);
      } elseif ((isset($input['stat']) && $input['stat'] != '')) {
        $s = "UPDATE delivery_date set stat = :stat where date_value = :date";
        $p['stat'] = $input['stat'];
        DB::update($s, $p);
      } elseif ((isset($input['area']) && $input['area'] != '')) {
        $s = "UPDATE delivery_date set area = :area where date_value = :date";
        $p['area'] = $input['area'];
        DB::update($s, $p);
      }
    }
  }

  public function getValidation() {
    return $this->validation;
  }


  private $rules = [
  ];

  private $messages = [
  ];


}