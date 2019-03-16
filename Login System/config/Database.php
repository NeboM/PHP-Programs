<?php
class Database{

    private $conn;
    private $host = "localhost";
    private $user = "root";
    private $password = "1997";
    private $dbname = "login_system";


    public function __get($property){
        return $this->$property;
    }

    public function __set($property,$value){
        if(property_exists($this,$property)){;
            $this->$property = $value;
            echo "Successfully updated ".$property.": ".$value."<br>";
        }else{
            echo "Failed to update ".$property;
        }
    }

    public function __call($method,$args){
        echo "<p style='color: red'>Method $method does not exist</p>";

    }

    public function connect(){
        $this->conn = null;
        try{
            $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname,$this->user,$this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            die("Could not connect to database: " . $e->getMessage());
        }
        return $this->conn;
    }

}