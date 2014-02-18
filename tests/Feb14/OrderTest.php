<?php

namespace Info5094\UmlExample;

class OrderTest extends \PHPUnit_Framework_TestCase {
    private $order;
    public function setUp() {
        $item = new Item(10,5, "something $10 and 5lbs");
        
        $this->order = new Order(new Customer());
        $orderWithTax = new OrderDetail($item, $order, 2, true);
        $orderWithoutTax = new OrderDetail($item, $order, 2, false);
        
        $payment = new CashPayment(40);
        
        $this->order->addItem($orderWithTax);
        $this->order->addItem($orderWithoutTax);
        $this->order->addPayment($payment);
    }
    
    public function testCalcTax() {
        $this->assertEquals($this->order->calcTax(), 2.60);
    }
    
    public function testCalcSubTotal() {
        $this->assertEquals($this->order->calcSubTotal(), 40);
    }
    
    public function testCalcTotalWeight() {
        $this->assertEquals($this->order->calcTotalWeight(), 20);
    }
    
    public function testCalcAmountLiable() {
        // since we didn't cover taxes
        $this->assertEquals($this->order->calcAmountLiable(), 2.60);
    }
}
    


?>
