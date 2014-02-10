<?php

require_once 'namespacedPoint.php';

use Info5094\Examples\Point;
echo new Point(1,1);

// Or

echo new Info5094\Examples\Point(2,2);

// Or 
// 
// (note that this would need to be at the top of the file
// to work since namespaces must be at the top)

//namespace Info5094\Examples;
//echo new Point(3,3);

?>