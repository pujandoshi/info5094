<?php

// This file is an example of another data structure implemented using
// interfaces. This won't be tested. This isn't the most effective manner
// of implementing a map either; it's just a simple way for educational purposes.

/**
 * The map interface. It is iterable.
 */
interface IMap extends Iterator {
    public function set($key, $value);
    public function get($key);
}

/**
 * A single map node.
 */
class MapNode {
    private $key;
    private $value;
    function __construct($key, $value) {
        $this->key = $key;
        $this->value = $value;
    }
    public function getKey() {
        return $this->key;
    }

    public function setKey($key) {
        $this->key = $key;
    }

    public function getValue() {
        return $this->value;
    }

    public function setValue($value) {
        $this->value = $value;
    }


}

/**
 * A map implementation
 */
class Map implements IMap {
    private $data = array();
    private $indexedData = array();
    private $index = 0;
    
    public function get($key) {
        return $this->indexedData[$key]->getValue();
    }
    
    public function set($key, $value) {
        if (isset($this->indexedData[$key])) {
            $node = $this->indexedData[$key];
            $node->setValue($value);
        }
        else {
            $node = new MapNode($key, $value);
            array_push($this->data, $node);
            $this->indexedData[$key] = $node;
        }
    }
    
    public function current() {
        return $this->data[$this->index]->getValue();
    }

    public function key() {
        return $this->data[$this->index]->getKey();
    }

    public function next() {
        $this->index++;
    }

    public function rewind() {
        $this->index = 0;
    }

    public function valid() {
        return isset($this->data[$this->index]);
    }    
}

/*
 * Testing code
 */
$map = new Map();
$map->set("test", "123");
$map->set("test", "345");
$map->set("foo", "bar");

foreach($map as $key => $value) {
    echo "key is $key and value is $value <br/>";
}

?>
