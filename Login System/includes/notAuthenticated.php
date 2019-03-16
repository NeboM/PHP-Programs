<?php
// If the user is authenticated redirect to the home page
if(!empty($_SESSION['user_id'])){
    header('Location: ../public/home.php');
}