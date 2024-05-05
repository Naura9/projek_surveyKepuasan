<?php
session_start();
// Koneksi ke database
include '../koneksi.php';

// Ambil data dari form
$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role']; // Menyimpan pilihan role (user atau admin)

// Query untuk memeriksa apakah username dan password cocok
$query = "SELECT * FROM m_user WHERE username='$username' AND password='$password'";
$result = mysqli_query($kon, $query);

if(mysqli_num_rows($result) == 1) {
    // Jika user ditemukan, sesuaikan dengan peran yang dipilih
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
    $_SESSION['role'] = $role; // Simpan peran (role) dalam sesi

    // Ambil nama pengguna dari hasil query jika perlu
    $row = mysqli_fetch_assoc($result);
    $nama = $row['nama']; // Ambil nama pengguna dari hasil query
    $password = $row['password']; // Ambil nama pengguna dari hasil query
    $role = $row['role']; // Ambil nama pengguna dari hasil query

    $_SESSION['nama'] = $nama; // Simpan nama pengguna dalam sesi
    $_SESSION['password'] = $password; // Simpan nama pengguna dalam sesi
    $_SESSION['role'] = $role; // Simpan nama pengguna dalam sesi

    if($role == 'admin') {
        // Jika login sebagai admin, arahkan ke dashboard admin
        header('Location: ../admin/dashboard-admin.php');
    } else {
        // Jika login sebagai user, arahkan ke dashboard user
        header('Location: ../user/dashboard-user.php');
    }
} else {
    // Jika login gagal, kembali ke halaman login
    header('Location: login.php?login_error=true');
}

?>
