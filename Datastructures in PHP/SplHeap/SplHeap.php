<?php

class Products extends SplHeap{

    public function compare($array1, $array2){
        $values1 = array_values($array1);
        $values2 = array_values($array2);

        if ($values1[0] === $values2[0]) return 0;
        return $values1[0] < $values2[0] ? -1 : 1;
    }
}

$theHeap = new  Products();

$theHeap->insert(array('Milk' => 55));
$theHeap->insert(array('Bread' => 43));
$theHeap->insert(array('Lemons' => 77));
$theHeap->insert(array('Pizza' => 110));
$theHeap->insert(array('Mushrooms' => 90));
$theHeap->insert(array('Beans' => 40));
$theHeap->insert(array('Garlic' => 30));


echo "Number of products: " . $theHeap->count() . "<br>";

$theHeap->top();
while($theHeap->valid()){
    $product = array_keys($theHeap->current());
    $price = array_values($theHeap->current());
    echo $product[0] . ": " . $price[0] . "<br>";
    $theHeap->next();
}

/*

OUTPUT:

Number of products: 7
Pizza: 110
Mushrooms: 90
Lemons: 77
Milk: 55
Bread: 43
Beans: 40
Garlic: 30

 */