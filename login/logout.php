<?php
session_start();

session_destroy();

if(isset($_COOKIE['username'])) {
    setcookie('username', '', time() - 3600, '/');
}
if(isset($_COOKIE['nama'])) {
    setcookie('nama', '', time() - 3600, '/');
}
if(isset($_COOKIE['role'])) {
    setcookie('role', '', time() - 3600, '/');
}

header("Location: login.php");
exit();
?>
