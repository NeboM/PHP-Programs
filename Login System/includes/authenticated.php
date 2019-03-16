<?php
// If the user is authenticated redirect to the login page
if(empty($_SESSION['user_id'])){
    header('Location: ../public/login.php');
}