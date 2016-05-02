<?php namespace App\Models;

use CommonHelper;
use Eloquent, DB, Validator, Input;

class Supplier extends Eloquent
{
  public $table = 'supplier';
  protected $primaryKey = 'supplier_id';
  protected $validation;
  public $timestamps = false;

  private $rules = [
    'name'=>'required',
  ];

  private $messages = [
    'name.required'=>'Name is required',
  ];

  public function saveSupplier($input) {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    if ( $this->validation->fails() ) {
      return false;
    }

    $this->name = $input['name'];
    $this->save();
    return true;
  }

  public function getSupplierForDropdown() {
    $s = "SELECT supplier_id, name from supplier";
    $data = DB::select($s);

    $res = [];
    foreach($data as $d) {
      $res[$d->supplier_id] = $d->name;
    }
    return [''=>''] + $res;
  }


  public function getValidation() {
    return $this->validation;
  }
}