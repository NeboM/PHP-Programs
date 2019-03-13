<?php

session_start();

function countDigitsInString($string){
    $count = 0;
    for($i = 0; $i < strlen($string); $i++){
        if(is_numeric($string{$i})){
            ++$count;
        }
    }
    return $count;
}

function containOnlySpacesAndDigits($string){
    for($i = 0; $i < strlen($string); $i++){
        if(!is_numeric($string{$i}) && $string{$i} != " "){
            return false;
        }
    }
    return true;
}


if($_SERVER['REQUEST_METHOD'] === "POST"){

    $_SESSION['errors'] = array();

    if(empty($_POST['username'])){
        array_push($_SESSION['errors'],"Username is required");
    }
    if(empty($_POST['email'])){
        array_push($_SESSION['errors'],"Email is required");
    }
    if(empty($_POST['password'])){
        array_push($_SESSION['errors'],"Password is required");
    }
    if(empty($_POST['confirm-password'])){
        array_push($_SESSION['errors'],"Confirm password is required");
    }

    if(count($_SESSION['errors']) > 0){
        session_write_close();
        header("Location: index.php");
        exit();
    }

    if(preg_match("/^[a-zA-Z0-9]+$/", $_POST['username']) !== 1){
        array_push($_SESSION['errors'],"Only letters and numbers are allowed in username");
    }
    if(strlen($_POST['username']) < 3){
        array_push($_SESSION['errors'],"Username must contain at least 3 characters");
    }

    if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL) === false){
        array_push($_SESSION['errors'],"Invalid email");
    }

    if($_POST['password'] !== $_POST['confirm-password']){
        array_push($_SESSION['errors'],"Password and confirm password do not match");
    }else if(strlen($_POST['password']) < 6){
        array_push($_SESSION['errors'],"Password must contain at least 6 characters");
    }

    if(!empty($_POST['phone-number']) && (!containOnlySpacesAndDigits($_POST['phone-number'])  || countDigitsInString($_POST['phone-number']) !== 9)) {
        array_push($_SESSION['errors'], "Invalid phone number");
    }

    if(count($_SESSION['errors']) > 0){
        session_write_close();
        header("Location: index.php");
        exit();
    }else{
        $_SESSION['success'] = "Success! Valid Input";
        session_write_close();
        header("Location: index.php");
        exit();
    }

}else{
    header("Location: index.php");
}