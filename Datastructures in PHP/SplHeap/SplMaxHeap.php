<?php

$theHeap = new SplMaxHeap();


for($i = 0; $i < 10; $i++){
    $theHeap->insert(rand(1,100));
}

$theHeap->top();

echo "Number of elements in heap: " . $theHeap->count() . "<br>";

$index = 1;
while($theHeap->valid()){
    echo $index++ . ") " . $theHeap->current() . "<br>";
    $theHeap->next();
}

/*

OUTPUT:

Number of elements in heap: 10
1) 100
2) 91
3) 78
4) 62
5) 55
6) 54
7) 46
8) 19
9) 11
10) 10

 */
