<?php

session_start();
require_once '../includes/header.php';
require_once '../includes/authenticated.php';
require_once '../config/Database.php';
require_once '../model/User.php';

$db = new Database();
$conn = $db->connect();
$user = new User($conn);
$currentUser = $user->getUserById($_SESSION['user_id']);

?>

<div class="container  mt-5 custom text-center" style="max-width: 750px;">
    <h3 class="google-font-1">Welcome</h3>
    <p><small>Username:  <?= $currentUser['username'] ?></small></p>
    <p><small>Email: <?= $currentUser['email'] ?></small></p>
    <p><small>Created at: <?= $currentUser['created_at'] ?></small></p>
    <a href="../auth/logout.php">Click here to logout</a>
</div>

<?php
session_write_close();
require_once '../includes/footer.php';