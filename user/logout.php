<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login1.php");
    exit();
}

$showAlert = !isset($_SESSION['admin_alert_shown']);
$_SESSION['admin_alert_shown'] = true;
?>