<?php
session_start();
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    if (!empty($_POST['token'])) {
        if (!hash_equals($_SESSION['token'], $_POST['token'])) {
            // Log this as a warning and keep an eye on these attempts
            exit();
        }
    }else{
        exit();
    }

    if(!empty($_FILES['file'])){
        $allowedExtensions = array("jpg","jpeg","png","gif","tiff","pdf");

        $fileType = explode('.',$_FILES['file']['name']);
        $fileType = end($fileType);
        $newFileName = time().".".$fileType;

        if($_FILES['file']['size'] > 10000000){
            $_SESSION['error'] = 'File too large, maximum 10MB allowed.';
            header('Location: index.php');
        }else if(!in_array($fileType,$allowedExtensions) || count($fileType) <= 1){
            $_SESSION['error'] = 'File type not allowed.';
            header('Location: index.php');
        }else{
            move_uploaded_file($_FILES['file']['tmp_name'],'uploads/'.$newFileName);
            echo "<p>File uploaded successfully. <a href='index.php'> Go back.</a></p>";
        }
    }else{
        $_SESSION['error'] = "Please choose file before submitting.";
        header('Location: index.php');
    }
}else{
    exit("error");
}