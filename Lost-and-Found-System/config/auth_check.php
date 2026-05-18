<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['user_id'])) {

    // destroy any partial session
    session_unset();
    session_destroy();

    header("Location: login.php");
    exit();
}
?>