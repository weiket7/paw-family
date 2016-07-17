<?php namespace App\Models;

use CommonHelper;
use Eloquent, DB, Validator, Input;

class DistrictPostal extends Eloquent
{
  public $table = 'district_postal';
  protected $validation;
  public $timestamps = false;



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

  private $rules = [
  ];

  private $messages = [
  ];

}