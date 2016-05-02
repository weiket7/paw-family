<?php namespace App\Models;

use CommonHelper;
use Eloquent, DB, Validator, Input;

class Customer extends Eloquent
{
  public $table = 'customer';
  protected $primaryKey = 'customer_id';
  protected $validation;
  public $timestamps = false;

  private $rules = [
    'name'=>'required',
    'stat'=>'required',
    'email'=>'required|email',
    'birthday'=>'date',
    'mobile'=>'required',
    'address'=>'required',
    'postal'=>'required|numeric',
  ];

  private $messages = [
    'name.required'=>'Name is required',
    'stat.required'=>'Stat is required',
    'email.required'=>'Email is required',
    'email.email'=>'Email must be valid email',
    'birthday.date'=>'Birthday must be valid date',
    'mobile.required'=>'Mobile is required',
    'address.required'=>'Address is required',
    'postal.required'=>'Postal is required',
    'postal.numeric'=>'Postal must be numeric',
  ];

  public function saveCustomer($input) {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    if ( $this->validation->fails() ) {
      return false;
    }

    $this->name = $input['name'];
    $this->stat = $input['stat'];
    $this->email = $input['email'];
    $this->birthday = $input['birthday'];
    $this->mobile = $input['mobile'];
    $this->phone = $input['phone'];
    $this->address = $input['address'];
    $this->postal = $input['postal'];
    $this->save();
    return true;
  }


  public function getValidation() {
    return $this->validation;
  }
}