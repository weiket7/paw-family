<?php

use App\Models\Customer;

class CustomerTest extends \Codeception\TestCase\Test
{
    protected $tester;

    public function testGetPet() {
        $customer_service = new Customer();
        $pets = $customer_service->getPet(1);
        $this->assertGreaterThan(0, count($pets));
    }
}