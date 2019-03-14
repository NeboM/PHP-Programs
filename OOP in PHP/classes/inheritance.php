<?php

class A{

    protected $x;
    protected $y;

    public function __construct($x,$y){
        echo "Constructor from class A. <br>";
        $this->x = $x;
        $this->y = $y;
    }

    public function sum(){
        if(is_numeric($this->x) && is_numeric($this->y)){
            echo "x + y = " . ($this->x + $this->y) ." <br>";
        }else{
            echo "Only numeric values use this method.<br>";
        }

    }

}

class B extends A{

    private $z = 5;

    public function __construct($z,$x = "",$y = ""){
        if(!empty($x) && !empty($y)){
            parent::__construct($x,$y);
        }
        echo "Constructor from class B. <br>";
        $this->z = $z;
    }

    public function sum(){
        if(!empty($this->x) && !empty($this->y)){
            echo "x + y + z= " . ($this->x + $this->y + $this->z) ." <br>";
        }else{
            echo "z = ". $this->z ." <br>";
        }
    }
}