<?php
namespace Info5094\UmlExample;

class Customer {
    private $name;
    private $address;
    
    private $orders = array();
    
    public function addOrder($order) {
        array_push($this->orders, $order);
    }
    
    public function getOrders() {
        return $this->orders;
    }
    
    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getAddress() {
        return $this->address;
    }

    public function setAddress($address) {
        $this->address = $address;
    }
}

?>
