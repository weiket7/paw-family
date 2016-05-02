<?php namespace App\Models;

use App\Models\Enums\CustomerStat;
use App\Models\Enums\SubscribeEmailStat;
use CommonHelper;
use Eloquent, DB, Validator, Input;
use Hash;
use Illuminate\Contracts\Auth\Authenticatable;

class Customer extends Eloquent
{
  public $table = 'customer';
  protected $primaryKey = 'customer_id';
  protected $validation;
  public $timestamps = false;

  public function registerCustomer($input) {
    $this->validation = Validator::make($input, $this->rules_register, $this->messages_register );
    if ( $this->validation->fails() ) {
      return false;
    }

    if ($this->emailAvailable($input['email']) > 0) {
      $this->validation->messages()->add("email", "Email has been registered");
      return false;
    };

    $this->name = $input['name'];
    $this->email = $input['email'];
    $this->password = Hash::make($input['password']);
    $this->joined_on = date("Y-m-d H:i:s");
    $this->stat = CustomerStat::Active;
    $this->subscribe_email = isset($input['subscribe_email']) ? SubscribeEmailStat::Yes : SubscribeEmailStat::No;
    $this->save();
    return true;
  }

  public function emailAvailable($email) {
    $count = DB::table("customer")->where("email", $email)->count();
    return $count;
  }

  public function sendRegisterEmail($data) {
    //http://forumsarchive.laravel.io/viewtopic.php?id=8264
    Mail::send('personal/activate-email', $data, function($message) use ($data)
    {
      $message->to($data['email'], $data['first_name'])->subject('Activate your United Points account now');
    });
  }

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

  private $rules_register = [
    'name'=>'required',
    'email'=>'required|email',
    'password'=>'required|min:6|confirmed',
    //'password_confirmation'=>'required|min:6',
  ];

  private $messages_register = [
    'name.required'=>'Name is required',
    'email.required'=>'Email is required',
    'email.email'=>'Email must be valid email',
    'password.required'=>'Password is required',
    'password.min'=>'Password must be at least 6 characters',
    'password.confirmed'=>'Password must be confirmed',
  ];


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

  public function getValidation() {
    return $this->validation;
  }
}