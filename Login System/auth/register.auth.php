<?php

session_start();
require_once '../config/Database.php';
require_once '../model/User.php';
require_once '../includes/notAuthenticated.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $db = new Database();
    $conn = $db->connect();
    $user = new User($conn);

    if($user->noEmptyRegister($_POST['email'],$_POST['username'],$_POST['password'],$_POST['confirm-password'])
        && $user->inputValid($_POST['email'],$_POST['username'],$_POST['password'],$_POST['confirm-password'])
        && $user->register($_POST['email'],$_POST['username'],$_POST['password'])){
            // If the input is without issues, we'll save his data
            // in the database and redirect him to the login page.
            session_write_close();
            header('Location: ../public/login.php');
            exit();
    }
}
// If the user for some reason was not able to register will be
// redirected back to the registration page, and the errors will be displayed.
session_write_close();
header('Location: ../public/register.php');