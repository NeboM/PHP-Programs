<?php

if(!empty($_SESSION['errors'])){
    foreach($_SESSION['errors'] as $error){
        echo "<p class='alert alert-danger mt-3  text-center' style='max-width: 400px; margin: 0 auto'>".$error."</p>";
    }
    unset($_SESSION['errors']);
}