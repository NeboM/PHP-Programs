<?php

$request_uri = explode("?",$_SERVER['REQUEST_URI']);

switch($request_uri[0]){
    case "/":
        require_once 'pages/home.php';
        break;
    case "/about":
        require_once 'pages/about.php';
        break;
    case "/posts":
        require_once 'pages/posts.php';
        break;
    default:
        require_once 'pages/404.php';
        break;

}