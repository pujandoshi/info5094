<?php

require_once('point.php');
/*
$num1 = 20;
$num2 = $num1;
echo "num1 is $num1 and num2 is $num2 <br/>";

$num2 = 30;
echo "num1 is $num1 and num2 is $num2 <br/>";
*/
/*
$num1 = 20;
$num2 = &$num1;
echo "num1 is $num1 and num2 is $num2 <br/>";

$num2 = 30;
echo "num1 is $num1 and num2 is $num2 <br/>";
*/

$p1 = new Point(1,1);
$p2 = clone $p1;
// Equivalent to
//$p2 = new Point();
//$p2->x = $p1->x;
//$p2->y = $p1->y;
 echo "p1 is $p1 and p2 is $p2 <br/>";

$p2->x = 10;
$p2->y = 10;

echo "p1 is $p1 and p2 is $p2";



?>