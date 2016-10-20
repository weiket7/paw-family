<?php namespace App\Models;

use App\Models\Enums\CustomerStat;
use App\Models\Enums\PointType;
use App\Models\Enums\SubscribeStat;
use Carbon\Carbon;
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

  public function login($email, $password) {
    $customer = DB::table('customer')->where('email', $email)->first();
    $joined_on = Carbon::createFromFormat('Y-m-d H:i:s', $customer->joined_on);
    $cutoff = Carbon::create(2016, 9, 17, 18, 00);
    if ($joined_on->lt($cutoff)) {
      $password_arr = explode(':', $customer->password);
      $salt = $password_arr[1];
      $encrypted = md5($salt . $password) . ":" . $salt;
      return $customer->password == $encrypted;
    }

    return Hash::check($password, $customer->password);
  }

  public function emailAvailable($email, $customer_id = null) {
    if ($customer_id != null) {
      $count = DB::table("customer")->where("email", $email)->whereNotIn("customer_id", $customer_id)->count();
    }
    $count = DB::table("customer")->where("email", $email)->count();
    return $count == 0;
  }

  public function getPets($customer_id) {
    return DB::table("pet")->where("customer_id", $customer_id)->get();
  }

  public function redeemPointAndLog($points, $sale_id, $sale_no) {
    $s = "UPDATE customer set points = points - :points where customer_id = :customer_id";
    $p['customer_id'] = $this->customer_id;
    $p['points'] = $points;
    DB::statement($s, $p);

    $point_log_service = new PointLog();
    $point_log_service->savePointLog($this->customer_id, $this->points, $points, PointType::Redeem, $sale_id, $sale_no);
  }

  public function earnPointAndLog($points, $sale_id, $sale_no) {
    $s = "UPDATE customer set points = points + :points where customer_id = :customer_id";
    $p['customer_id'] = $this->customer_id;
    $p['points'] = $points;
    DB::statement($s, $p);

    $point_log_service = new PointLog();
    $point_log_service->savePointLog($this->customer_id, $this->points, $points, PointType::Earn, $sale_id, $sale_no);
  }

  public function getCustomer($customer_id) {
    if ($customer_id == null) {
      $customer = new Customer();
      $customer->pets = [];
      $customer->sales = [];
      $customer->point_logs = [];
    } else {
      $customer = Customer::find($customer_id);
      $customer->pets = $this->getPets($customer_id);
      $customer->sales = $this->getSale($customer_id);
      $customer->point_logs = $this->getPointLog($customer_id);
    }
    return $customer;
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
    $this->birthday = empty($input['birthday']) ? null : date('Y-m-d', strtotime($input['birthday']));
    $this->mobile = $input['mobile'];
    $this->phone = $input['phone'];
    $this->address = $input['address'];
    $this->postal = $input['postal'];
    $this->building = $input['building'];
    $this->lift_lobby = $input['lift_lobby'];
    $this->subscribe = isset($input['subscribe']) ? SubscribeStat::Yes : SubscribeStat::No;
    if ($this->points != $input['points']) {
      $point_log_service = new PointLog();
      $point_log_service->savePointLog($this->customer_id, $this->points, $input['points'], PointType::Overwrite);
      $this->points = $input['points'];
    }
    $this->save();
    return true;
  }

  public function changePassword($input, $customer_id) {
    $this->validation = Validator::make($input, $this->rules_change_password, $this->messages_change_password );
    if ( $this->validation->fails() ) {
      return false;
    }

    if (! Hash::check($input['current_password'], $this->password)) {
      $this->validation->errors()->add("current_password", "Current password is wrong");
      return false;
    }

    $this->password = Hash::make($input['password']);
    $this->save();
    return true;
  }

  private $rules_change_password = [
    'current_password'=>'required|min:6',
    'password'=>'required|min:6|confirmed',
  ];

  private $messages_change_password = [
    'current_password.required'=>'Current password is required',
    'current_password.min'=>'Current password must be at least 6 characters',
    'password.required'=>'New password is required',
    'password.min'=>'New password must be at least 6 characters',
    'password.confirmed'=>'New password must be confirmed',
  ];

  private $rules = [
    'stat'=>'sometimes|required',
    'name'=>'required',
    'email'=>'required|email',
    'mobile'=>'required',
    'address'=>'required',
    'postal'=>'required|numeric',
    'birthday'=>'date_format:d-m-Y',
  ];

  private $messages = [
    'stat.required'=>'Stat is required',
    'name.required'=>'Name is required',
    'email.required'=>'Email is required',
    'email.email'=>'Email must be valid email',
    'mobile.required'=>'Mobile is required',
    'address.required'=>'Address is required',
    'postal.required'=>'Postal is required',
    'postal.numeric'=>'Postal must be numeric',
    'birthday.date_format'=>'Birthday must be valid date DD-MM-YYYY',
  ];

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
    $this->building = $input['building'];
    $this->lift_lobby = $input['lift_lobby'];
    $this->last_login_on = date("Y-m-d H:i:s");
    $this->joined_on = date("Y-m-d H:i:s");
    $this->stat = CustomerStat::Active;
    $this->subscribe = isset($input['subscribe']) ? SubscribeStat::Yes : SubscribeStat::No;
    $this->save();
    return $this->customer_id;
  }

  private $rules_register = [
    'name'=>'required',
    'email'=>'required|email',
    'password'=>'required|min:6|confirmed',
    'mobile'=>'required',
    'address'=>'required',
    'postal'=>'required'
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


  public function getValidation() {
    return $this->validation;
  }

  public function getSale($customer_id) {
    return DB::table("sale")->where("customer_id", $customer_id)->orderBy("sale_on", "desc")->get();
  }

  public function resetPassword($input) {
    $this->validation = Validator::make($input,
      ['email'=>'required|email'],
      [
        'email.required'=>'Email is required',
        'email.email'=>'Email must be valid email'
      ]
    );
    if ( $this->validation->fails() ) {
      return false;
    }

    $email = $input['email'];
    $customer = Customer::where('email', $email)->first();
    if ($customer == null) {
      //$this->validation->errors()->add("email", "Email does not exist");
      return false;
    }

    $new_password = str_random(8);
    $customer->password = Hash::make($new_password);
    $customer->save();

    $res = [
      'name'=>$customer->name,
      'email'=>$customer->email,
      'new_password'=>$new_password,
    ];
    return $res;
  }

  public function searchCustomer($input)
  {
    $s = "SELECT * from customer where 1 ";
    if($input['name'] != '') {
      $s .= " and name LIKE '%".$input['name']."%'";
    }
    if($input['email'] != '') {
      $s .= " and email LIKE '%".$input['email']."%'";
    }
    if($input['mobile'] != '') {
      $s .= " and mobile LIKE '%".$input['mobile']."%'";
    }
    if (isset($input['stat']) && $input['stat'] != '') {
      $s .= " and stat = '$input[stat]'";
    }
    $data = DB::select($s);

    return $data;
  }

  public function getPointLog($customer_id)
  {
    $s = "SELECT * from point_log where customer_id = :customer_id order by created_on desc";
    $p['customer_id'] = $customer_id;
    return DB::select($s, $p);
  }

  public function updateSpentTotalOrderCountSpentAvg($sale) {
    $this->spent_total = $this->spent_total + $sale->nett_total;
    $this->order_count = $this->order_count + 1;
    $this->spent_avg = $this->spent_total / $this->order_count;
    $this->save();
  }

  public function getCustomerAll()
  {
    $s = "SELECT * from customer order by joined_on desc limit 100";
    return DB::select($s);
  }
}