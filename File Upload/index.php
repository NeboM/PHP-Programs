<?php
    session_start();
    if (empty($_SESSION['token'])) {
        $_SESSION['token'] = bin2hex(random_bytes(32));
    }
    $token = $_SESSION['token'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>File Upload</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container text-center mt-5" style="max-width: 700px;">

        <h3>Upload your file</h3>
        <p><small>Only images and pdf allowed</small></p>

        <form action="upload.php" method="POST" enctype="multipart/form-data" class="mt-3">

            <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFile" name="file">
                <label class="custom-file-label" for="customFile">Choose file</label>
            </div>

            <input type="hidden" name="token" value="<?= $token ?>">
            <input type="submit" value="Submit File" class="btn btn-primary mt-2">

        </form>

        <?php
            if(!empty($_SESSION['error'])){
                echo "<p class='alert alert-danger mt-3' style='max-width: 400px; margin: 0 auto'>".$_SESSION['error']."</p>";
                unset($_SESSION['error']);
            }
            session_write_close();
        ?>

    </div>
</body>
</html>



