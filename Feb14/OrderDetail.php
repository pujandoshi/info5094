<?php
namespace Info5094\UmlExample;

class OrderDetail {
    private $quantity;
    private $taxable;
    
    private $parentOrder;
    private $item;
    
    function __construct($item, $parentOrder, $quantity, $taxable) {
        $this->quantity = $quantity;
        $this->taxable = $taxable;
        $this->parentOrder = $parentOrder;
        $this->item = $item;
    }
    
    public function calcOrderSubTotal() {
        return $this->item->getPrice() * $this->quantity;
    }
    
    public function calcOrderWeight() {
        return $this->item->getShippingWeight() * $this->quantity;
    }
    
    public function getItem() {
        return $this->item;
    }
    
    public function getQuantity() {
        return $this->quantity;
    }
    
    public function isTaxable() {
        return $this->taxable;
    }
}

?>
