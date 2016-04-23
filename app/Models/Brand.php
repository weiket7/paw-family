<?php namespace App\Models;

use Eloquent, DB, Validator, Input;

class Brand extends Eloquent
{
  public $table = 'brand';
  protected $primaryKey = 'brand_id';
  protected $validation;

}