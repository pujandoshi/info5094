<?php

require_once 'list.php';

use Info5094\Examples\IList;

class ArrayList implements IList {
    private $list = array();
    private $index = 0;
    
    public function add($element) {
        array_push($this->list, $element);
    }

    public function current() {
        return $this->list[$this->index];
    }

    public function key() {
        return $this->index;
    }

    public function next() {
        $this->index++;
    }

    public function previous() {
        $this->index--;
    }
    
    public function rewind() {
        $this->index = 0;
    }

    public function valid() {
        return isset($this->list[$this->index]);
        //return $this->index >= 0 && $this->index < count($this->list);
    }    
}

$list = new ArrayList();
$list->add(11);
$list->add(22);
$list->add(33);
$list->add(44);
$list->add(55);

foreach ($list as $key => $value) {
    echo "key is $key and value is $value <br/>";
}

?>
