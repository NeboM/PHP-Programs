<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>File Upload</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body style="background: #f9f9f9; color: gray;">
<div class="container  mt-5" style="max-width: 750px;">

    <div class="text-center">
        <h3>Form Validation</h3>
        <p><small>Form Validation example</small></p>
    </div>

    <form action="validate.php" method="POST">

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" placeholder="Username*" class="form-control" >
        </div>

        <div class="form-group">
            <label for="text">Email</label>
            <input type="text" name="email" id="email" placeholder="Email*" class="form-control" >
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Password*" class="form-control" >
        </div>

        <div class="form-group">
            <label for="confirm-password">Confirm Password</label>
            <input type="password" name="confirm-password" placeholder="Confirm Password*" class="form-control">
        </div>

        <div class="form-group">
            <label for="confirm-password">Phone Number</label>
            <input type="text" name="phone-number" placeholder="07X XXX XXX" class="form-control">
        </div>

        <div class="text-center">
            <input type="submit" value="Submit File" class="btn btn-info mt-2 mb-4" style="width: 130px">
        </div>

    </form>

    <?php
    if(!empty($_SESSION['errors'])){
        foreach($_SESSION['errors'] as $error){
            echo "<p class='alert alert-danger mt-3  text-center' style='max-width: 400px; margin: 0 auto'>".$error."</p>";
        }
        unset($_SESSION['errors']);
    }else if(!empty($_SESSION['success'])){
        echo "<p class='alert alert-success mt-3 text-center' style='max-width: 400px; margin: 0 auto'>".$_SESSION['success']."</p>";
        unset($_SESSION['success']);
    }


    session_write_close();
    ?>

</div>
</body>
</html>


