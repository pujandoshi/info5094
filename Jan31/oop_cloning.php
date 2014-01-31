<?php

/*
 * Run through this file to see the difference between letting $p2 = $p1 and
 * $p2 = clone $p1. 
 * 
 * To answer the questions, write your own experiments in PHP.
 */

require_once('point.php');

echo "<p>New point at (1, 1)</p>";
$p1 = new Point(1,1);
// __toString() in Point let's this happen
echo "\$p1 is: $p1 <br/>";

// What is actually happening with the new keyword?

echo "<h3>\$p2 is = \$p1 ... what happens when we set p2 at (3, 3)?</h3>";
$p2 = $p1;
$p2->x = 3;
$p2->y = 3;
echo "\$p1 is: $p1 <br/>";
echo "\$p2 is: $p2 <br/>";

// Why is this? Are $p1 and $p2 separate variables? 
// Can $p2 be reused to reference a difference object?

echo "<h3>\$p2 is = <strong>clone</strong> \$p1 ... what happens when we set p2 at (4, 4)?</h3>";
$p2 = clone $p1;
$p2->x = 4;
$p2->y = 4;
echo "\$p1 is: $p1 <br/>";
echo "\$p2 is: $p2 <br/>";

// What is clone doing?
// What if we write $p1 = $p2? Where does what $p2 referenced before go?

?>
