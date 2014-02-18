<?php
namespace Info5094\UmlExample;

class Order {
    private $date;
    private $status;
    
    private $purchaser;
    private $payments = array();
    private $items = array();
    
    function __construct($purchaser) {
        $this->purchaser = $purchaser;
        $this->date = new \DateTime("NOW");
        $this->status = "";
    }
    
    public function calcTax() {
        $taxable = 0;
        foreach ($this->items as $item) {
            if ($item->isTaxable() )
                $taxable += $item->calcOrderSubTotal();
        }
        return $taxable * 0.13;
    }
    
    public function calcSubTotal() {
        $subTotal = 0;
        foreach ($this->items as $item) {
            $subTotal += $item->calcOrderSubTotal();
        }
        return $subTotal;
    }
    
    public function calcTotalWeight() {
        $totalWeight = 0;
        foreach ($this->items as $item) {
            $totalWeight += $item->calcOrderWeight();
        }
        return $totalWeight;
    }
    
    public function calcAmountLiable() {
        $payment = 0;
        $total = $this->calcSubTotal() + $this->calcTax();
        foreach ($this->payments as $payment) {
            $payment += $payment->getAmount();
        }
        return $total - $payment;
    }
    
    public function addItem($item) {
        array_push($this->items, $item);
    }
    
    public function addPayment($payment) {
        array_push($this->payments, $payment);
    }
    
    public function getPurchaser() {
        return $this->purchaser;
    }
    
    public function getItems() {
        return $this->items;
    }
    
}

?>
