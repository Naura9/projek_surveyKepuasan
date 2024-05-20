<?php
session_start();

// Hapus semua data sesi
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

// Arahkan pengguna kembali ke halaman login
header("Location: login.php");
exit();
?>
