<?php

/**
 * One single auto listing extracted from the catalogue
 */
class Listing {
    public $year;
    public $kms;
    public $price;
    
    function __construct($year, $kms, $price) {
        $this->year = $year;
        $this->kms = $kms;
        $this->price = $price;
    }
    
    function __toString() {
        return $this->year." ".$this->kms." ".$this->price;
    }
}

/**
 * The root analysis
 */
class Analysis {
    private $segmentation;
    
    private $years = array();
    
    function __construct($segmentation) {
        $this->segmentation = $segmentation;
    }
    
    /**
     * 
     * @param Listing $listing
     */
    public function newListing($listing) {
        if (!isset($this->years[$listing->year]))
            $this->years[$listing->year] = new YearAnalysis ($this->segmentation);
        
        $this->years[$listing->year]->newListing($listing);
    }
    
    public function getYears() {
        ksort($this->years);
        return $this->years;
    }
    
}

/**
 * An analysis for a specific year
 */
class YearAnalysis {
    // This imports all the functions to analyze this
    // segment
    use SegmentTrait;
    
    public static $AND_OVER = 60000;
    private $segmentation;
    
    private $segments = array();
    
    function __construct($segmentation) {
        $this->segmentation = $segmentation;
        $i = 0;
        while ($i * $this->segmentation <= self::$AND_OVER) {
            $this->segments[$i] = new Segment();
            $i++;
        }
    }
    
    /**
     * 
     * @param Listing $listing
     */
    public function newListing($listing) {
        if ($listing->kms > self::$AND_OVER) $segmentNo = floor(self::$AND_OVER / $this->segmentation);
        else $segmentNo = floor($listing->kms / $this->segmentation);
        //echo "adding a car with {$listing->kms}kms to segment #$segmentNo<br/>";
        
        $this->segments[$segmentNo]->addListing($listing);
        $this->addListing($listing);
    }
    
    public function getSegments() {
        return $this->segments;
    }
}

/**
 * One single segment (year and kms intersection)
 */
class Segment {
    use SegmentTrait;
}

/**
 * Defines the basic analysis
 */
trait SegmentTrait {
    private $n = 0;
    private $sum = 0;
    private $min = 999999;
    private $max = 0;
    
    /**
     * 
     * @param Listing $listing
     */
    public function addListing($listing) {
        if ($listing->price == "" || $listing->price < 100)
            return;
        if ($listing->price > $this->max)
            $this->max = $listing->price;
        if ($listing->price < $this->min)
            $this->min = $listing->price;
        
        $this->sum += $listing->price;
        $this->n++;
    }
    
    public function getNumber() {
        return $this->n;
    }
    
    public function getAverage() {
        if ($this->n > 0)
            return $this->sum / $this->n;
        return 0;
    }
    
    public function getMin() {
        if ($this->n > 0)
            return $this->min;
        return "";
    }
    
    public function getMax() {
        if ($this->n > 0)
            return $this->max;
        return "";
    }
}

?>
