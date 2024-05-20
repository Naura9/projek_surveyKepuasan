<?php
session_start();
include '../Koneksi.php';

$username = mysqli_real_escape_string($kon, $_POST['username']);
$password = mysqli_real_escape_string($kon, $_POST['password']);
$password_md5 = md5($password); // Enkripsi password menggunakan MD5
$role = mysqli_real_escape_string($kon, $_POST['role']); // Menyimpan pilihan role (user atau admin)

// Query untuk memeriksa apakah username dan password cocok
$query = "SELECT * FROM m_user WHERE username='$username' AND password='$password_md5'";
$result = mysqli_query($kon, $query);

if(mysqli_num_rows($result) == 1) {
    // Ambil baris hasil query dari database
    $row = mysqli_fetch_assoc($result);

    // Ambil nama pengguna dan peran dari hasil query
    $nama = $row['nama'];
    $role = $row['role'];

    $_SESSION['username'] = $username;
    $_SESSION['nama'] = $nama;
    $_SESSION['role'] = $role; // Simpan peran (role) dalam sesi

    setcookie('username', $username, time() + 3600, '/'); // Cookie berlaku selama 1 jam (3600 detik)
    setcookie('nama', $nama, time() + 3600, '/');
    setcookie('role', $role, time() + 3600, '/');
    
    switch ($role) {
        // Redireksi sesuai dengan peran pengguna
        case 'admin':
            header('Location: ../admin/dashboard-admin.php');
            break;
        case 'mahasiswa':
            header('Location: ../mahasiswa/dashboard-mahasiswa.php');
            break;
        case 'dosen':
            header('Location: ../dosen/dashboard-dosen.php');
            break;
        case 'tendik':
            header('Location: ../tendik/dashboard-tendik.php');
            break;
        case 'ortu':
            header('Location: ../ortu/dashboard-ortu.php');
            break;
        case 'alumni':
            header('Location: ../alumni/dashboard-alumni.php');
            break;
        case 'industri':
            header('Location: ../industri/dashboard-industri.php');
            break;
        default:
            // Jika peran tidak dikenali, kembali ke halaman login
            header('Location: login.php?login_error=true');
            break;
    }
} else {
    // Jika login gagal, kembali ke halaman login
    header('Location: login.php?login_error=true');
}
?>
