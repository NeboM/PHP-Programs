<?php

require 'classes/inheritance.php';
require 'classes/interfaceVsAbstractClass.php';

spl_autoload_register(function($class_name){
    require 'classes/'.$class_name.'.php';
});

// Testing Database
echo "<p style='color: red'> Testing Database Class: </p>";
$db = new Database();
$db->dbname = "performance_schema";
$db->connect();
echo " Host: ". $db->host . "<br><br><br>";


// Testing MagicMethods Class
echo "<p style='color: red'>Testing MagicMethods Class: </p>";
$mm = new MagicMethods(12,31);
$mm->var2 = "This is string";
echo  $mm->var2 . "<br>";
echo $mm->inaccessible(12,12,32,12);
echo $mm->randomMethodName();
MagicMethods::staticNonExistingClass();
echo $mm;
isset($mm->nonExisting);
empty($mm->againNonExisting);
unset($mm->unsetThis);
echo "<br><br>";


// Testing Inheritance
echo "<p style='color: red'> Testing Inheritance: </p>";
$a = new A(1,2);
$a->sum();
$a1 = new A("asd",12);
$a1->sum();
$b = new B(3);
$b->sum();
$b1 = new B(1,23,2);
$b1->sum();
echo "<br><br>";



// Testing Abstract class and interface
echo "<p style='color: red'> Testing Abstract class And Interface: </p>";
$a = new \InterfaceAbstractClass\A();
$a->function1();
$b = new \InterfaceAbstractClass\B();
$b->function3();
$b->function2();