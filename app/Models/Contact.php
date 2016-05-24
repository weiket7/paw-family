<?php namespace App\Models;

use Validator;

class Contact
{
  private $rules = [
    'name'=>'required',
    'mobile'=>'required',
    'email'=>'required|email',
    'content'=>'required',
  ];

  private $messages = [
    'name.required'=>'Name is required',
    'mobile.required'=>'Mobile is required',
    'email.required'=>'Email is required',
    'email.email'=>'Email must be valid email',
    'content.required'=>'Message is required',
  ];

  public function validateContact($input) {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    if ( $this->validation->fails() ) {
      return false;
    }
    return true;
  }

  public function getValidation() {
    return $this->validation;
  }

}