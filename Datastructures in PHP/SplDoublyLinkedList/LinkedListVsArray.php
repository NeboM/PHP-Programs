<?php
//////////////////////////////////////////////////////////////////////////////
/// Check the time of execution:
/// Array VS LinkedList
///
///
///
///

$LinkedList = new SplDoublyLinkedList();
$Array = array();

$linkedListCount = 0;
$arrayCount = 0;
$sameCount = 0;

for($k = 0; $k < 1000; $k++){

    $linkedListTime = -microtime(true);
    for($i = 0; $i < 1000; $i++){
        $LinkedList->push($i);
    }
    $linkedListTime += microtime(true);

#  echo "LinkedList time: ",sprintf('%f', $linkedListTime) . "<br>";



    $arrayTime = -microtime(true);
    for($i = 0; $i < 1000; $i++){
        array_push($Array,$i);
    }
    $arrayTime += microtime(true);

#  echo "Array time: ",sprintf('%f', $arrayTime) . "<br>";

    if($linkedListTime > $arrayTime){
        $arrayCount++;
    }else if($linkedListTime < $arrayTime){
        $linkedListCount++;
    }else{
        $sameCount++;
    }

}
echo "FROM 1000 EXECUTIONS: <br>";

echo "$arrayCount times Array finished faster.<br>";

echo "$linkedListCount times LinkedList finished faster. <br>";

echo "$sameCount times the execution time is equal.<br>";

/*
FROM 1000 EXECUTIONS:
984 times Array finished faster.
15 times LinkedList finished faster.
1 times the execution time is equal.
 */

# We can safely say that array is faster than SplDoublyLinkedList in PHP.

