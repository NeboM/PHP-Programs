<?php
session_start();
require_once '../config/Database.php';
require_once '../model/User.php';
require_once '../includes/notAuthenticated.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $db = new Database();
    $conn = $db->connect();
    $user = new User($conn);

    if($user->noEmptyLogin($_POST['email'],$_POST['password']) && $user->login($_POST['email'],$_POST['password'])){
        // If the input is not empty, password and email exist and match we'll redirect the user to the home page
        session_write_close();
        header('Location: ../public/home.php');
        exit();
    }
}
session_write_close();
header('Location: ../public/login.php');
