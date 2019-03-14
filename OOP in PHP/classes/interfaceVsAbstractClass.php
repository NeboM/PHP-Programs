<?php

namespace InterfaceAbstractClass;

/*
 Interface methods can't have body
 Interfaces may not include member variables
 Interfaces may have constants
 Only public allowed
*/
interface interf {
    const VAR = "CONSTANT";

/*
This function will throw ERROR

     public function function2(){

     }
*/
}
/*
 A class that implements an interface must implement all of the
 methods described in the interface
*/
class A implements interf{
    function function1(){
        echo interf::VAR . "<br>";
    }
}

/*
 Abstract class methods may contain body
 and you don't need to implement them in the derived class,
 but abstract methods cannot contain body and they
 must be implemented in the derived classes.
 Can contain constants and variables.
 Protected and public allowed
*/
abstract class AbstractClass{
    public static $var = 1;
    protected static $var2 = 2;
    const EO = "3";
    public function function2(){
        echo "Hope that helps";
    }
    public abstract function function3();
}


class B extends AbstractClass{
    # If you don't implement function3 method we'll get FATAL ERROR
    public function function3(){
        echo AbstractClass::$var . " "  . AbstractClass::EO . "<br>";
    }
}

