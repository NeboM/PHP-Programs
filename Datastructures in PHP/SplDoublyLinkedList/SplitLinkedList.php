<?php

///////////////////////////////////////////////////////////////////////////////////////////
$randomNumbers = new SplDoublyLinkedList();
$smallerNumbers = new SplDoublyLinkedList();
$biggerNumbers = new SplDoublyLinkedList();
///////////////////////////////////////////////////////////////////////////////////////////

# Fill the LinkedList with random numbers from 1 to 20
for($i = 0; $i < 10; $i++){
    $randomNumbers->push(rand(1,20));
}


# Insert the numbers that are less than 10 into $smallerNumbers
# Insert the numbers that are bigger or equal to 10 into $biggerNumbers

echo "Split one linked list into two: <br>";
$randomNumbers->rewind();
while($randomNumbers->valid()){
    if($randomNumbers->current() < 10){
        $smallerNumbers->push($randomNumbers->current());
    }else{
        $biggerNumbers->push($randomNumbers->current());
    }
    $randomNumbers->next();
}

# Display them

$randomNumbers->rewind();
echo "THE LIST: ";
while($randomNumbers->valid()){
    echo $randomNumbers->current() . " ";
    $randomNumbers->next();
}echo "<br>";


echo "SMALLER THAN 10: ";
$smallerNumbers->rewind();
while($smallerNumbers->valid()){
    echo $smallerNumbers->current() . " ";
    $smallerNumbers->next();
}echo "<br>";

echo "BIGGER OR EQUAL TO 10: ";
$biggerNumbers->rewind();
while($biggerNumbers->valid()){
    echo $biggerNumbers->current() . " ";
    $biggerNumbers->next();
}echo "<br>";

/*
 * OUTPUT

Split one linked list into two:
THE LIST: 9 4 17 4 10 9 8 15 15 11
SMALLER THAN 10: 9 4 4 9 8
BIGGER OR EQUAL TO 10: 17 10 15 15 11

 */
