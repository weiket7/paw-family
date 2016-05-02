<?php namespace App\Models;

use Eloquent, DB, Validator, Input;
use Hash;

class Operator extends Eloquent
{
  public $table = 'Operator';
  protected $primaryKey = 'operator_id';
  protected $validation;
  public $timestamps = false;
  
  private $rules = [
    'name'=>'required',
    'price'=>'required|numeric',
  ];

  private $messages = [
    'name.required'=>'Name is required',
    'price.required'=>'Price is required',
    'price.numeric'=>'Price must be numeric',
  ];
  
  public function loginOperator($username, $entered_password) {
    $s = "SELECT username, password from operator
			where username = :username";
    $p[':username'] = $username;
    $data = DB::select($s, $p);

    if (count($data) <= 0) {
      return false;
    }

    $hashed_password = $data[0]->password;
    $check_password = Hash::check($entered_password, $hashed_password);
    if (! $check_password) {
      return false;
    }

    return $data[0];
  }
}

