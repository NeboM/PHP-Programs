<?php

$theHeap = new SplMinHeap();


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
1) 25
2) 41
3) 57
4) 59
5) 65
6) 78
7) 85
8) 93
9) 96
10) 99

 */
