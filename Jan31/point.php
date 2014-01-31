<?php

class Point {
    public $x;
    public $y;

    function __construct($x, $y) {
        $this->x = $x;
        $this->y = $y;
    }
    
    function __toString() {
        return "({$this->x}, {$this->y})";
    }
    
    public function writeValues() {
        echo "x is {$this->x} and y is {$this->y} <br/>";
    }
}

?>
