<?php namespace App\Models;

use App\Models\Enums\CustomerStat;
use App\Models\Enums\SubscribeStat;
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

    $this->email = $input['email'];
    $this->validation->after(function($validator) {
      if(! $this->emailAvailable($this->email)) {
        $validator->errors()->add("email", "Email has been registered");
      }
    });

    if ( $this->validation->fails() ) {
      return false;
    }

    $this->name = $input['name'];
    $this->password = Hash::make($input['password']);
    $this->mobile = $input['mobile'];
    $this->address = $input['address'];
    $this->postal = $input['postal'];
    $this->joined_on = date("Y-m-d H:i:s");
    $this->stat = CustomerStat::Active;
    $this->subscribe = isset($input['subscribe']) ? SubscribeStat::Yes : SubscribeStat::No;
    $this->save();
    return $this->customer_id;
  }

  public function emailAvailable($email, $customer_id = null) {
    if ($customer_id != null) {
      $count = DB::table("customer")->where("email", $email)->whereNotIn("customer_id", $customer_id)->count();
    }
    $count = DB::table("customer")->where("email", $email)->count();
    return $count == 0;
  }

  public function sendRegisterEmail($data) {
    //http://forumsarchive.laravel.io/viewtopic.php?id=8264
    Mail::send('personal/activate-email', $data, function($message) use ($data)
    {
      $message->to($data['email'], $data['first_name'])->subject('Activate your United Points account now');
    });
  }

  public function getPet($customer_id) {
    return DB::table("pet")->where("customer_id", $customer_id)->get();
  }

  public function saveCustomer($input) {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    if ( $this->validation->fails() ) {
      return false;
    }

    $this->name = $input['name'];
    if (isset($input['stat']))
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

  public function getCustomer($customer_id) {
    if ($customer_id == null) {
      $customer = new Customer();
      $customer->pets = [];
      $customer->sales = [];
    } else {
      $customer = DB::table("customer")->where("customer_id", $customer_id)->first();
      $customer->pets = $this->getPet($customer_id);
      $customer->sales = $this->getSale($customer_id);
    }
    return $customer;
  }

  private $rules_register = [
    'name'=>'required',
    'email'=>'required|email',
    'password'=>'required|min:6|confirmed',
    'mobile'=>'required',
    'address'=>'required',
    'postal'=>'required'
    //'password_confirmation'=>'required|min:6',
  ];

  private $messages_register = [
    'name.required'=>'Name is required',
    'email.required'=>'Email is required',
    'email.email'=>'Email must be valid email',
    'password.required'=>'Password is required',
    'password.min'=>'Password must be at least 6 characters',
    'password.confirmed'=>'Password must be confirmed',
    'mobile.required'=>'Mobile is required',
    'address.required'=>'Address is required',
    'postal.required'=>'Postal is required'
  ];


  private $rules = [
    'name'=>'required',
    'stat'=>'sometimes|required',
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

  public function getSale($customer_id) {
    return DB::table("sale")->where("customer_id", $customer_id)->get();
  }
}