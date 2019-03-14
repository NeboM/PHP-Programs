<?php

class MagicMethods{
    private $var1;
    private $var2;


    public function __construct($var1,$var2){
        $this->var1 = $var1;
        $this->var2 = $var2;
        echo "Constructor called<br>";
    }

    public function __set($property,$value){
        if(property_exists($this,$property)){;
            $this->$property = $value;
            echo "Successfully updated ".$property.": ".$value."<br>";
        }else{
            echo "Failed to update ".$property."<br>";
        }
    }

    public function __get($property){
        return $this->$property;
    }

    private function inaccessible(){}

    // __call is triggered when invoking inaccessible or non-existing methods
    public function __call($method,$args){
       echo "__call(): Method ''".$method . "'' does not exist <br/>";
       if(count($args) > 0) {
           echo "Parameters: ";
           foreach ($args as $arg) {
               echo "$arg ";
           }
           echo "<br>";
       }
    }

    // __callStatic is triggered when invoking inaccessible methods in a static context
    public static function __callStatic($method,$args){
        echo "__callStatic(): Static Method ''".$method . "'' does not exist <br/>";
        if(count($args) > 0) {
            echo "Parameters: ";
            foreach ($args as $arg) {
                echo "$arg ";
            }
            echo "<br>";
        }
    }

    public function __toString(){
        return "__toString: var1 = ".$this->var1. "|| var2 = ".$this->var2."<br>";
    }

    public function __isset($name) {
        echo "__isset(): Non-existent property '$name'<br>";
    }

    public function __unset($name){
        echo "__unsset(): Non-existent property '$name'<br>";
    }
}