<?php namespace App\Models;

use Eloquent, DB, Validator, Input;

class User extends Eloquent {
  public $table = 'user';
  protected $primaryKey = 'user_id';
  protected $validation;

  public function loginUser($username, $password) {
    return DB::table('user')->where('username', $username)->where('password', $password)->pluck('user_id');
  }
}