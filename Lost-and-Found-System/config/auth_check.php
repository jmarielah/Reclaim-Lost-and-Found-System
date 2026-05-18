<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['user_id'])) {
    session_unset();
    session_destroy();

    header("Location: login.php");
    exit();
}

$current_user_id = $_SESSION['user_id'];
$current_role    = $_SESSION['role'] ?? 'student';

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
?>