<?php

class User{

    private $table = "users";
    private $conn;

    // Set connection
    public function __construct(PDO $conn = null){
        $this->conn = $conn;
    }

    // Get only one user by id
    public function getUserById($id){
        $sql = "SELECT id, username, email, created_at FROM ".$this->table." WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id",$id);
        if($stmt->execute()){
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }else{
            return $stmt->errorCode();
        }
    }

    // I use this method for checking if any fields are left empty on register.
    public function noEmptyRegister($email,$username,$password1,$password2){

        $_SESSION['errors'] = array();

        if(empty($email)){
            array_push($_SESSION['errors'],"Email is required!");
        }
        if(empty($username)){
            array_push($_SESSION['errors'],"Username is required!");
        }
        if(empty($password1) || empty($password2)){
            array_push($_SESSION['errors'],"Password and confirm password are required!");
        }
        if(empty($_SESSION['errors'])){
            return true;
        }else{
            return false;
        }
    }

    // I use this method for checking if any fields are left empty on login.
    public function noEmptyLogin($email,$password){

        $_SESSION['errors'] = array();

        if(empty($email)){
            array_push($_SESSION['errors'],"Email is required!");
        }
        if(empty($password)){
            array_push($_SESSION['errors'],"Password is required!");
        }
        if(empty($_SESSION['errors'])){
            return true;
        }else{
            return false;
        }
    }

    // I use this method for checking if the input on the register is valid.
    public function inputValid($email, $username, $password1, $password2){

        if(filter_var($email,FILTER_VALIDATE_EMAIL) === false){
            array_push($_SESSION['errors'],"Invalid Email!");
        }

        if(preg_match("/^[a-zA-Z0-9_]+$/", $username) !== 1){
            array_push($_SESSION['errors'],"Only letters, numbers and underscore allowed in username!");
        }else if(strlen($username) < 3 || strlen($username) > 15){
            array_push($_SESSION['errors'],"Username must contain from 3 to 15 characters!");
        }

        if($password1 !== $password2){
            array_push($_SESSION['errors'],"Password and confirm password do not match");
        }else if(strlen($password1) < 6){
            array_push($_SESSION['errors'],"Password must contain at least 6 characters");
        }

        if(count($_SESSION['errors']) === 0){
            return true;
        }else{
            return false;
        }
    }

    // Finally, save the user data if possible.
    public function register($email,$username,$password){

        // If the username or email already exist return error message
        if(self::usernameExist($username) !== false){
            array_push($_SESSION['errors'],"The username is not available. Please try another.");
            return false;
        }
        if(self::emailExist($email) !== false){
            array_push($_SESSION['errors'],"Account with provided email exists.");
            return false;
        }

        // Else register
        $passwordHash = password_hash($password,PASSWORD_DEFAULT);

        $sql = "INSERT INTO ". $this->table."
        SET username = :username, email = :email, password = :password";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":username",$username);
        $stmt->bindParam(":email",$email);
        $stmt->bindParam(":password",$passwordHash);

        return $stmt->execute();
    }


    // Checks if email exist in the database
    public function emailExist($email){

        $sql = "SELECT id FROM ".$this->table." WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":email",$email);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['id'];
        }else{
            return false;
        }
    }

    // Checks if username exist in the database
    public function usernameExist($username){
        $sql = "SELECT id FROM ".$this->table." WHERE username = :username";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":username",$username);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['id'];
        }else{
            return false;
        }
    }


    // The user may or may not log in.
    public function login($email,$password){
        $sql = "SELECT id,password FROM ".$this->table. " WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":email",$email);
        $stmt->execute();
        if($stmt->rowCount() == 0){
            array_push($_SESSION['errors'],"Email does not exist!");
            return false;
        }else{
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if(password_verify($password,$row['password'])){
                $_SESSION['user_id'] = $row['id'];
                return true;
            }else{
                array_push($_SESSION['errors'],"Email and password do not match!");
                return false;
            }
        }
    }

}