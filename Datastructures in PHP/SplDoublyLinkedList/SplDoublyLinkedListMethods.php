<?php

/////////////////////////////////////////////////////////////////////////////
$list1 = new SplDoublyLinkedList();
/////////////////////////////////////////////////////////////////////////////

# Push adds the new node to the end of the list.
 for($i = 1; $i <= 5; $i++){
     $list1->push($i);
 }

# Display the list
$list1->rewind();
while($list1->valid()){
    echo $list1->current() . " ";
    $list1->next();
}
echo "<br>";

# Unshift adds the new node to the beginning of the list.
for($i = 1; $i <= 5; $i++){
    $list1->unshift($i);
}

# Display the list
$list1->rewind();
while($list1->valid()){
    echo $list1->current() . " ";
    $list1->next();
}echo "<br>";


# Pop deletes the last node from the list.
$list1->pop();

# Display the list
$list1->rewind();
while($list1->valid()){
    echo $list1->current() . " ";
    $list1->next();
}echo "<br>";



# Shift deletes the first node from the list.
$list1->shift();

# Display the list
$list1->rewind();
while($list1->valid()){
    echo $list1->current() . " ";
    $list1->next();
}echo "<br>";


# Add will replace the given index value with given value.
# NOTE! If the index is out of range! Fatal error: Uncaught OutOfRangeException
$list1->add(2,9);

$list1->rewind();
while($list1->valid()){
    echo $list1->current() . " ";
    $list1->next();
}echo "<br>";


# Count method returns the number of nodes.
echo "Number of nodes: " . $list1->count() . "<br>";

# Check if empty
if($list1->isEmpty()){
    echo "The List is Empty.<br>";
}else{
    echo "The List is Not Empty<br>";
}

# Remove all the nodes from the list
$numNodes = $list1->count();
for($i = 0; $i < $numNodes; $i++){
    $list1->pop();
}

# Check if empty again
if($list1->isEmpty()){
    echo "The List is Empty.<br>";
}else{
    echo "The List is Not Empty<br>";
}

# Fill the list
for($i = 1; $i <= 5; $i++){
    $list1->push($i);
}

# Display the list
$list1->rewind();
while($list1->valid()){
    echo $list1->current() . " ";
    $list1->next();

}echo "<br>";

# Top gets the last node
echo $list1->top() . "<br>";

# Bottom gets the first one
echo $list1->bottom() . "<br>";

# Remove specified node
$list1->offsetUnset(3);
# Display the list
$list1->rewind();
while($list1->valid()){
    echo $list1->current() . " ";
    $list1->next();

}echo "<br>";

/*

OUTPUT:

1 2 3 4 5
5 4 3 2 1 1 2 3 4 5
5 4 3 2 1 1 2 3 4
4 3 2 1 1 2 3 4
4 3 9 2 1 1 2 3 4
Number of nodes: 9
The List is Not Empty
The List is Empty.
1 2 3 4 5
5
1
1 2 3 5


*/



