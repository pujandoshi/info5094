<?php
namespace Info5094\UmlExample;

abstract class Payment {
    protected $amount;
    
    public function getAmount() {
        return $this->amount;
    }
}

?>
