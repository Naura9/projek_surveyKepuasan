<?php
session_start();
include '../Koneksi.php';

$db = new Koneksi();
$kon = $db->getConnection();

$username = mysqli_real_escape_string($kon, $_POST['username']);
$password = mysqli_real_escape_string($kon, $_POST['password']);
$password_md5 = md5($password); 

if (isset($_POST['role'])) {
    $role = mysqli_real_escape_string($kon, $_POST['role']);
} else {
    $role = null; 
}

$query = "SELECT * FROM m_user WHERE username='$username' AND password='$password_md5'";
$result = mysqli_query($kon, $query);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);

    $nama = $row['nama'];
    $role = $row['role'];

    $_SESSION['username'] = $username;
    $_SESSION['nama'] = $nama;
    $_SESSION['role'] = $role;

    setcookie('username', $username, time() + 3600, '/');
    setcookie('nama', $nama, time() + 3600, '/');
    setcookie('role', $role, time() + 3600, '/');
    
    switch ($role) {
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
            header('Location: login.php?login_error=true');
            break;
    }
} else {
    header('Location: login.php?login_error=true');
}

ob_end_flush();
?>
