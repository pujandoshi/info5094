<?php

use Info5094\UmlExample\Customer;

class CustomerTest extends PHPUnit_Framework_TestCase {
    
    public function testSetAddress() {
        $customer = new Customer();
        $customer->setAddress("123 Main St.");
        
        $this->assertEquals($customer->getAddress(), "123 Main St.");
        $this->assertNotEquals($customer->getAddress(), "123 MAin St.");
    }
    
    public function testSetName() {
        $customer = new Customer();        
        $customer->setName("Buster Bluth");
        
        $this->assertEquals($customer->getName(), "Buster Bluth");
        $this->assertNotEquals($customer->getName(), "buster bluth");
    }
    
    public function testOrderRelationship() {
        $customer = new Customer();        
        $this->assertTrue(count($customer->getOrders()) == 0);
        
        $customer->addOrder(5);
        $this->assertTrue(count($customer->getOrders()) == 1);
        $this->assertTrue($customer->getOrders()[0] === 5);
    }
    
}

?>
