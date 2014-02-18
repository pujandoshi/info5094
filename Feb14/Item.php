<?php
namespace Info5094\UmlExample;

class Item {
    private $price;
    private $shippingWeight;
    private $description;
    
    function __construct($price, $shippingWeight, $description) {
        $this->price = $price;
        $this->shippingWeight = $shippingWeight;
        $this->description = $description;
    }
    
    public function getPrice() {
        return $this->price;
    }

    public function getShippingWeight() {
        return $this->shippingWeight;
    }

    public function getDescription() {
        return $this->description;
    }


    
}

?>
