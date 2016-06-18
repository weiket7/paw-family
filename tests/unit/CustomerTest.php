<?php

use App\Models\Customer;
use App\Models\Enums\CustomerStat;
use App\Models\Enums\SubscribeStat;

class CustomerTest extends \Codeception\TestCase\Test
{
  protected $tester;

  public function testGetPet() {
    $customer_service = new Customer();
    $pets = $customer_service->getPets(1);
    $this->assertGreaterThan(0, count($pets));
  }

  public function testGetCustomer() {
    $customer_service = new Customer();
    $customer = $customer_service->getCustomer(1);
    $this->assertEquals('wei_ket@hotmail.com', $customer->email);
    $this->assertGreaterThan(0, count($customer->pets));
  }

  public function testSaveCustomer() {
    $customer = Customer::find(1);
    $input['name'] = 'new name';
    $input['stat'] = CustomerStat::Blacklisted;
    $input['email'] = 'weiket7@gmail.com';
    $input['birthday'] = '01-01-1989';
    $input['mobile'] = '91234567';
    $input['phone'] = '61234567';
    $input['address'] = 'Blk 123, Bedok Reservoir Rd';
    $input['postal'] = '470123';
    $input['building'] = 'Block A';
    $input['lift_lobby'] = 'B';
    $input['subscribe'] = null;
    $customer->saveCustomer($input);

    $customer = Customer::find(1);
    $this->assertEquals('new name', $customer->name);
    $this->assertEquals(CustomerStat::Blacklisted, $customer->stat);
    $this->assertEquals('1989-01-01', $customer->birthday);
    $this->assertEquals('weiket7@gmail.com', $customer->email);
    $this->assertEquals('91234567', $customer->mobile);
    $this->assertEquals('61234567', $customer->phone);
    $this->assertEquals('Blk 123, Bedok Reservoir Rd', $customer->address);
    $this->assertEquals('470123', $customer->postal);
    $this->assertEquals('Block A', $customer->building);
    $this->assertEquals('B', $customer->lift_lobby);
    $this->assertEquals(SubscribeStat::No, $customer->subscribe);
  }

  public function testRegisterCustomer() {
    $input['name'] = 'new name';
    $input['email'] = 'weiket8@gmail.com';
    $input['password'] = '123456';
    $input['password_confirmation'] = '123456';

    $input['mobile'] = '91234567';
    $input['address'] = 'Blk 123, Bedok Reservoir Rd';
    $input['postal'] = '470123';
    $input['building'] = 'Block A';
    $input['lift_lobby'] = 'B';
    $input['subscribe'] = 'Y';
    $customer_service = new Customer();
    $customer_id = $customer_service->registerCustomer($input);

    $customer = Customer::find($customer_id);
    $this->assertEquals('new name', $customer->name);
    $this->assertEquals(CustomerStat::Active, $customer->stat);
    $this->assertEquals('weiket8@gmail.com', $customer->email);
    $this->assertEquals('91234567', $customer->mobile);
    $this->assertEquals('Blk 123, Bedok Reservoir Rd', $customer->address);
    $this->assertEquals('470123', $customer->postal);
    $this->assertEquals('Block A', $customer->building);
    $this->assertEquals('B', $customer->lift_lobby);
    $this->assertEquals(SubscribeStat::Yes, $customer->subscribe);
  }
}