<?php
namespace Info5094\UmlExample;

class CreditPayment extends Payment {
    private $number;
    private $type;
    private $expDate;
    
    function __construct($amount, $number, $type, $expDate) {
        $this->amount = $amount;
        $this->number = $number;
        $this->type = $type;
        $this->expDate = $expDate;
    }

    public function getNumber() {
        return $this->number;
    }

    public function getType() {
        return $this->type;
    }

    public function getExpDate() {
        return $this->expDate;
    }


}

?>
