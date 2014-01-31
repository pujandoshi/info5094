<?php

require_once('point.php');

/**
 * In this function, $p is not passed by reference meaning that
 * if $p is reassigned to a new object in the heap, then the reference variable
 * passed to this function is not affected.
 * @param Point $p
 */
function notByRef($p) {
    $p->x = 2;
    $p->y = 2;
    $p = new Point(10,10);
    echo "Value of p in notByRef is $p <br/>";
}


/**
 * In this function, $p *is* passed by reference meaning that
 * if $p is reassigned to a new object in the heap, then the reference variable
 * passed to this function *is* affected.
 * @param Point $p
 */
function byRef(&$p) {
    $p->x = 2;
    $p->y = 2;
    $p = new Point(10,10);
    echo "Value of p in byRef is $p <br/>";
}

echo "<p>New point at (1, 1)</p>";
$p = new Point(1,1);
echo "\$p1 is: $p <br/>";

echo "<p>What if we send to notByRef?</p>";
notByRef($p);
echo "\$p1 is: $p <br/>";

echo "<hr/>";

echo "<p>New point at (1, 1)</p>";
$p = new Point(1,1);
echo "\$p1 is: $p <br/>";

echo "<p>What if we send to byRef?</p>";
byRef($p);
echo "\$p1 is: $p <br/>";

// Where did our point at (2,2) go?

?>
