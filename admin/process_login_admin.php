<?php
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

// Simple admin credentials
if($username === 'admin' && $password === 'admin123') {
    $_SESSION['admin'] = true;
    $_SESSION['username'] = $username;
    header("Location: dashboard.php");
    exit;
} else {
    header("Location: login_admin.php?error=1");
    exit;
}