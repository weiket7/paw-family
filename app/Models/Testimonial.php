<?php namespace App\Models;

use CommonHelper;
use Eloquent, DB, Validator, Input;

class Testimonial extends Eloquent
{
  public $table = 'testimonial';
  protected $primaryKey = 'testimonial_id';
  protected $validation;
  public $timestamps = false;

  private $rules = [
    'name'=>'required',
  ];

  private $messages = [
    'name.required'=>'Name is required',
  ];

  public function getTestimonialAll() {
    $data[1] = (object)['name'=>'Andy',
      'location'=>'Yishun',
      'value'=>'The best online shop ever!
The website is easy to use and has many products to choose from at prices below other pet shops. Prompt delivery time and great service too!
Keep it up!'];
    return $data;
  }

  public function saveTestimonial($input) {
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