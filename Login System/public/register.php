<?php
session_start();
require_once '../includes/header.php';
require_once '../includes/notAuthenticated.php';
?>
    <div class="container  mt-5 custom" style="max-width: 750px;">
        <div class="text-center">
            <h3 class="google-font-1">Register</h3>
            <p><small>Create a New Account</small></p>
        </div>

        <form action="../auth/register.auth.php" method="POST">

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="Username*" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="text">Email</label>
                <input type="email" name="email" id="email" placeholder="Email*" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Password*" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="confirm-password">Confirm Password</label>
                <input type="password" name="confirm-password" placeholder="Confirm Password*" class="form-control"required>
            </div>

            <a href="login.php"><p>Sign in</p></a>

            <div class="text-center">
                <input type="submit" value="Sign up" class="btn btn-info mt-2 mb-4" style="width: 130px">
            </div>

        </form>
        <?php
            require_once '../includes/messages.php';
        ?>
    </div>

<?php
session_write_close();
require_once '../includes/footer.php';